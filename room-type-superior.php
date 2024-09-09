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
            height: 320px;
        }
    </style>
</head>

<body>
    <?php require('inc/header.php') ?>

    <div class="container-fluid my-4 px-5">
        <div class="row">

            <div class="col-12 my-5 mb-4">
                <h1 class="fw-semibold c-font fs-48">Superior</h1>
                <div style="font-size: 14px;">
                    <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
                    <span class="text-secondary"> > </span>
                    <a href="room.php" class="text-secondary text-decoration-none">ROOMS</a>
                </div>
            </div>

            <div class="col-lg-8">
                <img src="src/carousel1.jpg" class="img-fluid" alt="...">
            </div>

            <div class="col-lg-4">
                <img src="src/carousel1.jpg" class="img-fluid mb-3" alt="...">
                <img src="src/carousel1.jpg" class="img-fluid" alt="...">
            </div>

            <div class="col-8 mt-5">
                <div class="mb-5">
                    <h5 class="mb-3">Description</h5>
                    <p>
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quam ea fugit at et vero doloremque voluptas? Possimus,
                        voluptates blanditiis aperiam tempora, ad et provident ipsum nobis voluptas, pariatur inventore temporibus.
                        Laudantium nam placeat nostrum eligendi numquam in corporis natus soluta aut deleniti earum aliquam quia molestias,
                        esse cumque a repellendus quibusdam rerum iusto incidunt ad vitae. Qui quas, molestias voluptatem placeat cumque consequuntur itaque doloribus dolore.
                        Ratione animi officiis ab minima autem, quisquam temporibus vel quaerat, aliquam magni distinctio dolores quibusdam similique accusantium enim dignissimos recusandae facere iusto? Aut aliquam odio quidem consequuntur est minus sunt totam esse eum excepturi.
                    </p>
                </div>
                <div class="mb-5">
                    <h5 class="mb-3">Facilities</h5>
                    <span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1' style='font-size: 16px;'>
                        <i class='bi bi-cup-hot me-1' style='font-size: 20px;'></i> Breakfast
                    </span>   
                    <span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1' style='font-size: 16px;'>
                        <i class='bi bi-wifi me-1' style='font-size: 20px;'></i> Wifi
                    </span>
                    <span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1' style='font-size: 16px;'>
                        <i class='bi bi-tv me-1' style='font-size: 20px;'></i> Smart Tv
                    </span>
                    <span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1' style='font-size: 16px;'>
                        <i class='bi bi-file-lock me-1' style='font-size: 20px;'></i> Smart door lock
                    </span>            
                </div>
            </div>

            <div class="col-4 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-4">
                            <span>Start from</span>
                            <h3 class="mt-1">฿2,500</h5>
                        </div>
                        <div class="mb-4">
                            <h5>Features</h5>
                            <span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1' style="font-size: 14px;">bedroom</span>   
                            <span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1' style="font-size: 14px;">kitchen</span>   
                        </div>
                        <div class="mb-4">
                            <h5>Guest</h5>
                            <span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1' style="font-size: 14px;">2 Adults</span>   
                            <span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1' style="font-size: 14px;">1 Children</span>   
                        </div>
                        <div class="mb-4">
                            <h5>Area</h5>
                            <span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1' style="font-size: 14px;">300 sq. ft.</span>   
                        </div>
                        <a href="#" class="btn w-100 text-white custom-bg shadow-none mb-2">Book Now</a>
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