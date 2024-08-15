<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require('inc/links.php') ?>
    <style>
        .contents {
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            position: absolute;
            background: rgba(0, 0, 0, 0.6);
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            opacity: 0;
            transition: 0.6s;
        }

        .content:hover {
            opacity: 1;
        }

        .gal {
            opacity: 1;
            background: rgba(0,0,0,.54);
            transition: opacity .4s;
        }

        .gal:hover {
            filter: grayscale(100%);
            transition: all 0.4s;
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
        
        .full:hover{
            filter: grayscale(100%);
        }

        .gallery-item{
            position: relative;
        }

        .gallery-item .img{
            filter: grayscale(0%);
        }

        .gallery-item .overlay{
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            position: absolute;
            background: rgba(0, 0, 0, 0.6);
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            opacity: 0;
            z-index: 1;
            padding: 20px;
            transition: 0.6s;
        }

        .gallery-item:hover .overlay{
            opacity: 1;
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
                    <a href="#"></a>    
                        <img style="margin-bottom: 0; height: 270px;" class="card-img image" src="src/room.jpg" alt="">
                    <div class="contents text-center filter">
                        <h5>ROOM</h5>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="gallery-item">
                    <div class="card">
                        <img style="margin-bottom: 0; height: 270px" class="card-img image" src="src/Swimming_pool.png" alt="">
                        <div class="overlay">
                            <h5>ROOM</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mb-4">
                <div class="card">
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

<li style="background: url('admin/images/1338DN6_0152.jpg') center no-repeat; background-size: cover;">
        	<a href="?page=gallery&amp;a_id=20"></a>
            <div class="contents">
            	<h1>Room</h1>
            </div>
        </li>