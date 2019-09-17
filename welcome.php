<?php
    session_start();
    include("php/dbcon.php");
    if(!isset($_SESSION["username"])) {
        $msg = "Please Login first to complete your bookings..!!";
        echo "<script>alert('".$msg."')</script>";
        header("location: index.php");
    }
    if(isset($_GET["logout"])) {
        session_destroy();
        unset($_SESSION["username"]);
        header("location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Account | FliteLite</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/animate.css">
        <link rel="stylesheet" href="css/owl.carousel.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/owl.carousel.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css"  href="css/style.css">
    </head>
    <body>
        <div class="conatiner-fluid navbg" role="navigation">
            <nav class="navbar navbar-expand-lg navbar-light navbar-custom">
                <a class="navbar-brand animated bounce" href="#">FliteLite<span class="header-red">.</span></a>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="book.php">Book</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Manage</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Hi, <?php echo $_SESSION["username"];?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="welcome.php?logout='1'">Logout</a>
                    </li>
                </ul>
            </nav>
            <div class="row">
                <div class="col-lg-4 offset-lg-1">
                    <h2 class="main-heading animated pulse">Welcome, <?php echo $_SESSION["username"];?><span class="header-red">.</span></h2>
                </div>
                <div class="col-lg-4 offset-lg-1" style="margin-top: 50px;">
                    <h5><span class="header-red">No</span> Flights booked currently<span class="header-red">.</span></h5>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 offset-lg-1">
                    <form>
                        <input type="text" class="form-control main-search" placeholder="Search your bookings">
                    </form>
                </div>
            </div>
        </div>
        <div class="light-div-bckg">
            <div class="container">
                <div class="row">
                    <h2 class="header-blue animated fadeIn">Pending Booking</h2>
                </div>
                <?php
                    if(isset($_POST["b_date"])) {
                        $f_id = $_POST["f_id"];
                        $b_date = $_POST["b_date"];
                        $b_type = $_POST["b_type"];
                        $dataFetchQ = "SELECT user_ID, f_no, f_src, f_dest, f_ppt from users, flights WHERE username = :uname AND f_id = :f_id";
                        $dFQuery = $db -> prepare($dataFetchQ);
                        $dFQuery -> bindParam(":uname", $_SESSION["username"], PDO::PARAM_STR);
                        $dFQuery -> bindParam(":f_id", $f_id, PDO::PARAM_STR);
                        $dFQuery -> execute();
                        $result = $dFQuery -> fetchAll(PDO::FETCH_ASSOC);
                        if($dFQuery -> rowCount() == 1) {
                            foreach($result as $data) {
                                $u_id = $data["user_ID"];
                                $f_no = $data["f_no"];
                                $f_src = $data["f_src"];
                                $f_dest = $data["f_dest"];
                                $f_ppt = $data["f_ppt"];
                            }
                ?>
                <div class="row">
                    <div class="col-lg-6">
                        <h5 class="header-blue">Selected Flight<span class="header-red">:</span> <?php echo $f_no;?></span>
                        <h5 class="header-blue">Flight Date<span class="header-red">:</span> <?php echo $b_date;?></span>
                        <h5 class="header-blue">Flight Leaves From <?php echo $f_src;?> <span class="header-red">to </span><?php echo $f_dest;?></h5>
                        <hr>
                        <h5 class="header-blue">Select Passengers<span class="header-red">:</span></h5>
                        <form method="POST" name="book-final">
                            <?php
                                $tempas = "SELECT p_id, pname, page, pcont FROM passengers WHERE u_id=:uid";
                                $passq = $db -> prepare($tempas);
                                $passq -> bindParam(":uid", $u_id,PDO::PARAM_STR);
                                $passq -> execute();
                                $passengers = $passq -> fetchAll();
                                foreach($passengers as $pass) {
                            ?>
                            <div class="form-row">
                                <div class="form-check">
                                    <input type="checkbox" class="sel-pass" name="passn[]" value="<?php echo $pass['p_id'];?>">
                                    <label class="header-blue mb-1"><?php echo $pass["pname"];?></label>
                                </div>
                            </div>
                            <?php
                                }
                            ?>
                            <h5 class="header-blue" id="price"></h5>
                            <input type="button" name="price-check" class="btn btn-custom" value="Check Price">
                            <input type="button" name="pass-book" class="btn btn-custom" value="Book Flight">
                        </form>
                    </div>
                </div>
                <?php
                        } else {
                            $msg = "Some Error Occurred";
                            echo "<script>alert('".$msg."')</script>";
                        }
                    } else {
                ?>
                <div class="row">
                    <h4 class="header-blue animated fadeIn">No pending bookings<span class="header-red">.</span></h4>
                </div>
                <?php
                    }
                ?>
            </div>
        </div>
        <div class="dark-div-bckg">
            <div class="container">
                <div class="row">
                    <h2 class="header-blue animated fadeIn">Booking History</h2>
                </div>
            </div>
        </div>
        <div class="light-div-bckg">
            <div class="container">
                <div class="row">
                    <h2 class="header-blue animated fadeIn">Referrals</h2>
                </div>
            </div>
        </div>
        <div class="dark-div-bckg">
            <div class="container">
                <div class="row">
                    <h2 class="header-blue animated fadeIn">Plus FliteMiles</h2>
                </div>
            </div>
        </div>
        <footer>
            <div class="footer-bckg">
                <div class="container">
                    <div class="row">
                        <h5>FliteLite<span class="header-red">.</span></h5>
                        <a href="#"><i class="ml-2 fa fa-facebook-f" style="margin-top:5px;"></i></a>
                        <a href="#"><i class="ml-2 fa fa-instagram" style="margin-top:5px;"></i></a>
                        <a href="#"><i class="ml-2 fa fa-twitter" style="margin-top:5px;"></i></a>
                    </div>
                </div>
            </div>
        </footer>
        <script>
            function checkPrice() {
                var final_cost = 0;
                var nop = $(".sel-pass:checked").length;
                var ppt = parseInt(<?php echo $f_ppt;?>);
                final_cost = ppt*nop;
                return final_cost;
            }
            $(document).ready(function() {
                $("input[name='price-check']").click(function() {
                    var final_cost = checkPrice();
                    console.log(final_cost);
                    if(final_cost > 0) {
                        $("#price").html("Final Cost<span class='header-red'>:</span> "+final_cost);
                    } else {
                        $("#price").html("");
                        alert("Please select a passenger..!!");
                    }
                });
                $("input[name='pass-book']").click(function() {
                    var final_cost = checkPrice();
                    var dataSend = $("form[name='book-final']").serialize() + "&pass-sub=1&cost=" + final_cost + "&uid="+<?php echo $u_id?>+"&f_id="+<?php echo $f_id?>+"&b_date=<?php echo $b_date?>&b_type=<?php echo $b_type?>&b_dest=<?php echo $f_dest?>&b_src=<?php echo $f_src?>";
                    console.log(dataSend);
                    if($(".sel-pass:checked").length > 0) {
                        $.ajax({
                            url: "php/book_process.php",
                            method: "POST",
                            data: dataSend,
                            success: function(data) {
                                alert(data);
                            }
                        });
                    } else {
                        alert("Please select a passenger..!!");
                    }
                });
            });
        </script>
    </body>
</html>