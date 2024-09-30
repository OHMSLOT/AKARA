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
        redirect('room.php');
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


            <?php
            $img_large_displayed = false; // ตัวแปรเพื่อเช็คว่าได้แสดงภาพใหญ่แล้วหรือไม่
            $img_q = mysqli_query($con, "SELECT * FROM `room_images` WHERE `room_id`='$room_data[id]'");

            if (mysqli_num_rows($img_q) > 0) {
                $small_images = ''; // ตัวแปรเก็บภาพเล็ก
                while ($img_res = mysqli_fetch_assoc($img_q)) {
                    $img_path = ROOMS_IMG_PATH . $img_res['image'];
                    if ($img_res['thumb'] == 1 && !$img_large_displayed) {
                        // แสดงภาพใหญ่ใน col-lg-8
                        echo "
                <div class='col-lg-8'>
                    <img src='$img_path' class='img-fluid w-100' style='height: 583.5px; object-fit: cover;' alt='Room Image'>
                </div>
            ";
                        $img_large_displayed = true; // ตั้งค่าให้ไม่แสดงภาพใหญ่ซ้ำ
                    } else if ($img_res['thumb'] == 0) {
                        // เก็บภาพเล็กไว้ในตัวแปร
                        $small_images .= "
                <img src='$img_path' class='img-fluid mb-3 w-100' style='height: 283.56px; object-fit: cover;' alt='Room Image'>
            ";
                    }
                }

                if (!empty($small_images)) {
                    // แสดงภาพเล็กทั้งหมดใน col-lg-4
                    echo "
                            <div class='col-lg-4'>
                                $small_images
                            </div>
                        ";
                }
            } else {
                // กรณีไม่มีภาพ ให้แสดงภาพที่เป็น thumbnail เริ่มต้น
                echo "
                        <div class='col-lg-8'>
                            <img src='" . ROOMS_IMG_PATH . "thumbnail.jpg' class='img-fluid' alt='No Image Available'>
                        </div>
                        <div class='col-lg-4'>
                            <img src='" . ROOMS_IMG_PATH . "thumbnail.jpg' class='img-fluid mb-3' alt='No Image Available'>
                            <img src='" . ROOMS_IMG_PATH . "thumbnail.jpg' class='img-fluid' alt='No Image Available'>
                        </div>
                    ";
            }
            ?>

            <!-- <div class="col-lg-8">
                    <img src="src/carousel1.jpg" class="img-fluid" alt="...">
                </div>

                <div class="col-lg-4">
                    <img src="src/carousel1.jpg" class="img-fluid mb-3" alt="...">
                    <img src="src/carousel1.jpg" class="img-fluid" alt="...">
                </div> -->



            <!-- <div class="col-lg-8 col-md-12 px-4 ">
                <div id="roomcarousel" class="carousel slide">
                    <div class="carousel-inner">
                    <?php
                    // $room_img = ROOMS_IMG_PATH . "thumbnail.jpg";
                    // $img_q = mysqli_query($con, "SELECT * FROM `room_images` WHERE `room_id`='$room_data[id]'");

                    // if (mysqli_num_rows($img_q) > 0) {
                    //     $active_class = 'active';
                    //     while ($img_res = mysqli_fetch_assoc($img_q)) {
                    //         echo "
                    //                 <div class='carousel-item $active_class'>
                    //                     <img src='" . ROOMS_IMG_PATH . $img_res['image'] . "' class='d-block w-100' style='max-height: 515px; object-fit: cover;'>
                    //                 </div>
                    //             ";
                    //         $active_class = '';
                    //     }
                    // } else {
                    //     echo "<div class='carousel-item active'>
                    //             <img src='$room_img' class='d-block w-100'>
                    //         </div>";
                    // }
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
            </div> -->


            <div class="col-lg-8 mt-5">
                <div class="mb-5">
                    <h5 class="mb-3">Description</h5>
                    <p>
                        <?php echo $room_data['description'] ?>
                    </p>
                </div>
                <?php

                $fac_q = mysqli_query($con, "SELECT f.icon, f.name FROM `facilities` f INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id WHERE rfac.room_id = '$room_data[id]'");

                $facilities_data = "";
                while ($fac_row = mysqli_fetch_assoc($fac_q)) {
                    $fac_i = FACILITIES_IMG_PATH . $fac_row['icon'];
                    $facilities_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-2' style='font-size: 15px; font-weight: 500;'>
                    <img src='$fac_i' class='me-1' style='width: 24px;'> $fac_row[name]
                    </span>";
                }

                echo <<<facilities
                        <div class="mb-5">
                            <h5 class='mb-3'>Facilities</h5>
                            $facilities_data   
                        </div>
                    facilities;

                ?>
            </div>

            <div class="col-4 mt-5">
                <div class="card">
                    <div class="card-body">
                        <?php

                        $fea_q = mysqli_query($con, "SELECT f.name FROM `features` f INNER JOIN `room_features` rfea ON f.id = rfea.features_id WHERE rfea.room_id = '$room_data[id]'");

                        $features_data = "";
                        while ($fea_row = mysqli_fetch_assoc($fea_q)) {
                            $features_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-1 mb-1'>
                                                        $fea_row[name]
                                                    </span>";
                        }

                        echo <<<price
                                <div class="mb-4">
                                    <span>Start from</span>
                                    <h3 class='mt-1'>฿$room_data[price]</h5>
                                </div>
                            price;

                        echo <<<feature
                                <div class="mb-4">
                                    <h5>Features</h5>
                                    $features_data   
                                </div>
                            feature;

                        echo <<<person
                                <div class="mb-4">
                                    <h5>Person</h5>
                                    <span class='badge rounded-pill bg-light text-dark text-wrap'>
                                        $room_data[adult] Adults
                                    </span>
                                    <span class='badge rounded-pill bg-light text-dark text-wrap'>
                                        $room_data[children] Children
                                    </span>
                                </div>
                            person;

                        echo <<<area
                                <div class="mb-4">
                                    <h5>Area</h5>
                                    <span class='badge rounded-pill bg-light text-dark text-wrap'>
                                        $room_data[area] sq. ft.
                                    </span>
                                </div>
                            area;

                        echo <<<book
                               <button onclick="bookRoom($room_data[id])" class="btn w-100 text-white custom-bg shadow-none mb-2">Book Now</button>                                        
                            book;

                        ?>
                    </div>
                </div>
            </div>

            <div class="col-12 mt-5 px-4">
                <h5 class="mb-3">Ratings</h5>
                <div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="d-flex">
                            <img src="/src/ic-phone.png">
                            <h6 class="m-0 ms-2">Random user1</h6>
                        </div>
                        <div class="rating d-flex align-items-center">
                            <h6 class="m-0 me-2">5.0</h6>
                            <i class="bi bi-star-fill text-warning me-1"></i>
                            <i class="bi bi-star-fill text-warning me-1"></i>
                            <i class="bi bi-star-fill text-warning me-1"></i>
                            <i class="bi bi-star-fill text-warning me-1"></i>
                            <i class="bi bi-star-fill text-warning me-1"></i>
                        </div>
                    </div>
                    <p>
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eaque, quam aperiam. Nulla, aut dolor dolores unde maiores neque quos ipsum?
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

    <?php require('inc/footer.php') ?>
</body>
<script>
    function bookRoom(roomId) {
        // ตรวจสอบสถานะการล็อกอินก่อนทำการจองห้อง
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/check_login.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onload = function() {
            if (this.responseText == "not_logged_in") {
                alert("error", "Please login before booking a room.");
            } else if (this.responseText == "logged_in") {
                // ดำเนินการจองห้องที่นี่
                alert("success", "Proceed with booking room ID: " + roomId);
                // คุณสามารถเพิ่มโค้ดสำหรับจองห้องได้ที่นี่
                window.location.href = 'confirm_booking.php?id=' + roomId;
            }
        };

        xhr.send("room_id=" + roomId);
    }
</script>

</html>