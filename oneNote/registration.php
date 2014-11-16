<?php
header("Access-Control-Allow-Origin: *");
// need to check that username is unique
class register {

    // check if client is sending an id to log in
    function connect() {
        $email = trim($_POST["email"]);
        $password = trim($_POST["password"]);
        //echo $email.$password;
        include_once 'database.php';      
        $dbh = $database->create_dbh();
        $this->checkUnique($email,$dbh);
        try{
        $query = "INSERT INTO users VALUES (NULL,:user,:password)";
        $sth = $dbh->prepare($query);
        $sth->bindValue(':user', $email);
        $sth->bindValue(':password', $password);
        $success = $sth->execute();
        }
        catch(Exception $e){
            echo $e;
            
        }
        echo "user added";
        
        
    }
    function checkUnique($email,$dbh){
        try{
            $query = "select * from users where email = :user";
            $sth = $dbh->prepare($query);
            $sth->bindValue(':user', $email);
            $sth->execute();
            $check = $sth->fetch(PDO::FETCH_ASSOC);
            //var_dump($check);
            if ($check!=false){
                echo json_encode("username taken");
                exit;
            }
        }
        catch(Exception $e){
            
        }
    }
    
    

}

$request = new register();
$request->connect();
