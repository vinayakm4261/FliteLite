<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>FliteLite | Airline Reservation</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/animate.css">
        <link rel="stylesheet" href="css/owl.carousel.css">
        <style>
            .owl-prev {
                position: absolute;
                z-index: 10;
                display: inline-block;
                left: -92px;
                cursor: pointer;
                top: 37%;
                width: 95px;
                height: 140px;
            }
            .owl-next {
                position: absolute;
                z-index: 10;
                display: inline-block;
                right: -90px;
                cursor: pointer;
                top: 37%;
                width: 95px;
                height: 140px;
            }
            img {
                border-radius: 10px;
                width: 20rem;
                height: 213.6;
            }
            .row-img {
                display: flex;
                flex-wrap: wrap;
                padding: 0 4px;
            }
            .column {
                flex: 25%;
                max-width: 25%;
                padding: 0 4px;
            }
            .column img {
                margin-top: 8px;
                vertical-align: middle;
                width: 100%;
            }
            @media screen and (max-width: 800px) {
                .column {
                    flex: 50%;
                    max-width: 50%;
                }
            }
            @media screen and (max-width: 600px) {
                .column {
                    flex: 100%;
                    max-width: 100%;
                }
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Images</h2>
                    <div class="owl-carousel owl-theme loop">
                        <div>
                            <div class="item" style="width: 20rem;">
                                <img src="images/work-2.jpg">
                            </div>
                        </div>
                        <div>
                            <div class="item" style="width: 20rem;">
                                <img src="images/image_5.jpg">
                            </div>
                        </div>
                        <div>
                            <div class="item" style="width: 20rem;">
                                <img src="images/image_6.jpg">
                            </div>
                        </div>
                        <div>
                            <div class="item" style="width: 20rem;">
                                <img src="images/work-2.jpg">
                            </div>
                        </div>
                        <div>
                            <div class="item" style="width: 20rem;">
                                <img src="images/image_5.jpg">
                            </div>
                        </div>
                        <div>
                            <div class="item" style="width: 20rem;">
                                <img src="images/image_6.jpg">
                            </div>
                        </div>
                        <?php
                            $dirname = "images/";
                            $images = glob($dirname."*.jpg");
                            foreach($images as $image) {
                                echo '<div>';
                                echo '<div class="item" style="width: 20rem;">';
                                echo '<img src="'.$image.'" height="213.6"/>';
                                echo '</div>';
                                echo '</div>';
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="owl-carousel owl-theme">
                        <div>
                            <div class="item" style="width: 20rem;">
                                <img src="images/work-2.jpg">
                            </div>
                        </div>
                        <div>
                            <div class="item" style="width: 20rem;">
                                <img src="images/image_5.jpg">
                            </div>
                        </div>
                        <div>
                            <div class="item" style="width: 20rem;">
                                <img src="images/image_6.jpg">
                            </div>
                        </div>
                        <div>
                            <div class="item" style="width: 20rem;">
                                <img src="images/work-2.jpg">
                            </div>
                        </div>
                        <div>
                            <div class="item" style="width: 20rem;">
                                <img src="images/image_5.jpg">
                            </div>
                        </div>
                        <div>
                            <div class="item" style="width: 20rem;">
                                <img src="images/image_6.jpg">
                            </div>
                        </div>
                        <?php
                            $dirname = "images/";
                            $images = glob($dirname."*.jpg");
                            foreach($images as $image) {
                                echo '<div>';
                                echo '<div class="item" style="width: 20rem;">';
                                echo '<img src="'.$image.'" height="213.6"/>';
                                echo '</div>';
                                echo '</div>';
                            }
                        ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h4>Images 2</h4>
                    <div class="row-img">
                        <div class="column">
                            <img src="images/image_6.jpg">
                            <img src="images/jadeocean.jpg">
                            <img src="images/work-2.jpg">
                            <img src="images/image_2.jpg">
                            <img src="images/DSC_0067.jpg">
                            <img src="images/image_5.jpg">
                            <img src="images/DSC_0001.jpg">
                        </div>
                        <?php
                            $dirname = "images/";
                            $images = glob($dirname."*.jpg");
                            echo '<div class="column">';
                            for($i=0; $i<7; $i++) {
                                echo '<img src="'.$images[$i].'">';
                            }
                            echo '</div>';
                            echo '<div class="column">';
                            for($i=0; $i<7; $i++) {
                                echo '<img src="'.$images[$i].'">';
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/owl.carousel.js"></script>
        <script>
            $(document).ready(function() {
                $('.loop').owlCarousel({
                    center: true,
                    items: 4,
                    loop:true,
                    autoWidth: true,
                    margin:10,
                    nav: true,
                    navText : ["<--","-->"],
                    responsive:{
                        600:{
                            items:4
                        }
                    }
                });
                $('.owl-carousel').owlCarousel({
                    // stagePadding: 50,
                    margin: 10,
                    loop: true,
                    autoWidth: true,
                    items: 4,
                    nav: true,
                    navText : ["<--","-->"]
                });
            });
        </script>
    </body>