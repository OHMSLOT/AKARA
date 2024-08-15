<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require('inc/links.php') ?>
    <style>
        .image {
            display: block;
            width: 100%;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <?php require('inc/header.php') ?>

    <div class="my-5 px-4">
        <h1 class="fw-semibold c-font text-center">GALLERY</h1>
        <p class="text-center mt-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore, mollitia porro! Illum est, <br>
            at sit eius eveniet corporis accusantium, quae similique unde libero soluta quam aperiam neque facere, quia nam?
        </p>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card justify-content-center">
                    <a href="#">
                        <img style="margin-bottom: 0; height: 270px;" class="card-img image" src="src/room.jpg" alt="">
                    </a>
                    <div class="container text-center filter">
                        <h5>ROOM</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card">
                    <img style="margin-bottom: 0; height: 270px" class="card-img image content" src="src/Swimming_pool.png" alt="">
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card gal">
                    <img style="margin-bottom: 0; height: 270px;" class="card-img image" src="src/lobby.jpg" alt="">
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card gal">
                    <img style="margin-bottom: 0; height: 270px;" class="card-img image" src="src/Restaurant.jpg" alt="">
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card gal">
                    <img style="margin-bottom: 0; height: 270px;" class="card-img image" src="src/carousel2.jpg" alt="">
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card gal">
                    <img style="margin-bottom: 0; height: 270px;" class="card-img image" src="src/Fitness.jpg" alt="">
                </div>
            </div>
        </div>
    </div>

    <?php require('inc/modal-login.php') ?>
    <?php require('inc/modal-register.php') ?>
    <?php require('inc/footer.php') ?>
</body>
<?php require('inc/script.php') ?>

</html>