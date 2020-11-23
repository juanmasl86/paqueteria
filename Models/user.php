<?php
/**
 * Created by PhpStorm.
 * User: juanmartin.sanchez
 * Date: 25/09/2019
 * Time: 9:48
 */

include_once 'db.php';

class User extends DB {
    private $id;
    private $nombre;
    private $username;

    public function userExists($user, $password) {
        $query = $this->connect()->prepare("SELECT * FROM usuario WHERE username = :user  AND  pass = :password");
        $query->execute(['user' => $user, 'password' => $password]);

        if ($query->rowCount()) {
            return true;
        } else {
            return false;
        }
    }

    public function setUser($user){
        $query = $this->connect()->prepare("SELECT * FROM usuario WHERE username= :user");
        $query->execute(['user'=>$user]);

        foreach ($query as $currentUser) {
            $this->id = $currentUser['id'];
            $this->username = $currentUser['username'];
            $this->nombre = $currentUser['name'];
        }

     }

/**
 * @return mixed
 */
    public function getId()
    {
        return $this->id;
    }

     public function getNombre() {
        return $this->nombre;
     }



}

?>