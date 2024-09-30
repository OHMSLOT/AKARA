<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require('inc/links.php') ?>
    <style>
        /* * {
            font-family: "Crimson Text", serif;
        }

        .c-font {
            font-family: "Inter", sans-serif;
        } */

        .image {
            display: block;
            width: 100%;
            object-fit: cover;
        }

        .fs-18 {
            font-size: 18px;
        }
    </style>
</head>

<body>
    <!-- header -->
    <?php require('inc/header.php') ?>
    <!-- search -->
    <section>
        <div class="container">
            <img src="src/image 3.png" class="slider" alt="Hotel Room">
        </div>

        <div class="container search-form">
            <div class="row">
                <div class="col-lg-10 col-md-10 col-sm-10 custom_bg mx-auto py-4 px-5">
                    <form>
                        <div class="row align-items-end">
                            <div class="col-lg-3 mb-2">
                                <label class="form-label fw-medium">Check-in</label>
                                <input type="date" class="form-control shadow-none">
                            </div>
                            <div class="col-lg-3 mb-2">
                                <label class="form-label fw-medium">Check-out</label>
                                <input type="date" class="form-control shadow-none">
                            </div>
                            <div class="col-lg-3 mb-2">
                                <label class="form-label fw-medium">Adult</label>
                                <select class="form-select shadow-none">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                            <div class="col-lg-2 mb-2">
                                <label class="form-label fw-medium">Children</label>
                                <select class="form-select shadow-none">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                            <div class="col-lg-1 mb-lg-2 mt-3">
                                <button type="submit" class="btn btn-light text-dark shadow-none">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
    <!-- history -->
    <section>
        <div class="container pt-5">
            <div class="my-5 px-4 pt-5">
                <h1 class="fw-semibold c-font text-center">. Heart of Chiang Mai .</h1>
            </div>
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
                <div class="carousel-inner">
                    <?php
                    $res = selectAll('carousel');

                    while ($row = mysqli_fetch_assoc($res)) {
                        $path = CAROUSEL_IMG_PATH;
                        echo <<<data
                                <div class="carousel-item active">
                                    <img src="$path$row[image]" style="max-height: 700px;" class="d-block w-100 image img-fluid" alt="...">
                                </div>
                            data;
                    }
                    ?>
                </div>
            </div>
            <p class="my-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore, mollitia porro! Illum est,
                at sit eius eveniet corporis accusantium, quae similique unde libero soluta quam aperiam neque facere, quia nam?
            </p>
        </div>
    </section>
    <!-- room-type -->
    <section>
        <div class="container-fluid bg-dark">
            <div class="container">
                <div class="d-flex flex-wrap justify-content-between align-items-center py-5">
                    <h1 style="display: block;" class="text-light c-font fs-48 m-0">ROOM TYPE</h1>
                    <div>
                        <a href="room-type.php" class="btn btn-outline-light c-font fs-18 fw-normal" style="width: auto; display: inline-block; border-radius: 0;">ALL ROOMS</a>
                    </div>
                </div>

                <div class="row pb-5">
                    <swiper-container class="mySwiper" init="false">
                        <?php
                        $room_res = select("SELECT * FROM `rooms` WHERE `status`=? AND `removed`=?", [1, 0], 'ii');

                        while ($room_data = mysqli_fetch_assoc($room_res)) {
                            // get features of room

                            $fea_q = mysqli_query($con, "SELECT f.name FROM `features` f INNER JOIN `room_features` rfea on f.id = rfea.features_id WHERE rfea.room_id = '$room_data[id]'");

                            $features_data = "";
                            while ($fea_row = mysqli_fetch_assoc($fea_q)) {
                                $features_data .= "<span class='badge fs-14 fw-normal p-0 me-2'>
                                        <i style='font-size: 12px;' class='bi bi-record-fill'></i> $fea_row[name]
                                    </span>";
                            }

                            // get thumbnail of room

                            $room_thumb = ROOMS_IMG_PATH . "thumbnail.jpg";
                            $thumb_q = mysqli_query($con, "SELECT * FROM `room_images` WHERE `room_id`='$room_data[id]' AND `thumb`='1'");

                            if (mysqli_num_rows($thumb_q) > 0) {
                                $thumb_res = mysqli_fetch_assoc($thumb_q);
                                $room_thumb = ROOMS_IMG_PATH . $thumb_res['image'];
                            }

                            // print card

                            echo <<<data
                                        <swiper-slide>
                                            <div class="card text-start bg-dark border-dark text-light">
                                                <img src="$room_thumb" style="height: 270px;" class="card-img-top image" alt="...">
                                                <div class="card-body px-0">
                                                    <h1 class="mb-3 c-font">$room_data[name]</h1>
                                                    <h4 class="c-font">Features</h4>
                                                    <div class="mb-3">
                                                        <span class="badge fs-14 fw-normal p-0 me-2">
                                                            <i style="font-size: 12px;" class="bi bi-record-fill"></i> $room_data[area] m2
                                                        </span>
                                                        $features_data
                                                    </div>
                                                    <div class="card-footer bd-t px-0">
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <div>
                                                                <span class="c-font fs-20">Start from</span>
                                                                <h3 class="c-font">฿$room_data[price]/NIGHT</h3>
                                                            </div>
                                                            <div>
                                                                <a href="room_details.php?id=$room_data[id]" style="border-radius: 0;" class="btn btn-outline-light c-font px-4 fs-18">DETAIL</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </swiper-slide>
                                    data;
                        }
                        ?>
                        <swiper-slide>
                            <div class="card text-start bg-dark border-dark text-light">
                                <img src="src/LINE_ALBUM_Superior room Thai Akara_240716_1.jpg" style="height: 270px;" class="card-img-top image" alt="...">
                                <div class="card-body px-0">
                                    <h1 class="mb-3 c-font">Superior</h1>
                                    <h4 class="c-font">Features</h4>
                                    <div class="mb-3">
                                        <span class="badge fs-14 fw-normal p-0 me-2">
                                            <i style="font-size: 12px;" class="bi bi-record-fill"></i> 50 m2
                                        </span>
                                        <span class="badge fs-14 fw-normal p-0 me-2">
                                            <i style="font-size: 12px;" class="bi bi-record-fill"></i> 1 beds
                                        </span>
                                        <span class="badge fs-14 fw-normal p-0 me-2">
                                            <i style="font-size: 12px;" class="bi bi-record-fill"></i> 1 bathroom
                                        </span>
                                        <span class="badge fs-14 fw-normal p-0 me-2">
                                            <i style="font-size: 12px;" class="bi bi-record-fill"></i> 1 balcony
                                        </span>
                                    </div>
                                    <div class="card-footer bd-t px-0">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <div>
                                                <span class="c-font fs-20">Start from</span>
                                                <h3 class="c-font">$1500/NIGHT</h3>
                                            </div>
                                            <div>
                                                <a href="#" style="border-radius: 0;" class="btn btn-outline-light c-font px-4 fs-18">DETAIL</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </swiper-slide>
                    </swiper-container>
                </div>

            </div>
        </div>
    </section>
    <!-- facilites -->
    <section>
        <div class="container my-5">
            <div class="row mb-2 gap-0">
                <div class="col-lg-6 col-md-12">
                    <h1 class="text-uppercase c-font fs-48">Hotel Facilities</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti, dolores?</p>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 px-3">
                    <div class="facility-card">
                        <img style="height: 400px;" src="src/Fitness.jpg" class="img-fluid image" alt="Facility 1">
                        <div class="facility-card-title">
                            <h1 class="fs-5 fw-semibold c-font mb-0">FITNESS</h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 px-3">
                    <div class="facility-card">
                        <img style="height: 400px;" src="src/Pool_bar.jpg" class="img-fluid image" alt="Facility 1">
                        <div class="facility-card-title">
                            <h1 class="fs-5 fw-semibold c-font mb-0">POOL BAR</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row gap-0">
                <div class="col-lg-6 col-md-6 mb-4 px-3">
                    <div class="facility-card">
                        <img style="height: 400px;" src="src/Restaurant.jpg" class="img-fluid image" alt="Facility 1">
                        <div class="facility-card-title">
                            <h1 class="fs-5 fw-semibold c-font mb-0">RESTAURANT</h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 mb-4 px-3">
                    <div class="facility-card">
                        <img style="height: 400px;" src="src/Swimming_pool.png" class="img-fluid image" alt="Facility 1">
                        <div class="facility-card-title">
                            <h1 class="fs-5 fw-semibold c-font mb-0">SWIMMING POOL</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Events section -->
    <section>
        <div class="container-fluid bg-dark">
            <div class="container">
                <div class="py-5">
                    <h1 class="text-light text-center c-font fs-48">Upcoming Events</h1>
                </div>
                <div class="row pb-5">

                    <?php
                    // เรียกใช้งานฟังก์ชัน selectAll()
                    $event_res = selectAll('events');

                    // ใช้ลูป while เพื่อแสดงข้อมูลในรูปแบบการ์ด
                    while ($event = mysqli_fetch_assoc($event_res)) {
                        // กำหนดเส้นทางรูปภาพที่ถูกต้อง (ตัวอย่างใช้โฟลเดอร์ uploads/facilities/)
                        $image_path = EVENTS_IMG_PATH . $event['image'];

                        // ฟอร์แมตวันที่
                        $formatted_date = date("d F Y", strtotime($event['date']));

                        // ฟอร์แมตเวลาเป็น 24 ชั่วโมง (สมมติว่า $event['time'] เป็นเวลาเริ่มต้น เช่น 12:00:00)
                        $formatted_time_s = date("H:i", strtotime($event['time_s']));
                        $formatted_time_e = date("H:i", strtotime($event['time_e']));

                        echo <<<data
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card text-start bg-dark border-dark text-light">
                                <img src="{$image_path}" class="card-img-top rounded-0">
                                <div class="card-body px-0">
                                    <h2 class="mb-3 c-font">{$event['name']}</h2>
                                    <p class="me-4 c-font fs-18"><i class="bi bi-clock me-1"></i> {$formatted_time_s} - {$formatted_time_e}</p>
                                    <p class="c-font fs-18"><i class="bi bi-calendar-event me-1"></i> {$formatted_date}</p>
                                    <a class="text-decoration-none text-light fs-5 c-font" href="#">SEE DETAIL</a>
                                </div>
                            </div>
                        </div>
                    data;
                    }
                    ?>

                </div>
            </div>
        </div>
    </section>
    <!-- map -->
    <section>
        <h1 class="mt-5 pt-4 mb-4 text-center fw-medium c-font fs-48">Reach us</h1>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 mb-3 rounded">
                    <iframe class="w-100" height="550" src="<?php echo $contact_r['iframe'] ?>"></iframe>
                </div>
            </div>
        </div>
    </section>
    <!-- footer -->
    <?php require('inc/footer.php') ?>
</body>


<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
<script>
    const swiperEl = document.querySelector('swiper-container')
    Object.assign(swiperEl, {
        slidesPerView: 3,
        spaceBetween: 30,
        pagination: {
            clickable: true,
        },
        breakpoints: {
            320: {
                slidesPerView: 1,
            },
            640: {
                slidesPerView: 1,
            },
            768: {
                slidesPerView: 2,
            },
            1024: {
                slidesPerView: 3,
            },
        },
    });
    swiperEl.initialize();
</script>

</html>