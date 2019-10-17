<?php
    include("dbcon.php");
    @session_start();
    $uid = $_SESSION['uid'];
    if(isset($_POST['add-pass'])) {
        $pname = $_POST['pname'];
        $page = $_POST['page'];
        $pcont = $_POST['pcont'];
        $paddr = $_POST['paddr'];
        $tempa = "INSERT INTO passengers(pname, paddr, page, pcont, u_id) VALUES(:pname, :paddr, :page, :pcont, :u_id)";
        $querya = $db -> prepare($tempa);
        $querya -> bindParam(":pname", $pname);
        $querya -> bindParam(":paddr", $paddr);
        $querya -> bindParam(":page", $paddr);
        $querya -> bindParam(":pcont", $pcont);
        $querya -> bindParam(":u_id", $uid);
        $stat = $querya -> execute();
        if($stat) {
            echo 1;
        } else {
            echo 0;
        }
    }
    if(isset($_POST['edit-pass'])) {
        $pname = $_POST['edit-pass-sel'];
        $temp = "SELECT * FROM passengers WHERE pname=:pname AND u_id=:uid";
        $query = $db -> prepare($temp);
        $query -> bindParam(":pname", $pname, PDO::PARAM_STR);
        $query -> bindParam(":uid", $uid, PDO::PARAM_STR);
        $query -> execute();
        $res = $query -> fetch();
        $data = array("name" => $res['pname'], "address" => $res['paddr'], "age" => $res['page'], "contact" => $res['pcont'], "id" => $res['p_id']);
        echo json_encode($data);
    }
    if(isset($_POST['edit-single'])) {
        $pid = $_POST['paid'];
        $pname = $_POST['paname'];
        $page = $_POST['paage'];
        $paddr = $_POST['paaddr'];
        $pcont = $_POST['pacont'];
        $temps = "UPDATE passengers SET pname = :pname, page = :page, pcont = :pcont, paddr = :paddr WHERE p_id = :pid AND u_id = :uid";
        $querys = $db -> prepare($temps);
        $querys -> bindParam(":pname", $pname);
        $querys -> bindParam(":page", $page);
        $querys -> bindParam(":paddr", $paddr);
        $querys -> bindParam(":pcont", $pcont);
        $querys -> bindParam(":pid", $pid);
        $querys -> bindParam(":uid", $uid);
        $status = $querys -> execute();
        if($status) {
            echo 1;
        } else {
            echo $querys -> errorInfo();
        }
    }
?>