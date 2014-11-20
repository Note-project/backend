<?php
header("Access-Control-Allow-Origin: *");
class Login {
    private $login_success;
    function login() {
        
        if (trim($_POST['email']) == '') {
            $hasError = true;
            echo "fill in email form";
            die();
        } else if (!preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", trim($_POST['email']))) {
            $hasError = true;
            echo "Enter a valid email address";
            die();
        } else {
            $email = trim($_POST['email']);
            $pass = trim($_POST['password']);
            
        }
        include_once 'database.php';
        $dbh = $database->create_dbh();
        $query = "SELECT userID from users where email = :email and password =:password";
        $sth = $dbh->prepare($query);
        $sth->bindValue("email", $email);
        $sth->bindValue("password", $pass);
        //echo $query;
        $sth->execute();
        $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        if ($result == null) {
            $this->login_success=false;
            echo json_encode($this->login_success);
            die();
        }
        $result = json_encode($result);
        //echo json_encode($this->login_success=true);
        echo $result;
        die();
    }

}

$login = new Login();
$login->login();
