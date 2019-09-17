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
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3168.639290621064!2d-122.08624618473434!3d37.42199987982517!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x808fba02425dad8f%3A0x6c296c66619367e0!2sGoogleplex!5e0!3m2!1sen!2sin!4v1567868798742!5m2!1sen!2sin" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>        <form method="POST" action="welcome.php" name="test-form">
            <input type="submit" class="btn btn-outline-success mt-5" name="test-submit" value="Submit">
        </form>
        <script>
            $("form[name='test-form']").submit(function(e) {
                e.preventDefault();
                $("#loginModal").modal("show");
                $("form[name='loginForm']").submit(function(f) {
                    f.preventDefault();
                    var uname = $("input[name='uname']").val();
                    var passw = $("input[name='passw']").val();
                    var page = "confirm-booking";
                    $("#loginModal").modal("toggle");
                    $.ajax({
                        url: "php/login.php",
                        method: "POST",
                        data: {
                            loginSub: 1,
                            uname: uname,
                            passw: passw,
                            page: page
                        },
                        success: function(data) {
                            console.log(data);
                            if(data == "true") {
                                $("form button[name='book-submit']").submit();
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
            });
        </script>
</body>
</html>