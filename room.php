<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require('inc/links.php') ?>
    <style>
        .fs-18 {
            font-size: 18px;
        }

        .fs-14 {
            font-size: 14px;
        }

        .custom-popover {
            border-color: #996600;
            max-width: 220px;
            font-size: 15px;
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
        <h1 class="fw-semibold c-font text-center">OUS ROOMS</h1>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-12 mb-lg-0 mb-4 ps-5">
                <div class="navbar navbar-expand-lg nvabar-light bg-white shadow">
                    <div class="container-fluid flex-lg-column align-items-stretch">
                        <h4 class="mt-2">FILTERS</h4>
                        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#filterDropdown">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse flex-column align-items-stretch mt-2" id="filterDropdown">
                            <div class="border bg-light p-3 mb-3">
                                <h5 class="mb-3 fs-18">CHECK AVAILABILITY</h5>
                                <label class="form-label">Check-in</label>
                                <input type="date" class="form-control shadow-none mb-3">
                                <label class="form-label">Check-out</label>
                                <input type="date" class="form-control shadow-none">
                            </div>
                            <div class="border bg-light p-3 mb-3">
                                <h5 class="mb-3 fs-18">FACILITIES</h5>
                                <div class="mb-2">
                                    <input type="checkbox" id="f1" class="form-check-input shadow-none me-1">
                                    <label class="form-check-label" for="f1">facility one</label>
                                </div>
                                <div class="mb-2">
                                    <input type="checkbox" id="f2" class="form-check-input shadow-none me-1">
                                    <label class="form-check-label" for="f2">facility two</label>
                                </div>
                                <div class="mb-2">
                                    <input type="checkbox" id="f3" class="form-check-input shadow-none me-1">
                                    <label class="form-check-label" for="f3">facility three</label>
                                </div>
                            </div>
                            <div class="border bg-light p-3 mb-3">
                                <h5 class="mb-3 fs-18">GUESTS</h5>
                                <div class="d-flex">
                                    <div class="me-3">
                                        <label class="form-label">Adults</label>
                                        <input type="number" class="form-control shadow-none mb-3">
                                    </div>
                                    <div>
                                        <label class="form-label">Children</label>
                                        <input type="number" class="form-control shadow-none">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-9 col-md-12 ps-4 pe-5">

                <?php
                $room_res = select("SELECT * FROM `rooms` WHERE `status`=? AND `removed`=?", [1, 0], 'ii');

                while ($room_data = mysqli_fetch_assoc($room_res)) {
                    // get features of room

                    $fea_q = mysqli_query($con, "SELECT f.name FROM `features` f INNER JOIN `room_features` rfea on f.id = rfea.features_id WHERE rfea.room_id = '$room_data[id]'");

                    $features_data = "";
                    while ($fea_row = mysqli_fetch_assoc($fea_q)) {
                        $features_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap fs-14'>
                                $fea_row[name]
                            </span>";
                    }

                    // get description of room

                    // $des_q = mysqli_query($con,"")

                    // get facilities of room

                    $fac_q = mysqli_query($con, "SELECT f.icon FROM `facilities` f INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id WHERE rfac.room_id = '$room_data[id]'");

                    $facilities_data = "";
                    while ($fac_row = mysqli_fetch_assoc($fac_q)) {
                        $fac_i = FACILITIES_IMG_PATH . $fac_row['icon'];
                        $facilities_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap'>
                                    <img src='$fac_i' style='width: 20px;'>
                                </span>";
                    }

                    // get thumbnail of room

                    $room_thumb = ROOMS_IMG_PATH . "thumbnail.jpg";
                    $thumb_q = mysqli_query($con, "SELECT * FROM `room_images` WHERE `room_id`='$room_data[id]' AND `thumb`='1'");

                    if (mysqli_num_rows($thumb_q) > 0) {
                        $thumb_res = mysqli_fetch_assoc($thumb_q);
                        $room_thumb = ROOMS_IMG_PATH . $thumb_res['image'];
                    }

                    // print room card

                    echo <<<data
                            <div class="card mb-4 border-0 shadow">
                                <div class="row g-0 p-3 align-items-center">
                                    <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                                        <img src="$room_thumb" style="max-height: 330px;" class="img-fluid image rounded">
                                    </div>
                                    <div class="col-md-5 px-lg-3 px-md-3 px-0 border-end border-3 align-self-stretch">
                                        <h3 class="mb-4 mt-2 fw-semibold">$room_data[name]</h3>
                                        <div class="feature mb-3">
                                            <h6 class="mb-2 fw-semibold fs-18">Features</h6>
                                            $features_data
                                        </div>
                                        <div class="facilites mb-3">
                                            <h6 class="mb-2 fw-semibold fs-18">Facilities</h6>
                                            $facilities_data
                                        </div>
                                        <div class="description mb-3">
                                            <h6 class="mb-2 fw-semibold fs-18">Description</h6>
                                            <p style="font-size: 15px;">$room_data[description]</p> 
                                        </div>  
                                    </div>
                                    <div class="col-md-2 mt-lg-0 mt-md-3 mt-4 mb-3 ps-3 align-self-end text-center">
                                        <span class="mb-3" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-custom-class="custom-popover" data-bs-content="(Adults) : $room_data[adult]  (Children) : $room_data[children]">
                                            <i style="font-size: 24px;" class="ri-team-fill"></i>
                                        </span>
                                        <h4 class="mb-2">฿$room_data[price]</h4>
                                        <a href="#" style="border-radius: 0;" class="btn btn-sm w-100 text-white custom-bg shadow-none mb-2">Book Now</a>
                                        <a href="room_details.php?id=$room_data[id]" style="border-radius: 0;" class="btn btn-sm w-100 text-p custom-outline-bg shadow-none">More Info</a>
                                    </div>
                                </div>
                            </div>
                        data;
                }
                ?>

                <div class="card mb-4 border-0 shadow"> 
                    <div class="row g-0 p-3 align-items-center">
                        <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                            <img src="src/LINE_ALBUM_Superior room Thai Akara_240716_1.jpg" style="max-height: 320px;" class="img-fluid image rounded" alt="...">
                        </div>
                        <div class="col-md-5 px-lg-3 px-md-3 px-0 border-end border-3 align-self-stretch">
                            <h4 class="mb-3 fw-semibold">Simple Rooms Name</h4>
                            <div class="description mb-3">
                                <p style="font-size: 15px;">Relax in your Superior room that consists of teak plaster walls of ancient Lanna style</p>
                            </div>
                            <div class="feature mb-3">
                                <h6 class="mb-1">Features</h6>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    50 m2
                                </span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    1 beds
                                </span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    1 bathroom
                                </span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    1 balcony
                                </span>
                            </div>
                            <div class="facilites mb-3">
                                <h6 class="mb-1">Facilities</h6>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    <i style="font-size: 18px;" class="bi bi-wifi"></i>
                                </span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    <i style="font-size: 18px;" class="bi bi-tv"></i>
                                </span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    <i style="font-size: 18px;" class="bi bi-tv"></i>
                                </span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    <i style="font-size: 18px;" class="bi bi-tv"></i>
                                </span>
                                <span class="badge rounded-pill bg-light text-dark text-wrap">
                                    <img src="src/facilities/IMG47422.svg" style="width: 20px;">
                                </span>
                            </div>
                        </div>
                        <div class="col-md-2 mt-lg-0 mt-md-3 mt-4 mb-3 ps-3 align-self-end text-center">
                            <span class="mb-3" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-custom-class="custom-popover" data-bs-content="Max Stay (Adults) : 2">
                                <i style="font-size: 20px;" class="ri-team-fill"></i>
                            </span>
                            <h4 class="mb-2">$200</h4>
                            <a href="#" style="border-radius: 0;" class="btn btn-sm w-100 text-white custom-bg shadow-none mb-2">Book Now</a>
                            <a href="#" style="border-radius: 0;" class="btn btn-sm w-100 text-p custom-outline-bg shadow-none">More Info</a>
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