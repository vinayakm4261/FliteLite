<?php
    include("dbcon.php");    
    $errors = array();
    @session_start();
    if(isset($_POST["loginSub"])) {
        $username = $_POST["uname"];
        $password = $_POST["passw"];
        if(empty($username)) {
            array_push($errors, "Username is required");
        }
        if(empty($password)) {
            array_push($errors, "Password is required");
        }
        if(count($errors) == 0) {
            $password=md5($password);
            $tempq = "SELECT * FROM users WHERE username=:username AND password=:password";
            $query = $db -> prepare($tempq);
            $query->bindParam(":username",$username,PDO::PARAM_STR);
            $query->bindParam(":password",$password,PDO::PARAM_STR);
            $query->execute();
            $usr = $query -> fetch();
            if($query->rowCount() == 1) {
                $_SESSION["uid"] = $usr["user_ID"];
                $_SESSION["username"] = $username;
                $_SESSION["success"] = "Welcome to the webpage $username..!!";
            }
            else {
                array_push($errors, "Incorrect username or password");
            }
        }
        if(isset($_POST["page"])) {
            echo "true";
        } else {
            header("location: welcome.php");
        }
    }
?>