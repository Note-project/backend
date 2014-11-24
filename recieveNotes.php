<?php

header("Access-Control-Allow-Origin: *");

class Receive_notes {

    function save_notes() { 
        $note = $_POST["note"];
        
        if (trim($_POST['email']) == '') {
            $hasError = true;
            echo "bad email";
            echo json_encode($validEmail = false);
            exit;
        } else if (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", trim($_POST['email']))) {
            $hasError = true;
            echo "erro email";
            echo json_encode($validEmail = false);
            exit;
        } else {
            $email = trim($_POST['email']);
        }
        $title = (isset($_POST["title"]) ? $_POST["title"] : "no title given");
        include_once 'database.php';

       // echo "email and note start" . $email . "   end";
        $dbh = $database->create_dbh();
        if (isset($_POST['noteID'])) {
            $noteID = $_POST['noteID'];
            $query = "update  notes set title = :title ,note = :note where noteID = :noteID";   
            $sth = $dbh->prepare($query);
            $sth->bindValue(':noteID', $noteID);
            $msg = "note changed";
            
        } else {
            $query = "INSERT INTO notes VALUES (NULL,:email,:title,:note)";
             $sth = $dbh->prepare($query);
             $sth->bindValue(':email', $email);
             $msg = "note added";
        }
       
       
        $sth->bindValue(':note', $note);
        $sth->bindValue(':title', $title);
        $sth->execute();
        echo $msg;
    }

}

$saveNote = new Receive_notes();
$saveNote->save_notes();
