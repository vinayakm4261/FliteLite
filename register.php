<?php
    include("dbcon.php");
    $errors = array();
    if(isset($_POST["regSub"])) {
        $username = $_POST["uname"];
        $email = $_POST["email"];
        $name = $_POST["name"];
        $password_1 = $_POST["passw1"];
        $password_2 = $_POST["passw2"];
        if(empty($username)) {
            array_push($errors, "Username is required");
        }
        if(empty($email)) {
            array_push($errors, "Email-ID is required");
        }
        if(empty($name)) {
            array_push($errors, "Enter your Name");
        }
        if(empty($password_1)) {
            array_push($errors, "Password is required");
        }
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Enter a valid Email ID");
        }
        if($password_1 != $password_2) {
            array_push($errors, "Passwords do not match");
        }

        //Checking for same user existence
        $tempq = "SELECT * FROM users WHERE username=:username OR email=:email LIMIT 1";
        $query = $db -> prepare($tempq);
        $query->bindParam(":username",$username, PDO::PARAM_STR);
        $query->bindParam(":email",$email,PDO::PARAM_STR);
        $query->execute();
        $result=$query->fetchAll(PDO::FETCH_ASSOC);
        if($result) {
            if($result["username"] === $username) {
                array_push($errors, "Username already exists");
            }
            if($result["email"] === $email) {
                array_push($errors, "Account with entered email id already exists");
            }
        }

        if(count($errors)==0) {
            $password=md5($password_1);
            $tempq = "INSERT INTO users (username, name, email, password) VALUES(:username, :name, :email, :password)";
            $query = $db -> prepare($tempq);
            $query->bindParam(":username",$username,PDO::PARAM_STR);
            $query->bindParam(":name",$name,PDO::PARAM_STR);
            $query->bindParam(":email",$email,PDO::PARAM_STR);
            $query->bindParam(":password",$password,PDO::PARAM_STR);
            $query->execute();
            /* $_SESSION["username"]=$username;
            $_SESSION["success"]="Welcome to the webpage $username..!!";
            header("location: index.php"); */
        }
    }
?>