<?php
/**
 * Created by PhpStorm.
 * User: juanmartin.sanchez
 * Date: 26/09/2019
 * Time: 9:30
 */
include_once 'db.php';

class Package extends DB {
    private $id, $locator, $timecreated, $iduser;

    public function packageExists($locator) {
        $query = $this->connect()->prepare("SELECT * FROM paquete WHERE locator = :locator");
        $query->execute(['locator' => $locator]);

        if ($query->rowCount()) {
            return true;
        } else {
            return false;
        }
    }

    public function newPackage($time, $iduser, $locator)
    {
        $query = $this->connect()->prepare("INSERT INTO paquete (id, timecreated, iduser, `locator`) VALUE (default, :time , :user , :locator )");
        $query->execute(['time' => $time, 'user' => $iduser, 'locator' => $locator]);

    }

    public function rowsPackageUser($iduser)
    {
        $query = $this->connect()->prepare("SELECT * FROM paquete WHERE iduser = :user");
        $query->execute(['user' => $iduser]);

        if ($query->rowCount()) {
            return $query;
        } else {
            return null;
        }
    }

}