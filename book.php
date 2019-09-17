<?php
    $errors = array();
    if(!isset($_SESSION["username"])) {
        include("php/dbcon.php");
    } else {
?>
    <script>
        alert("There's some problem");
    </script>
<?php
    }
    if(isset($_POST["search-sub"])) {
        $source = $_POST["src"];
        $dest = $_POST["dest"];
    } elseif(isset($_POST["flight-srch"])) {
        $source = $_POST["src1"];
        $dest = $_POST["dest1"];   
    } else {
        $source = "";
        $dest = "";
    }
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Book | FliteLite</title>
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
        <div class="conatiner-fluid navbg-small" role="navigation">
            <nav class="navbar navbar-expand-lg navbar-light navbar-custom navbar-collapse-xs">
                <a class="navbar-brand animated bounce" href="index.php">FliteLite<span class="header-red">.</span></a>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="book.php">Book</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#registerModal">Sign-Up</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#loginModal">Login</a>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <form class="form" method="POST" action="index.php" name="loginForm">
                            <?php
                                include("php/login.php");
                                include("php/errors.php"); ?>
                            <div class="form-group">
                                <img src="images/login_avatar.png" class="avatar-img" alt="Avatar" height="100" width="100">
                                <h4 class="login-header">Login</h4>
                            </div>
                            <div class="form-group">
                                <label for="uname"><b>Username</b></label>
                                <input type="text" placeholder="Enter Username" name="uname" class="form-control" required focused>
                            </div>
                            <div class="form-group">
                                <label for="passw"><b>Password</b></label>
                                <input type="password" placeholder="Enter Password" name="passw" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary form-control" value="Login" type="button" name="loginSub">
                                <span class="psw"><a href="#">Forgot password?</a></span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <form class="form" method="POST" action="index.php">
                            <?php
                                include("php/register.php");
                                include("php/errors.php"); ?>
                            <div class="form-group">
                                <img src="images/login_avatar.png" class="avatar-img" alt="Avatar" height="100" width="100">
                                <h4 class="login-header">Sign-Up</h4>
                            </div>
                            <div class="form-group">
                                <label for="email"><b>Name</b></label>
                                <input type="text" placeholder="Enter Email-ID" name="name" class="form-control" required focused>
                            </div>
                            <div class="form-group">
                                <label for="email"><b>Email-ID</b></label>
                                <input type="email" placeholder="Enter Email-ID" name="email" class="form-control" required focused>
                            </div>
                            <div class="form-group">
                                <label for="email"><b>Create Username</b></label>
                                <input type="text" placeholder="Enter Email-ID" name="uname" class="form-control" required focused>
                            </div>
                            <div class="form-group">
                                <label for="passw1"><b>Create Password</b></label>
                                <input type="password" placeholder="Enter Password" name="passw1" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="passw2"><b>Confirm Password</b></label>
                                <input type="password" placeholder="Confirm Password" name="passw2" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary form-control" value="Sign-Up" name="regSub" type="submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="light-div-bckg">
            <div class="container">
                <div class="row">
                    <h2 class="header-blue animated fadeIn">Flights<span class="header-red">.</span></h2>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <form method="POST" action="book.php">
                            <?php include("php/errors.php"); ?>
                            <div class="form-row">
                                <div class="form-group col-lg-6">
                                    <label for="src">Source</label>
                                    <input type="text" name="src1" class="form-control book-search" placeholder="Enter Source" value="<?php echo $source; ?>">
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="dest">Destination</label>
                                    <input type="text" name="dest1" class="form-control book-search" placeholder="Enter Destination" value="<?php echo $dest; ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="date">Departure Date</label>
                                <input type="date" class="form-control book-search" name="date" placeholder="Select Date" value="<?php echo $_POST['date']?>">
                            </div>
                            <div class="form-group">
                                <label for="num-pass">Number of Passengers</label>
                                <input type="number" class="form-control book-search" name="num-pass" placeholder="Enter Number of Passengers" value="<?php echo $_POST['num-pass']?>">
                            </div>
                            <div class="form-check form-check-inline">
                                <!-- <label class="control-label">Return Trip?</label> -->
                                <input type="radio" name="return" value="0" id="rdb1" class="form-check-input" value="<?php echo $_POST['return']?>" required>
                                <label for="rdb1" class="form-check-label">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="return" value="1" id="rdb2" class="form-check-input" value="<?php echo $_POST['return']?>" required>
                                <label for="rdb2" class="form-check-label">No</label>
                            </div>
                            <div class="form-group mt-2">
                                <input type="submit" name="flight-srch" class="form-control book-search" style="width:80px;">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="dark-div-bckg">
            <div class="container">
                <div class="row">
                    <h2 class="header-blue animated fadeIn">Available Flights<span class="header-red">.</span></h2>
                </div>
                <div class="row">
                    <div class="card-deck">
                        <?php
                            if(isset($_POST["flight-srch"])) {
                                $source = $_POST["src1"];
                                $dest = $_POST["dest1"];
                                $date = $_POST["date"];
                                $num = $_POST["num-pass"];
                                $ret = $_POST["return"];
                                if(empty($source)) {
                                    array_push($errors, "Source is required");
                                }
                                if(empty($dest)) {
                                    array_push($errors, "Destination is required");
                                }
                                if(empty($date)) {
                                    array_push($errors, "Date is required");
                                }
                                if(count($errors) == 0) {
                                    $tempq = "SELECT * FROM flights WHERE f_src=:f_src and f_dest=:f_dest and f_avail >= :f_avail";
                                    $query = $db -> prepare($tempq);
                                    $query -> bindParam(":f_src",$source);
                                    $query -> bindParam(":f_dest",$dest);
                                    $query -> bindParam(":f_avail",$num);
                                    $query -> execute();
                                    $result = $query -> fetchAll(PDO::FETCH_ASSOC);
                                    if($query -> rowCount() >= 1) {
                                        foreach($result as $flight) {
                        ?>
                        <div class="card ml-1 card-custom">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $flight["f_no"] ?></h5>
                                <p class="card-text">Flight Departure: <?php echo $flight["d_time"] ?></p>
                                <p class="card-text">Available Seats: <?php echo $flight["f_avail"] ?></p>
                                <p class="card-text">Cost per Ticket: <?php echo $flight["f_ppt"] ?>/-</p>
                                <button type="submit" class="btn btn-custom select-flight" id="<?php echo $flight['f_id'] ?>" style="width:115px;">Select Flight</button>
                            </div>
                        </div>
                        <?php
                                        }
                                    } else {
                        ?>
                    </div>
                    <h5 class="header-blue">Sorry, currently there are no flights available for your preferences<span class="header-red">.</span></h5>
                    <?php
                                    }// else
                                }//if count
                            } //if isset
                    ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="light-div-bckg" id="select-form">
            <div class="container">
                <div class="row">
                    <h2 class="header-blue animated fadeIn">Complete Booking<span class="header-red">.</span></h2>
                </div>
                <div class="row">
                    <h5 id="flight-no" class="header-blue"></h5>
                </div>
                <div class="row">
                    <h5 id="dep-time" class="header-blue"></h5>
                </div>
                <div class="row">
                    <h5 id="flight-det" class="header-blue"></h5>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <form method="POST" action="welcome.php" name="book-submit">
                            <input type="number" name="f_id" style="display: none;">
                            <div class="form-row">
                                <div class="form-group col-lg-6">
                                    <label for="b_date">Flight Date</label>
                                    <input type="date" name="b_date" class="form-control book-search" required>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="b_type">Type of Booking</label>
                                    <input type="text" name="b_type" class="form-control book-search" placeholder="Enter Economy or Business" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="button" name="book-confirm" class="btn btn-custom" value="Confirm Booking">
                            </div>
                        </form>
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
            $(document).ready(function() {
                $(".select-flight").click(function() {
                    var flight_id = $(this).attr("id");
                    $.ajax({
                        url: "php/book_process.php",
                        method: "POST",
                        data: {
                            flight_id: flight_id
                        },
                        dataType:"json",
                        success: function(data) {
                            $("#flight-no").html("Selected Flight<span class='header-red'>:</span> "+data[0].f_no);
                            $("#dep-time").html("Flight Leaves at<span class='header-red'>:</span> "+data[0].d_time);
                            $("#flight-det").html("From "+data[0].f_src+"<span class='header-red'> to</span> "+data[0].f_dest);
                            $("input[name='f_id']").val(data[0].f_id);
                            $("input[name='b_date']").val(data[0].f_date);
                            $("#select-form").show();
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            console.log(xhr);
                            console.log(textStatus);
                            console.log(errorThrown);
                        }
                    });
                });
                $("input[name='book-confirm']").click(function() {
                    var form = $("form[name='book-submit']");
                    <?php
                        if(!isset($_SESSION["username"])) {
                    ?>
                    $("#loginModal").modal("show");
                    $("input[name='loginSub']").click(function() {
                        $("#loginModal").modal("toggle");
                        $.ajax({
                        url: "php/login.php",
                        method: "POST",
                        data: $("form[name='loginForm']").serialize() + "&page=1&loginSub=1",
                        success: function (data) {
                            if (data == "true") {
                                form.submit();
                            } else {
                                console.log("Login Error");
                            }
                        },
                        error: function(xhr, textStatus, errorThrown) {
                            console.log(xhr);
                            console.log(textStatus);
                            console.log(errorThrown);
                        }
                    });
                });
                    <?php
                        } else {
                    ?>
                form.submit();
                    <?php
                        }
                    ?>
                });
            });
        </script>              
    </body>
</html>