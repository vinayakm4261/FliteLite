<?php
    include("dbcon.php");
    if(isset($_POST["flight_id"])) {
        $fid = $_POST["flight_id"];
        $tempq = "SELECT * FROM flights WHERE f_id = :fid LIMIT 1";
        $query = $db -> prepare($tempq);
        $query -> bindParam(":fid", $fid, PDO::PARAM_STR);
        $query -> execute();
        $result = $query -> fetchAll(PDO::FETCH_ASSOC);
        $finalInfo = array();
        foreach($result as $flight) {
            array_push($finalInfo, array("f_id" => $fid, "f_no" => $flight["f_no"], "f_date" => $flight["f_date"], "d_time" => $flight["d_time"], 
                            "f_src" => $flight["f_src"], "f_dest" => $flight["f_dest"]));
        }
        header('Content-Type: application/json');
        echo json_encode($finalInfo);
    }
    if(isset($_POST["pass-sub"])) {
        //data for booking table
        $code = 0;
        $b_date = $_POST["b_date"];
        $f_id = $_POST["f_id"];
        $b_type = $_POST["b_type"];
        $b_dest = $_POST["b_dest"];
        $b_src = $_POST["b_src"];
        $b_cost = $_POST["cost"];
        $u_id = $_POST["uid"];
        $tempb = "INSERT INTO bookings(b_date, f_id, b_type, b_dest, b_src, b_cost, u_id) VALUES(:bdate, :fid, :btype, :bdest, :bsrc, :bcost, :uid)";
        $bookq = $db -> prepare($tempb);
        $bookq -> bindParam(":bdate", $b_date);
        $bookq -> bindParam(":fid", $f_id);
        $bookq -> bindParam(":btype", $b_type);
        $bookq -> bindParam(":bdest", $b_dest);
        $bookq -> bindParam(":bsrc", $b_src);
        $bookq -> bindParam(":bcost", $b_cost);
        $bookq -> bindParam(":uid", $u_id);
        $status = $bookq -> execute();
        $bid = $db -> lastInsertId();
        if($status) {
            $code = 1;
        } else {
            $code -= 1;
        }
        //data for includes table
        $passengers = $_POST["passn"];
        foreach($passengers as $pid) {
            $tempp = "INSERT INTO includes VALUES(:bid, :pid)";
            $inclp = $db -> prepare($tempp);
            $inclp -> bindParam(":bid", $bid);
            $inclp -> bindParam(":pid", $pid);
            $passtat = $inclp -> execute();
        }
        if($passtat) {
            $code += 1;
        } else {
            $code -= 1;
        }
        $newavail = count($passengers);
        $tempu = "UPDATE flights SET f_avail = f_avail - :f_avail WHERE f_id = :f_id";
        $queryu =  $db -> prepare($tempu);
        $queryu -> bindParam(":f_avail", $newavail);
        $queryu -> bindParam(":f_id", $f_id);
        $stat = $queryu -> execute(); 
        if($stat) {
            $code += 1;
        } else {
            $code -= 1;
        }
        echo $code;
    }
?>