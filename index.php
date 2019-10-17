<?php
    @session_start();
    if(isset($_GET["logout"])) {
        session_destroy();
        unset($_SESSION["username"]);
        header("location: index.php");
    }
    if(isset($_SESSION["username"])) {
        $hello = "Hi, ".$_SESSION['username'];
        $hello_link = "welcome.php";
        $action = "Logout";
        $action_link = "index.php?logout='1'";
        $data1 = "#";
        $data2 = "#";
        $data3 = "#";
    } else {
        $hello = "Sign-up";
        $hello_link = "#";
        $action = "Login";
        $action_link = "#";
        $data1 = "modal";
        $data2 = "#registerModal";
        $data3 = "#loginModal";
    }
?>
<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>FliteLite | Airline Reservation</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="css/animate.css">
        <link rel="stylesheet" href="css/owl.carousel.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css"  href="css/style.css">
    </head>
    <body>
        <div class="conatiner-fluid navbg" role="navigation">
            <nav class="navbar navbar-expand-lg navbar-light navbar-custom navbar-collapse-xs">
                <a class="navbar-brand animated bounce" href="index.php">FliteLite<span class="header-red">.</span></a>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="book.php">Book</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $hello_link ?>" data-toggle="<?php echo $data1 ?>" data-target="<?php echo $data2 ?>"><?php echo $hello ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $action_link ?>" data-toggle="<?php echo $data1 ?>" data-target="<?php echo $data3 ?>"><?php echo $action ?></a>
                    </li>
                </ul>
            </nav>
            <div class="row">
                <div class="col-lg-4 offset-lg-1">
                    <h2 class="main-heading animated pulse">Search Flights<span class="header-red">.</span></h2>
                    <form method="POST" action="book.php">
                        <input type="text" class="form-control main-search" name="src" placeholder="Source">
                        <input type="text" class="form-control main-search" name="dest" placeholder="Destination">
                        <button class="form-control main-search search-sub mr-2" type="submit" name="search-sub">
                            <i class="fa fa-plane"></i>
                        </button>
                    </form>
                </div>
                <div class="col-lg-4 offset-lg-1" style="margin-top: 50px;">
                    <h5>Book Flights, <span class="header-red">Check-in</span>, Check Flight status and <span class="header-red">much more.</span></h5>
                </div>
            </div>
        </div>
        <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <form class="form" method="POST" action="index.php">
                            <?php
                                include("php/login.php");
                                include("php/errors.php"); ?>
                            <div class="form-group">
                                <img src="images/login_avatar.png" class="avatar-img" alt="Avatar" height="100" width="100">
                                <h4 class="login-header">Login</h4>
                            </div>
                            <div class="form-group">
                                <label for="uname"><b>Username</b></label>
                                <input type="text" placeholder="Enter Username" name="uname" class="form-control" autofocus="autofocus" required>
                            </div>
                            <div class="form-group">
                                <label for="passw"><b>Password</b></label>
                                <input type="password" placeholder="Enter Password" name="passw" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <input class="btn btn-primary form-control" value="Login" type="submit" name="loginSub">
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
                    <h2 class="header-blue animated fadeIn">Top Destinations</h2>
                </div>
                <div class="row">
                    <div class="owl-carousel owl-theme">
                        <div>
                            <div class="card" style="width: 20rem;">
                                <img src="images/work-2.jpg">
                                <div class="card-body">
                                    <h5 class="card-title">Destination 0</h5>
                                    <p class="card-text">Some quick example text to build on..</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="card item" style="width: 20rem;">
                                <img src="images/image_5.jpg">
                                <div class="card-body">
                                    <h5 class="card-title">Destination 1</h5>
                                    <p class="card-text">Some quick example text to build on..</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="card item" style="width: 20rem;">
                                <img src="images/image_6.jpg">
                                <div class="card-body">
                                    <h5 class="card-title">Destination 2</h5>
                                    <p class="card-text">Some quick example text to build on..</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="card item" style="width: 20rem;">
                                <img src="images/work-2.jpg">
                                <div class="card-body">
                                    <h5 class="card-title">Destination 3</h5>
                                    <p class="card-text">Some quick example text to build on..</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="card item" style="width: 20rem;">
                                <img src="images/image_5.jpg">
                                <div class="card-body">
                                    <h5 class="card-title">Destination 4</h5>
                                    <p class="card-text">Some quick example text to build on..</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                        <div>
                            <div class="card item" style="width: 20rem;">
                                <img src="images/image_6.jpg">
                                <div class="card-body">
                                    <h5 class="card-title">Destination 5</h5>
                                    <p class="card-text">Some quick example text to build on..</p>
                                    <a href="#" class="btn btn-primary">Go somewhere</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="dark-div-bckg">
            <div class="container">
                <div class="row">
                    <h2 class="header-blue animated fadeIn">Offers</h2>
                </div>
            </div>
        </div>
        <div class="light-div-bckg">
            <div class="container">
                <div class="row">
                    <h2 class="header-blue animated fadeIn">Plus Membership</h2>
                </div>
            </div>
        </div>
        <div class="dark-div-bckg">
            <div class="container">
                <div class="row">
                    <h2 class="header-blue animated fadeIn">Travel Partners</h2>
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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/owl.carousel.js"></script>
        <script>
            $(document).ready(function() {
                $('.owl-carousel').owlCarousel({
                    margin: 10,
                    loop: true,
                    autoWidth: true,
                    items: 4,
                    nav: true,
                    navText : ["<i class='fa fa-chevron-left'></i>","<i class='fa fa-chevron-right'></i>"]
                });
            });
        </script>
    </body>
</html>