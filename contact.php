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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css"  href="css/style.css">
    </head>
    <body>
        <div class="conatiner-fluid navbg-small" role="navigation">
            <nav class="navbar navbar-expand-lg navbar-light navbar-custom navbar-collapse-xs">
                <a class="navbar-brand animated bounce" href="index.php">FliteLite<span class="header-red">.</span></a>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="book.php">Book</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="#">Contact</a>
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
                    <h2 class="main-heading animated pulse">Contact Us<span class="header-red">.</span></h2>
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
    </body>
</html>