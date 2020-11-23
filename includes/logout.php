<?php
/**
 * Created by PhpStorm.
 * User: juanmartin.sanchez
 * Date: 25/09/2019
 * Time: 12:33
 */
    include_once 'user_session.php';

    $userSession = new UserSession();
    $userSession->closeSession();

    header("location: ../index.php");

?>