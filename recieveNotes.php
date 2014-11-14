<?php
header("Access-Control-Allow-Origin: *");
class Receive_notes{
    
    function save_notes(){
        echo var_dump($_POST);
        print_r($_POST);
        $email = trim($_POST["email"]);
        $note = $_POST["note"];
        include_once 'database.php';
        
        echo $email.$note;
        $dbh = $database->create_dbh();
        $query = "INSERT INTO notes VALUES (NULL,:email,:note)";
        $sth = $dbh->prepare($query);
        $sth->bindValue(':email',$email);
        $sth->bindValue(':note',$note);
        $sth->execute();
    }
    
}
$saveNote= new Receive_notes();
$saveNote->save_notes();
