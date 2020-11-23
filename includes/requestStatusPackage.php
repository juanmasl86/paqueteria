<?php
/**
 * Created by PhpStorm.
 * User: juanmartin.sanchez
 * Date: 26/09/2019
 * Time: 12:42
 */
//llamadas
include_once '../Models/db.php';
include_once '../Models/package.php';
include_once '../Models/user.php';
include_once 'user_session.php';

//objetos de las clases
$db = new DB();
$userSession = new UserSession();
$user = new User();
$package = new Package();

//recibe datos
if (isset($_POST)) {
//el usuario recoge los datos del usuario logueado
if(isset($_SESSION['user'])) {
    $user->setUser($userSession->getCurrentUser());
}
// consultamos los paquetes del usuario logueado
if($user->getId() != null) {
    $userId = $user->getId();
    $consulta = $package->rowsPackageUser($userId);
    $result = $consulta->fetchAll(PDO::FETCH_ASSOC);


 //si la consulta no es null
    if(!is_null($result)){

        $now = time();

        $consultaProceso = $db->connect()->prepare("SELECT * FROM proceso");
        $consultaProceso->execute();
        $procesos = $consultaProceso->fetchAll(PDO::FETCH_ASSOC);

            $processingTime = 0;
            $compare = array();
            foreach ($procesos as $minutes) {
                $processingTime += $minutes['duration'];
               $min = $minutes['duration'] / 60;
               $nameFase = $minutes['fases'];
               for ($i = $min; $i >0; $i-- ) {
                 array_push($compare, $nameFase);
               }
            }


        echo "<table>";
        echo "<thead>";
        echo "<tr>
              <th> ID | </th>
              <th> LOCATOR | </th>
              <th> FECHA DE CREACION | </th>
              <th> TIEMPO EN LINEA | </th>
              <th> LINEA | </th>
              <th> FIN </th>
            </tr>
            </thead>";
        echo"<tbody>";

        foreach ($result as $file){
            $created = $file['timecreated'];

            $timeElapsed = $now - $created;

            $fecha = getdate($file['timecreated']);

            $hora = $fecha['hours'] . ":" . $fecha['minutes'] . ":" . $fecha['seconds'];
            $date = $fecha['mday'] . "/" . $fecha['mon'] . "/" . $fecha['year'];


            echo "<tr>";
            echo "<td>".$file['id']."</td>
            <td>".$file['locator']."</td>
            <td> ".$hora. "  ".$date."</td>";
            if ($timeElapsed > $processingTime) {
            echo "<td> </td>";
            echo "<td> </td>";
            echo "<td>  x  </td>";
            echo "</tr>";
            } else {

                $indice = ($timeElapsed / 60);
                $timeOn = ($timeElapsed / 60);
                $segundos = ($timeElapsed % 60);
                $indice = intval($indice);


                echo "<td id='".$file['id']."'></td>";
                echo "<script>$(document).ready(function () {
                            mostrarTiempo(" . $file['id'] . ", " . $timeElapsed . ");
                       });
                    </script>";
                echo "<td id='linea".$file['id']."'>" . $compare[$indice] ."</td>";
                echo "<td id='final".$file['id']."'> - </td>";
                echo "</tr>";
            }
        }
        echo "</tbody>";
        echo"</table>";
        }
    }



}





?>