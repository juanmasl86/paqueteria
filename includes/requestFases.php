<?php
/**
 * Created by PhpStorm.
 * User: juanmartin.sanchez
 * Date: 30/09/2019
 * Time: 13:59
 */

include_once '../Models/db.php';


$db = new DB();

$consultaProceso = $db->connect()->prepare("SELECT * FROM proceso");
$consultaProceso->execute();
$procesos = $consultaProceso->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($procesos);

?>