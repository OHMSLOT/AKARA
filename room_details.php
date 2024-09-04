<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room details</title>
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

    <?php
    if (!isset($_GET['id'])) {
        redirect('room.php');
    }

    $data = filteration($_GET);

    $room_res = select("SELECT * FROM `rooms` WHERE `id`=? AND `status`=? AND `removed`=?", [$data['id'], 1, 0], 'iii');

    if (mysqli_num_rows($room_res) == 0) {
        redirect('rooms.php');
    }

    $room_data = mysqli_fetch_assoc($room_res);
    ?>

    <div class="container">
        <div class="row">

            <div class="col-12 my-5 mb-4 px-4">
                <h1 class="fw-semibold"><?php echo $room_data['name'] ?></h1>
                <div style="font-size: 14px;">
                    <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
                    <span class="text-secondary"> > </span>
                    <a href="room.php" class="text-secondary text-decoration-none">ROOMS</a>
                </div>
            </div>

            <div class="col-lg-8 col-md-12 px-4 ">
                <div id="roomcarousel" class="carousel slide">
                    <div class="carousel-inner">
                        <?php
                        $room_img = ROOMS_IMG_PATH . "thumbnail.jpg";
                        $img_q = mysqli_query($con, "SELECT * FROM `room_images` WHERE `room_id`='$room_data[id]'");

                        if (mysqli_num_rows($img_q) > 0) {
                            $active_class = 'active';
                            while ($img_res = mysqli_fetch_assoc($img_q)) {
                                echo "
                                        <div class='carousel-item $active_class'>
                                        <img src='" . ROOMS_IMG_PATH . $img_res['image'] . "' class='d-block w-100'>
                                        </div>
                                    ";
                                $active_class = '';
                            }
                        } else {
                            echo "<div class='carousel-item active'>
                                <img src='$room_img' class='d-block w-100'>
                                </div>";
                        }

                        ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#roomcarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#roomcarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <div class="col-lg-4 col-md-12 px-4">
                <div class="card mb-4 border-0 shadow-sm rounded-3">
                    <div class="card-body">
                        <?php

                        echo <<<price
                                <h4>฿$room_data[price]</h4>
                            price;

                        echo <<<book
                                <a href="" class="btn w-100 text-white custom-bg shadow-none mb-2">Book Now</a>
                            book;
                        ?>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-5 px-4">
                <div class="mb-4">
                    <h5>Description</h5>
                    <p>
                        <?php echo $room_data['description'] ?>
                    </p>
                </div>
                <?php
                // $room_res = select("SELECT * FROM `rooms` WHERE `status`=? AND `removed`=?", [1, 0], 'ii');

                // while ($room_data = mysqli_fetch_assoc($room_res)) {
                //     // get features of room

                //     $fea_q = mysqli_query($con, "SELECT f.name FROM `features` f INNER JOIN `room_features` rfea on f.id = rfea.features_id WHERE rfea.room_id = '$room_data[id]'");

                //     $features_data = "";
                //     while ($fea_row = mysqli_fetch_assoc($fea_q)) {
                //         $features_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap fs-14'>
                //                 $fea_row[name]
                //             </span>";
                //     }

                //     // get description of room

                //     // $des_q = mysqli_query($con,"")

                //     // get facilities of room

                //     $fac_q = mysqli_query($con, "SELECT f.icon FROM `facilities` f INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id WHERE rfac.room_id = '$room_data[id]'");

                //     $facilities_data = "";
                //     while ($fac_row = mysqli_fetch_assoc($fac_q)) {
                //         $fac_i = FACILITIES_IMG_PATH . $fac_row['icon'];
                //         $facilities_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap'>
                //                     <img src='$fac_i' style='width: 20px;'>
                //                 </span>";
                //     }

                //     // get thumbnail of room

                //     $room_thumb = ROOMS_IMG_PATH . "thumbnail.jpg";
                //     $thumb_q = mysqli_query($con, "SELECT * FROM `room_images` WHERE `room_id`='$room_data[id]' AND `thumb`='1'");

                //     if (mysqli_num_rows($thumb_q) > 0) {
                //         $thumb_res = mysqli_fetch_assoc($thumb_q);
                //         $room_thumb = ROOMS_IMG_PATH . $thumb_res['image'];
                //     }

                //     // print room card

                //     echo <<<data
                //             <div class="card mb-4 border-0 shadow">
                //                 <div class="row g-0 p-3 align-items-center">
                //                     <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                //                         <img src="$room_thumb" style="max-height: 330px;" class="img-fluid image rounded">
                //                     </div>
                //                     <div class="col-md-5 px-lg-3 px-md-3 px-0 border-end border-3 align-self-stretch">
                //                         <h3 class="mb-4 mt-2 fw-semibold">$room_data[name]</h3>
                //                         <div class="feature mb-3">
                //                             <h6 class="mb-2 fw-semibold fs-18">Features</h6>
                //                             $features_data
                //                         </div>
                //                         <div class="facilites mb-3">
                //                             <h6 class="mb-2 fw-semibold fs-18">Facilities</h6>
                //                             $facilities_data
                //                         </div>
                //                         <div class="description mb-3">
                //                             <h6 class="mb-2 fw-semibold fs-18">Description</h6>
                //                             <p style="font-size: 15px;">$room_data[description]</p> 
                //                         </div>  
                //                     </div>
                //                     <div class="col-md-2 mt-lg-0 mt-md-3 mt-4 mb-3 ps-3 align-self-end text-center">
                //                         <span class="mb-3" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-custom-class="custom-popover" data-bs-content="(Adults) : $room_data[adult]  (Children) : $room_data[children]">
                //                             <i style="font-size: 24px;" class="ri-team-fill"></i>
                //                         </span>
                //                         <h4 class="mb-2">฿$room_data[price]</h4>
                //                         <a href="#" style="border-radius: 0;" class="btn btn-sm w-100 text-white custom-bg shadow-none mb-2">Book Now</a>
                //                         <a href="room_details.php?id=$room_data[id]" style="border-radius: 0;" class="btn btn-sm w-100 text-p custom-outline-bg shadow-none">More Info</a>
                //                     </div>
                //                 </div>
                //             </div>
                //         data;
                // }
                ?>

            </div>
        </div>
    </div>

    <?php require('inc/modal-login.php') ?>
    <?php require('inc/modal-register.php') ?>
    <?php require('inc/footer.php') ?>
</body>
<?php require('inc/script.php') ?>

</html>