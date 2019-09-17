<?php
    $dbhost="localhost";
    $dbusr="root";
    $dbpwd="";
    $dbname="myne";
    try{
        $db=new PDO("mysql:host=$dbhost;dbname=$dbname",$dbusr,$dbpwd);
    }
    catch(PDOException $e){
        echo("Connection Failed:" . $e->getMessage());
    }
?>