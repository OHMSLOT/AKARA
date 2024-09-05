<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Facilities</title>
    <?php require('inc/links.php') ?>
    <style>
        .pop:hover {
            transform: scale(1.03);
            transition: all 0.3s;
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
        <h1 class="c-font fw-semibold text-center">FACILITIES</h1>
        <p class="text-center mt-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore, mollitia porro! Illum est, <br>
            at sit eius eveniet corporis accusantium, quae similique unde libero s oluta quam aperiam neque facere, quia nam?
        </p>
    </div>

    <div class="container">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php
            // ดึงข้อมูลสถานที่จากฐานข้อมูล
            $facilities_res = selectAll('hotel_facilities');

            while ($hotel_fac_data = mysqli_fetch_assoc($facilities_res)) {

                // ใช้รูปภาพจากข้อมูลในตาราง hotel_facilities โดยตรง
                $facility_thumb = HOTEL_FACILITIES_IMG_PATH . $hotel_fac_data['image']; // ปรับให้ตรงกับเส้นทางรูปภาพที่เก็บไว้ในฐานข้อมูล

                // แสดงผลการ์ดสถานที่
                echo <<<data
            <div class="col-lg-4 col-md-6">
                <div class="card text-bg-light shadow mb-3 h-100 pop">
                    <img style="height: 260px;" src="$facility_thumb" class="card-img-top image">
                    <div class="card-body">
                        <h5 class="card-title">$hotel_fac_data[name]</h5>
                        <hr>
                        <p class="card-text">$hotel_fac_data[description]</p>
                    </div>
                </div>
            </div>    
        data;
            }
            ?>

            <div class="col-lg-4 col-md-6">
                <div class="card text-bg-light shadow mb-3 h-100 pop">
                    <img style="height: 260px;" src="src/Fitness.jpg" class="card-img-top image" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">FITNESS</h5>
                        <hr>
                        <p class="card-text">Open 07.00 am. - 08.00 pm. Take time for exercise with a good atmosphere</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card text-bg-light shadow mb-3 h-100 pop">
                    <img style="height: 260px;" src="src/Pool_bar.jpg" class="card-img-top image" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">POOL BAR</h5>
                        <hr>
                        <p class="card-text">Open 10.00 am. - 07.00 pm. The poolside bar serves snacks and light snacks so you can enjoy a more relaxing and relaxing atmosphere.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card text-bg-light shadow mb-3 h-100 pop">
                    <img style="height: 260px;" src="src/Restaurant.jpg" class="card-img-top image" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">RESTAURANT</h5>
                        <hr>
                        <p class="card-text">Breakfast is served from 07.00 am. - 10.30 am. and Lunch open from 11.30 am. - 14.00 hrs. The restaurant serves buffet and A la carte.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="card text-bg-light shadow h-100 pop">
                    <img style="height: 260px;" src="src/Swimming_pool.png" class="card-img-top image" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">SWIMMING POOL</h5>
                        <hr>
                        <p class="card-text">Open 9.00 am - 07.00 pm Swimming pool is a heated saltwater pool that is gentle for the skin Available for all ages.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require('inc/footer.php') ?>
    <?php require('inc/modal-login.php') ?>
    <?php require('inc/modal-register.php') ?>
</body>
<?php require('inc/script.php') ?>

</html>