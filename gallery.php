<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require('inc/links.php') ?>
    <style>
        .content{
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            position: absolute;
            background:rgba(0,0,0,0.6) ;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            opacity: 0;
            transition: 0.6s;
        }

        .content:hover{
            opacity: 1;
        }

        /* .gal {
            opacity: 0;
            background: rgba(0,0,0,.54);
            transition: opacity .4s;
        } */

        .gal:hover {
            filter: grayscale(100%);
            transition: all 0.4s;
            /* opacity: 1; */
        }

        /* .gal a {
            background: rgba(0, 0, 0, .54);
            z-index: 5;
            opacity: 0;
            transition: opacity .4s;
        }

        .gal:hover a {
            opacity: 1;
        } */

        .filter h5 {
            color: #fff;
        }

        .filter {
            position: absolute;
            z-index: 5;
            opacity: 0;
            transition: opacity .4s;
        }

        .filter:hover {
            opacity: 1;
        }

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