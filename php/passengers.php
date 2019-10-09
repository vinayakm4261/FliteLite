<?php
    include("dbcon.php");
    @session_start();
    $uid = $_SESSION['uid'];
    /* if(isset($_POST['add-pass'])) {
        $pname = $_POST['pname'];
        $pname = $_POST['pname'];
        $pname = $_POST['pname'];
    } */
    if(isset($_POST['edit-pass'])) {
        $pname = $_POST['edit-pass-sel'];
        $temp = "SELECT * FROM passengers WHERE pname=:pname AND u_id=:uid";
        $query = $db -> prepare($temp);
        $query -> bindParam(":pname", $pname, PDO::PARAM_STR);
        $query -> bindParam(":uid", $uid, PDO::PARAM_STR);
        $query -> execute();
        $res = $query -> fetch();
        $data = array("name" => $res['pname'], "address" => $res['paddr'], "age" => $res['page'], "contact" => $res['pcont']);
        echo json_encode($data);
    }
?>