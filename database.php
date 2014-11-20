<?php

class Connect_database {

    private $host = "localhost";
    private $database = "oneNote";
    private $user = "flyers";
    private $pass = "asdf";

    function create_dbh() {
        try {
            $dbh = new PDO("mysql:host=$this->host;dbname=$this->database","$this->user", $this->pass);
            return $dbh;
            
        } catch (PDOException $e) {
            echo "error: ".$e->getMessage();
        }
    }
}    
  $database = new Connect_database();   
  //var_dump($database)." is my database";


