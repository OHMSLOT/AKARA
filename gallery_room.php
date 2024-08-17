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
                <div class="card">
                    <img style="margin-bottom: 0; height: 270px" class="card-img image content" src="src/room.jpg" alt="">
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




    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Launch demo modal
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <!-- <div class="modal-body">
                    <div id="carouselExampleFade" class="carousel slide carousel-fade">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="card-img image" src="src/LINE_ALBUM_Deluxe room  Thai Akara_240716_1.jpg" alt="">
                            </div>
                            <div class="carousel-item">
                                <img class="card-img image" src="src/LINE_ALBUM_Public Area _Thai Akara_240808_5.jpg" alt="">
                            </div>
                            <div class="carousel-item">
                                <img class="card-img image" src="src/LINE_ALBUM_Superior room Thai Akara_240716_1.jpg" alt="">
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div> -->
                <div class="modal-body">
                    <div class="d-flex justify-content-end mb-2">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="container-fluid p-0">
                        <div id="carouselExampleFade" class="carousel slide carousel-fade">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img class="card-img image" src="src/LINE_ALBUM_Deluxe room  Thai Akara_240716_1.jpg" alt="">
                                </div>
                                <div class="carousel-item">
                                    <img class="card-img image" src="src/LINE_ALBUM_Public Area _Thai Akara_240808_5.jpg" alt="">
                                </div>
                                <div class="carousel-item">
                                    <img class="card-img image" src="src/LINE_ALBUM_Superior room Thai Akara_240716_1.jpg" alt="">
                                </div>
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
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