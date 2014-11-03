<?php
class Receive_notes{
    
    function save_notes(){
        $email = trim($_POST["email"]);
        $note = $_POST["note"];
        include_once 'database.php';
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
