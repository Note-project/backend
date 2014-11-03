<?php

// need to check that username is unique
class register {

    // check if client is sending an id to log in
    function connect() {
        $email = trim($_POST["$email"]);
        $password = trim($_POST["password"]);
        include_once 'database.php';      
        $dbh = $database->create_dbh();
        $query = "INSERT INTO users VALUES (NULL,:user,:password)";
        $sth = $dbh->prepare($query);
        $sth->bindValue(':user', $email);
        $sth->bindValue(':password', $password);
        $sth->execute();
    }

}

$request = new register();
$request->connect();
