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

    <div class="my-5 px-4">
        <h1 class="fw-semibold c-font text-center">ROOM TYPE</h1>
        <p class="text-center mt-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore, mollitia porro! Illum est, <br>
            at sit eius eveniet corporis accusantium, quae similique unde libero soluta quam aperiam neque facere, quia nam?
        </p>
    </div>

    <div class="container">
        <div class="row">
        <?php

            $room_res = select("SELECT * FROM `rooms` WHERE `status`=? AND `removed`=?", [1, 0], 'ii');

            while ($room_data = mysqli_fetch_assoc($room_res)) {

                // get thumbnail of room

                $room_thumb = ROOMS_IMG_PATH . "thumbnail.jpg";
                $thumb_q = mysqli_query($con, "SELECT * FROM `room_images` WHERE `room_id`='$room_data[id]' AND `thumb`='1'");

                if (mysqli_num_rows($thumb_q) > 0) {
                    $thumb_res = mysqli_fetch_assoc($thumb_q);
                    $room_thumb = ROOMS_IMG_PATH . $thumb_res['image'];
                }

                // print room card

                echo<<<data
                    <div class="col-lg-6 mb-4">
                        <div class="card text-center">
                            <a class="text-decoration-none text-dark" href="room-type-superior.php">
                                <img style="height: 320px;" src="$room_thumb" class="card-img-top image">
                                <div class="card-body">
                                    <h3 class="card-title">$room_data[name]</h3>
                                    <hr>
                                    <p class="card-text">$room_data[description]</p>
                                </div>
                            </a>
                        </div>
                    </div>    
                data;
            }    

        ?>

            <div class="col-lg-6 mb-4">
                <div class="card text-center">
                    <img style="height: 320px;" src="src/LINE_ALBUM_Superior room Thai Akara_240716_1.jpg" class="card-img-top image" alt="...">
                    <div class="card-body">
                        <h3 class="card-title">Superior</h3>
                        <hr>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="card text-center">
                    <img style="height: 320px;" src="src/LINE_ALBUM_Superior room Thai Akara_240716_1.jpg" class="card-img-top image" alt="...">
                    <div class="card-body">
                        <h3 class="card-title">Superior</h3>
                        <hr>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 mb-4">
                <div class="card text-center">
                    <img style="height: 320px;" src="src/LINE_ALBUM_Superior room Thai Akara_240716_1.jpg" class="card-img-top image" alt="...">
                    <div class="card-body">
                        <h3 class="card-title">Superior</h3>
                        <hr>
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
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