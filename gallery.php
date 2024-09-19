<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GALLERY</title>
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
            background: rgba(0, 0, 0, .54);
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

        .image:hover {
            filter: grayscale(100%);
        }

        .full:hover {
            filter: grayscale(100%);
        }

        .gallery-item {
            position: relative;
        }

        .gallery-item .overlay {
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
            border-radius: 5px;
        }

        .gallery-item:hover .overlay {
            opacity: 1;
        }

        .gallery-item h5 {
            color: #fff;
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
            <?php
                // Fetch images where thumb = 1
                $gallery_res = mysqli_query($con, "SELECT * FROM gallery_images WHERE thumb = 1");

                // Check if there are thumb images
                if (mysqli_num_rows($gallery_res) > 0) {
                    while ($gallery_data = mysqli_fetch_assoc($gallery_res)) {
                        // Create image path
                        $image_path = GALLERY_IMG_PATH . $gallery_data['image'];

                        // Fetch gallery name using gallery_id (optional if you want to display gallery names)
                        $gallery_id = $gallery_data['gallery_id'];
                        $gallery = mysqli_query($con, "SELECT name FROM gallery WHERE id = $gallery_id");
                        $galleryName = mysqli_fetch_assoc($gallery)['name'];

                        // Display each thumbnail image
                        echo <<<data
                            <div class="col-lg-4 col-md-6 mb-4">
                                <div class="gallery-item">
                                    <div class="card">
                                        <a href="gallery_image.php?id=$gallery_data[gallery_id]">
                                            <img style="margin-bottom: 0; height: 270px" class="card-img image" src="$image_path" alt="">
                                            <div class="overlay">
                                                <h5>$galleryName</h5>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            data;
                    }
                } else {
                    echo '<p class="text-center">No thumbnail images found</p>';
                }
            ?>

        </div>
    </div>

    <?php require('inc/modal-login.php') ?>
    <?php require('inc/modal-register.php') ?>
    <?php require('inc/footer.php') ?>
</body>
<?php require('inc/script.php') ?>
<script>

</script>

</html>