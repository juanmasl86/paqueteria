<?php
/**
 * Created by PhpStorm.
 * User: juanmartin.sanchez
 * Date: 25/09/2019
 * Time: 9:22
 */
class DB {
    private $host;
    private $db;
    private $user;
    private $password;
    private $charset;

    public function __construct() {
        $this->host = '127.0.0.1';
        $this->db = 'db_paqueteria';
        $this->user = 'root';
        $this->password = '';
        $this->charset = "utf8mb4";
    }

    public function connect(){

            try {
                $connection = "mysql:host=" . $this ->host . ";dbname=" . $this->db. ";charset=" . $this->charset;
                $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                          PDO::ATTR_EMULATE_PREPARES => false];
                $pdo = new PDO($connection, $this->user, $this->password, $options);
                return $pdo;
            }catch(PDOException $e){
                print_r("Error connection; " . $e->getMessage());
            }

        }
    }

?>