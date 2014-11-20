<?php
header("Access-Control-Allow-Origin: *");
class Receive_notes{
    
    function save_notes(){
       if (trim($_POST['email']) == '') {
            $hasError = true;
             echo json_encode($validEmail=false);
              exit;
        } else if (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", trim($_POST['email']))) {
            $hasError = true;
             echo json_encode($validEmail=false);
             exit;
        } else {
            $email = trim($_POST['email']);
        }
        $note = $_POST["note"];
        $title = (isset($_POST["title"])?$_POST["title"]:"no title given");
        include_once 'database.php';
        
        echo $email.$note;
        $dbh = $database->create_dbh();
        $query = "INSERT INTO notes VALUES (NULL,:email,:title,:note)";
        $sth = $dbh->prepare($query);
        $sth->bindValue(':email',$email);
        $sth->bindValue(':note',$note);
        $sth->bindValue(':title',$title);
        $sth->execute();
    }
    
}
$saveNote= new Receive_notes();
$saveNote->save_notes();
