<?php
header("Access-Control-Allow-Origin: *");
class Retrieve_notes{
    function querydb(){
        $email = trim($_POST["email"]);
        include_once 'database.php';
        $dbh = $database->create_dbh();
        /*$query = "SELECT notes.noteID, users.email, notes.note  from notes where '".$email."'=users.email" 
          ."INNER JOIN users on users.usersID = notes.userID";*/
        $query = "SELECT note from notes WHERE email = :email";
        $sth = $dbh->prepare($query);
        $sth->bindValue("email",$email);
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);      
        $result = json_encode($result);
        echo $result;
    }
}
$get_notes = new Retrieve_notes();
$get_notes->querydb();