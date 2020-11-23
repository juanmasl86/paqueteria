<?php
/**
 * Created by PhpStorm.
 * User: juanmartin.sanchez
 * Date: 26/09/2019
 * Time: 11:38
 */
include_once '../Models/package.php';
include_once '../Models/user.php';
include_once 'user_session.php';

$userSession = new UserSession();
$user = new User();

if(isset($_SESSION['user'])) {
    $user->setUser($userSession->getCurrentUser());
}

    if(isset($_POST['locator'])){
    $package = new package();

    if($package->packageExists($_POST['locator'])) {
        $errorInsert = "problema con el localizador del paquete intentelo de nuevo más tarde";
        echo $errorInsert;
    } else {
        $time = time();
        $userId = $user->getId();
        $package->newPackage($time, $userId, $_POST['locator']);
        $correct = "Se ha añadido correctamente";
        echo $correct;
    }

}

?>