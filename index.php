<!--BEGIN Code Dynamic carousel-->
<?php

function make_query() {
    $db = Database::connect();
    $statement = $db->query('SELECT * FROM persons ORDER BY id ASC');
    $persons= $statement->fetchAll();
    return $persons;
}

function make_slide_indicators() {
    $output = '';
    $count = 0;
    $persons = make_query();
    foreach($persons as $person) {
        if($count == 0) {
            $output .= '
   <li data-target="#indicators" data-slide-to="'.$count.'" class="active"></li>
   ';
        }
        else {
            $output .= '
   <li data-target="#indicators" data-slide-to="'.$count.'"></li>
   ';
        }
        $count = $count + 1;
    }
    return $output;
}

function make_slides()
{
    $output = '';
    $count = 0;
    $persons= make_query();
    foreach($persons as $person) {
        if($count == 0)
        {
            $output .= '<div class="carousel-item active">';
        }
        else
        {
            $output .= '<div class="carousel-item">';
        }
        $output .= '
   <img src="assets/img/'.$person['image'].'" alt="" class="rounded-circle mb-5 border border-danger">
        <blockquote class="blockquote">
            <p class="mb-3">'.$person['text1'].'</p>
            <p class="blockquote-footer">'.$person['text2'].'</p>
        </blockquote>
  </div>
  ';
        $count = $count + 1;
    }
    return $output;
}

?>
<!--END Code Dynamic carousel-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GYMPUS</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link
            href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:ital,wght@0,200;0,300;0,400;0,600;0,700;0,900;1,200;1,300;1,400;1,600;1,700;1,900&display=swap"
            rel="stylesheet">
    <script src="https://kit.fontawesome.com/4bea204677.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
</head>

<body data-spy='scroll' data-target='#navbar'>
<header>
    <!--test git add-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light py-md-3 py-0" id="navbar">
        <div class="container">
            <a href="#" class="navbar-brand font-weight-bold font-italic">
                <span class="text-danger">Gym</span>pus
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-content">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar-content">
                <ul class="navbar-nav ml-auto font-weight-bolder text-uppercase">
                    <li class="nav-item">
                        <a href="#home" class="nav-link">home</a>
                    </li>
                    <li class="nav-item">
                        <a href="#services" class="nav-link">services</a>
                    </li>
                    <li class="nav-item">
                        <a href="#classes" class="nav-link">classes</a>
                    </li>
                    <li class="nav-item">
                        <a href="#testimonial" class="nav-link">testimonial</a>
                    </li>
                    <li class="nav-item">
                        <a href="#gallery" class="nav-link">gallery</a>
                    </li>
                    <li class="nav-item">
                        <a href="#contact" class="nav-link">contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="home" id="home">
        <div class="container">
            <div class="home-content">
                <h1 class="font-weight-bolder font-italic text-uppercase text-white">
                    join us <br> to be stronger <br> than you
                </h1>
            </div>
        </div>
    </div>
</header>
<section class="speciality">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6 bg-secondary">
                <div class="text-center p-5">
                    <div class="py-4">
                        <img src="assets/img/1.png" alt="">
                    </div>
                    <div class="featured-content">
                        <h2 class="text-white text-uppercase font-weight-bolder font-italic pb-4">
                            equipments
                        </h2>
                        <p class="text-white-50">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                            officia deserunt mollit anim id est laborum.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 bg-dark">
                <div class="text-center p-5">
                    <div class="py-4">
                        <img src="assets/img/2.png" alt="">
                    </div>
                    <div class="featured-content">
                        <h2 class="text-white text-uppercase font-weight-bolder font-italic pb-4">
                            great pt
                        </h2>
                        <p class="text-white-50">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                            officia deserunt mollit anim id est laborum.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 bg-secondary">
                <div class="text-center p-5">
                    <div class="py-4">
                        <img src="assets/img/3.png" alt="">
                    </div>
                    <div class="featured-content">
                        <h2 class="text-white text-uppercase font-weight-bolder font-italic pb-4">
                            heart rate
                        </h2>
                        <p class="text-white-50">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                            officia deserunt mollit anim id est laborum.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 bg-dark">
                <div class="text-center p-5">
                    <div class="py-4">
                        <img src="assets/img/2.png" alt="">
                    </div>
                    <div class="featured-content">
                        <h2 class="text-white text-uppercase font-weight-bolder font-italic pb-4">
                            And more
                        </h2>
                        <p class="text-white-50">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                            officia deserunt mollit anim id est laborum.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="services" class="text-center services">
    <h2 class="section-title text-uppercase font-weight-bolder font-italic pb-5 display-3">
        what you'll get
    </h2>
    <div class="container">
        <div class="row">
            <?php
            require 'assets/admin/database.php';
            $db = Database::connect();
            $statement = $db->query('SELECT * FROM featurs');
            $featurs = $statement->fetchAll();
            foreach ($featurs as $featur)
            {
                echo '<div class="col-lg-4">';
                echo '<div class="card mb-4">';
                echo '<img src="assets/img/' . $featur['image'] . '" alt="" class="card-img-top">';
                echo '<div class="card-body py-5">';
                echo '<h3 class="card-title font-weight-bolder font-italic pb-4">';
                echo $featur['name'];
                echo '</h3>';
                echo '<p class="card-text text-muted px-4">Some quick example text to build on the card title and make up the bulk of the card\'s content.</p>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</section>
<section id="classes" class="text-center classes">
    <h2 class="section-title text-uppercase font-weight-bolder font-italic pb-5 display-3">
        the classes
    </h2>
    <div class="container">
        <div class="row">

                        <?php
                        $statement = $db->query('SELECT * FROM classes');
                        $classes = $statement->fetchAll();
                        foreach ($classes as $class)
                        {
                            echo '<div class="col-md-6 mb-5">';
                            echo '<div class="class-item bg-white d-lg-flex d-block text-center text-lg-left">';
                            echo '<div class="thumb">';
                                echo '<img src="assets/img/' . $class['image'] . '" alt="" srcset="">';
                            echo '</div>';
                            echo '<div class="class-info p-5">';
                                echo '<h3 class="font-weight-bold font-italic">' . $class['name'] . '</h3>';
                                echo '<p class="text-muted font-weight-bolder">Maximum:' . $class['max'] . 'persons</p>';
                                echo '<h4 class="text-danger font-italic pb-5">$' . $class['price'] . '/year</h4>';
                                echo '<a href="#" class="btn btn-outline-danger">JOIN NOW</a>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                        ?>
        </div>
    </div>

</section>

<!--Begin carousel part-->
<section id="testimonial" class="container-fluid pt-5">
    <div class="carousel slide" id="indicators">
        <ol class="carousel-indicators">
            <?php echo make_slide_indicators(); ?>
        </ol>
        <div class="carousel-inner text-center text-white pt-5">
            <?php echo make_slides(); ?>
        </div>
        <a href="#indicators" class="carousel-control-prev" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>
        <a href="#indicators" class="carousel-control-next" role="button" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div>
</section>
<!--End of carousel part-->
<section class="gallery" id="gallery">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="assets/img/1.jpg" class="gallery-item">
                    <img src="assets/img/1.jpg" alt="" class="img-fluid">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="assets/img/2.jpg" class="gallery-item">
                    <img src="assets/img/2.jpg" alt="" class="img-fluid">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="assets/img/3.jpg" class="gallery-item">
                    <img src="assets/img/3.jpg" alt="" class="img-fluid">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="assets/img/4.jpg" class="gallery-item">
                    <img src="assets/img/4.jpg" alt="" class="img-fluid">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="assets/img/5.jpg" class="gallery-item">
                    <img src="assets/img/5.jpg" alt="" class="img-fluid">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="assets/img/6.jpg" class="gallery-item">
                    <img src="assets/img/6.jpg" alt="" class="img-fluid">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="assets/img/7.jpg" class="gallery-item">
                    <img src="assets/img/7.jpg" alt="" class="img-fluid">
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-6">
                <a href="assets/img/8.jpg" class="gallery-item">
                    <img src="assets/img/8.jpg" alt="" class="img-fluid">
                </a>
            </div>
        </div>
    </div>
</section>

<footer id="contact">
    <div class="contact-widget py-5">
        <div class="container">
            <div class="text-center font-weight-bold font-italic text-uppercase small">
                <a href="#" class="navbar-brand font-weight-bold font-italic text-white">
                    <span class="text-danger">Gym</span>pus
                </a>
                <p class="py-3">
                    LOUNGE 10 - PALACE BUILDING - 221B BAKER STREET - <br>
                    LONDON - UNITED KINGDOM
                </p>
                <ul class="list-unstyled info">
                    <li><span class="text-white">E :</span><a href=""> INFO@YOURDOMAIN.COM</a></li>
                    <li><span class="text-white">P :</span> (+01). 234. 567. 890</li>
                </ul>
                <ul class="list-inline footer-social pt-4">
                    <li class="list-inline-item"><a href="#"><i class="fab fa-facebook fa-2x"></i></a></li>
                    <li class="list-inline-item"><a href="#"><i class="fas fa-basketball-ball fa-2x"></i></a></li>
                    <li class="list-inline-item"><a href="#"><i class="fab fa-skype fa-2x"></i></a></li>
                    <li class="list-inline-item"><a href="#"><i class="fab fa-youtube fa-2x"></i></a></li>
                    <li class="list-inline-item"><a href="#"><i class="fab fa-twitter fa-2x"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright-area py-4">
        <div class="container">
            <div class="text-center">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item">© Canopus. All right reserved</li>
                    <li class="list-inline-item"><a href="#">Terms & Conditions</a></li>
                    <li class="list-inline-item"><a href="#">Our policies</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>


<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.magnific-popup.min.js"></script>
<script src="assets/js/script.js"></script>
</body>

</html>