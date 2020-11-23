<?php
/**
 * Created by PhpStorm.
 * User: juanmartin.sanchez
 * Date: 23/09/2019
 * Time: 12:52
 */

include_once 'Models/package.php';
include_once 'Models/user.php';
include_once 'includes/user_session.php';

$userSession = new UserSession();
$user = new User();

if(isset($_SESSION['user'])){
    $user->setUser($userSession->getCurrentUser());
    include_once './Views/inicio.phtml';

} else if(isset($_POST['username']) && isset($_POST['password'])) {

    //echo "Validacion logi
    $userForm = $_POST['username'];
    $passForm = $_POST['password'];

    if($user->userExists($userForm, $passForm)) {


            $userSession->setCurrentUser($userForm);

            $user->setUser($userForm);

        include_once './Views/inicio.phtml';
    } else {
        $errorLogin = "usuario y/o password erroneo";
        include_once './Views/logueo.php';
    }
} else {
    include_once './Views/logueo.php';
}

?>