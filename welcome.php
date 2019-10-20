<?php
    @session_start();
    include("php/dbcon.php");
    $uid = $_SESSION["uid"];
    if(!isset($_SESSION["username"])) {
        $msg = "Please login first..!!";
        echo "<script>alert('".$msg."')</script>";
        header("location: index.php");
    }
    if(isset($_GET["logout"])) {
        session_destroy();
        unset($_SESSION["username"]);
        header("location: index.php");
    }
    if(isset($_POST["username"])) {
        $last = $db -> prepare("SELECT b_date, b_dest, b_src FROM bookings ORDER BY book_id DESC LIMIT 1");
        $last -> execute();
        $res = $last -> fetch();
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
        <div class="navbg navbg-resp" role="navigation">
            <nav class="navbar navbar-expand-lg navbar-light navbar-custom">
                <a class="navbar-brand animated bounce" href="index.php">FliteLite<span class="header-red">.</span></a>
                <button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Account</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="book.php">Book</a>
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
                <div class="col-lg-4 offset-lg-1 col-md-8 offset-md-2 col-sm-12 main-subheading" style="margin-top: 50px;">
                    <h5><span class="header-red">No</span> Flights booked currently<span class="header-red">.</span></h5>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 offset-lg-1 col-sm-12 col-md-8 main-headsearch">
                    <form>
                        <input type="text" class="form-control main-search" placeholder="Search your bookings">
                    </form>
                </div>
            </div>
        </div>
        <div class="light-div-bckg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="header-blue animated fadeIn">Pending Booking</h2>
                    </div>
                </div>
                <?php
                    if(isset($_POST["b_date"])) {
                        $f_id = $_POST["f_id"];
                        $b_date = $_POST["b_date"];
                        $b_type = $_POST["b_type"];
                        $dataFetchQ = "SELECT f_no, f_src, f_dest, f_ppt from flights WHERE f_id = :f_id";
                        $dFQuery = $db -> prepare($dataFetchQ);
                        $dFQuery -> bindParam(":f_id", $f_id, PDO::PARAM_STR);
                        $dFQuery -> execute();
                        $result = $dFQuery -> fetchAll(PDO::FETCH_ASSOC);
                        if($dFQuery -> rowCount() == 1) {
                            foreach($result as $data) {
                                $f_no = $data["f_no"];
                                $f_src = $data["f_src"];
                                $f_dest = $data["f_dest"];
                                $f_ppt = $data["f_ppt"];
                            }
                ?>
                <div class="row" id="finalForm">
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
                                $passq -> bindParam(":uid", $uid,PDO::PARAM_STR);
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
                <div class="row" id="finalComplete" style="display:none;">
                    <div class="alert alert-success">
                        <h4 class="header-blue animated fadeIn">Booking Completed Successfully..<span class="header-red">!!</span></h4>
                    </div>
                </div>
                <?php
                        } else {
                            $msg = "Some Error Occurred";
                            echo "<script>alert('".$msg."')</script>";
                        }
                    } else {
                        $f_ppt = "5";
                ?>
                <div class="col-lg-12">
                    <div class="row">
                        <h4 class="header-blue animated fadeIn">No pending bookings<span class="header-red">.</span></h4>
                    </div>
                </div>
                <?php
                    }
                ?>
            </div>
        </div>
        <div class="dark-div-bckg">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <h2 class="header-blue animated fadeIn">Manage Passengers</h2>
                        <h4 class="header-blue">Add Passengers</h4>
                        <form name="add-pass">
                            <div class="form-group">
                                <label for="pname">Passenger Name:</label>
                                <input type="text" name="pname" class="form-control book-search" placeholder="Enter passenger name here..">
                            </div>
                            <div class="form-group">
                                <label for="pname">Passenger Address:</label>
                                <input type="text" name="paddr" class="form-control book-search" placeholder="Enter passenger address here..">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-6">
                                    <label for="page">Passenger Age:</label>
                                    <input type="number" name="page" class="form-control book-search" placeholder="Enter passenger age here..">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="pcont">Passenger Contact Number:</label>
                                    <input type="number" name="pcont" class="form-control book-search" placeholder="Enter passenger contact here..">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="button" id="passAdd" value="Add Passenger" class="btn btn-custom">
                            </div>
                        </form>
                        <div class="alert alert-success" id="successAdd">
                            Passenger Edited Successfully
                        </div>
                        </form>
                        <div class="alert alert-info" id="failureAdd">
                            An Error Occurred
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <h4 class="header-blue">Edit Passenger Details</h4>
                        <form name="edit-pass">
                            <div class="form-group">
                                <select class="form-control" name="edit-pass-sel">
                                    <option disabled selected>Select Passenger</option>
                                    <?php                                        
                                        $tempas = "SELECT p_id, pname FROM passengers WHERE u_id=:uid";
                                        $passq = $db -> prepare($tempas);
                                        $passq -> bindParam(":uid", $uid,PDO::PARAM_STR);
                                        $passq -> execute();
                                        $passengers = $passq -> fetchAll();
                                        foreach($passengers as $pass) {
                                    ?>
                                        <option><?php echo $pass["pname"];?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form=group">
                                <input type="button" id="editPass1" class="btn btn-custom" value="Select Passenger">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row" id="passData">
                    <div class="col-lg-6">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Address</th>
                                    <th>Age</th>
                                    <th>Contact</th>
                                </tr>
                            </thead>
                            <tbody id="addPassData">
                            </tbody>
                        </table>
                        <h4 class="header-blue">Edit Details</h4>
                        <form name="edit-single">
                            <div class="form-group">
                                <label for="paname">Passenger Name:</label>
                                <input type="text" name="paname" class="form-control book-search">
                            </div>
                            <div class="form-group">
                                <label for="paaddr">Passenger Address:</label>
                                <input type="text" name="paaddr" class="form-control book-search">
                            </div>
                            <div class="form-row">
                                <div class="form-group col-lg-6">
                                    <label for="paage">Passenger Age:</label>
                                    <input type="number" name="paage" class="form-control book-search" placeholder="Enter passenger age here..">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="pacont">Passenger Contact Number:</label>
                                    <input type="number" name="pacont" class="form-control book-search" placeholder="Enter passenger contact here..">
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="hidden" name="paid">
                                <input type="button" id="passEdit" value="Edit Passenger" class="btn btn-custom">
                            </div>
                        </form>
                        <div class="alert alert-success" id="successPass">
                            <p>Passenger Added Successfully</p>
                        </div>
                        </form>
                        <div class="alert alert-info" id="failurePass">
                            <p>An Error Occurred</p>
                        </div>
                    </div>
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
                <?php if(isset($_POST['b_date'])) { ?>
                    $("input[name='pass-book']").click(function() {
                        var final_cost = checkPrice();
                        var dataSend = $("form[name='book-final']").serialize() + "&pass-sub=1&cost=" + final_cost + "&uid="+<?php echo $uid?>+"&f_id="+<?php echo $f_id?>+"&b_date=<?php echo $b_date?>&b_type=<?php echo $b_type?>&b_dest=<?php echo $f_dest?>&b_src=<?php echo $f_src?>";
                        console.log(dataSend);
                        if($(".sel-pass:checked").length > 0) {
                            $.ajax({
                                url: "php/book_process.php",
                                method: "POST",
                                data: dataSend,
                                success: function(data) {
                                    if( data == 3) {
                                        $("#finalForm").hide();
                                        $("#finalComplete").show();
                                    } else {
                                        alert("An error occurred while booking please try again later..\nYou will be redirected to the home page");
                                        var red = window.location.href;
                                        red = red.replace("welcome", "index");
                                        window.location = red;
                                    }
                                }
                            });
                        } else {
                            alert("Please select a passenger..!!");
                        }
                    });
                <?php
                    }
                ?>
                $("#passAdd").click(function() {
                    console.log($("form[name='add-pass']").serialize());
                    $.ajax({
                        url: "php/passengers.php",
                        method: "POST",
                        data: $("form[name='add-pass']").serialize() + "&add-pass=1",
                        success: function(data) {
                            console.log(data);
                            if(data == 1) {
                                $("#successAdd").show();
                            } else if(data == 0) {
                                $("#failureAdd").show();
                            }
                        }
                    });
                });
                $("#editPass1").click(function() {
                    $.ajax({
                        url: "php/passengers.php",
                        method: "POST",
                        data: $("form[name='edit-pass").serialize() + "&edit-pass=1",
                        dataType:"json",
                        success: function(data) {
                            var msg = "<td>"+data.name+"</td><td>"+data.address+"</td><td>"+data.age+"</td><td>"+data.contact+"</td>";
                            $("#addPassData").html(msg);
                            $("input[name='paname']").val(data.name);
                            $("input[name='paaddr']").val(data.address);
                            $("input[name='paage']").val(data.age);
                            $("input[name='pacont']").val(data.contact);
                            $("input[name='paid']").val(data.id);
                            $("#passData").show();
                        }
                    });
                });
                $("#passEdit").click(function() {
                    $("#failurePass").hide();
                    $("#failurePass").hide();
                    $.ajax({
                        url: "php/passengers.php",
                        method: "POST",
                        data: $("form[name='edit-single']").serialize() + "&edit-single=1",
                        success: function(data) {
                            if(data == 1) {
                                $("#successPass").show();
                            } else if(data == 0) {
                                $("#failurePass").show();
                            }
                        }
                    });
                });
            });
        </script>
    </body>
</html>