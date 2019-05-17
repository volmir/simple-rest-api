<?php

class Db {
    
    private $host = 'localhost';
    private $dbname = 'rest_api';
    private $user = 'root';
    private $password = 'jdh837mdkl';

    /**
     * 
     * @return \PDO
     */
    public function getConnect() {
        try {
            $db = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->dbname, $this->user, $this->password);
            return $db;
        } catch (PDOException $e) {
            print "Error!: " . $e->getMessage();
            die();
        }
    }

}
