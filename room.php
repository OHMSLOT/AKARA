<?php
require_once('admin/inc/db_config.php');
require_once('admin/inc/essentials.php');

// รับค่าจาก query string
$checkin = isset($_GET['checkin']) ? $_GET['checkin'] : '';
$checkout = isset($_GET['checkout']) ? $_GET['checkout'] : '';
$adult = isset($_GET['adult']) ? (int)$_GET['adult'] : 1;
$children = isset($_GET['children']) ? (int)$_GET['children'] : 0;
$rooms_needed = isset($_GET['rooms_needed']) ? (int)$_GET['rooms_needed'] : 1;

// สร้างคำสั่ง SQL สำหรับค้นหาห้องที่ว่าง
$sql = "SELECT r.*, 
        (r.quantity - COALESCE(COUNT(bd.room_id), 0)) AS rooms_available 
        FROM `rooms` r
        LEFT JOIN `booking_detail` bd ON r.id = bd.room_id 
        AND (? < bd.checkout AND ? > bd.checkin)
        WHERE r.status=1 AND r.removed=0";

// เก็บค่า parameters และ types
$params = [$checkin, $checkout];
$types = 'ss';

// เพิ่มเงื่อนไขการกรองตามจำนวนห้องที่ต้องการ
$sql .= " GROUP BY r.id HAVING rooms_available >= ?";
$params[] = $rooms_needed;
$types .= 'i';

// กรองตามจำนวนผู้ใหญ่
if ($adult) {
    $sql .= " AND r.adult >= ?";
    $params[] = $adult;
    $types .= 'i';
}

// กรองตามจำนวนเด็ก
if ($children) {
    $sql .= " AND r.children >= ?";
    $params[] = $children;
    $types .= 'i';
}

// เตรียม statement และรัน query
$stmt = $con->prepare($sql);
if ($types) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();
$result = $stmt->get_result();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room Search Results</title>
    <?php require('inc/links.php'); ?>
    <style>
        .fs-18 {
            font-size: 18px;
        }

        .fs-14 {
            font-size: 14px;
        }

        .image {
            display: block;
            width: 100%;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <?php require('inc/header.php'); ?>

    <div class="my-5 px-4">
        <h1 class="fw-semibold text-center">Available Rooms</h1>
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
                                <input type="date" name="checkin" value="<?php echo $checkin; ?>" class="form-control shadow-none mb-3">
                                <label class="form-label">Check-out</label>
                                <input type="date" name="checkout" value="<?php echo $checkout; ?>" class="form-control shadow-none">
                            </div>
                            <div class="border bg-light p-3 mb-3">
                                <h5 class="mb-3 fs-18">GUESTS</h5>
                                <div class="d-flex">
                                    <div class="me-3">
                                        <label class="form-label">Adults</label>
                                        <input type="number" name="adult" value="<?php echo $adult; ?>" class="form-control shadow-none mb-3">
                                    </div>
                                    <div>
                                        <label class="form-label">Children</label>
                                        <input type="number" name="children" value="<?php echo $children; ?>" class="form-control shadow-none">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-9 col-md-12 ps-4 pe-5">
                <?php
                // แสดงผลลัพธ์การค้นหาห้องพัก
                while ($room_data = $result->fetch_assoc()) {
                    // ดึงข้อมูล Features และ Facilities
                    $fea_q = mysqli_query($con, "SELECT f.name FROM `features` f INNER JOIN `room_features` rfea on f.id = rfea.features_id WHERE rfea.room_id = '{$room_data['id']}'");

                    $features_data = "";
                    while ($fea_row = mysqli_fetch_assoc($fea_q)) {
                        $features_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap fs-14'>{$fea_row['name']}</span> ";
                    }

                    $fac_q = mysqli_query($con, "SELECT f.icon FROM `facilities` f INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id WHERE rfac.room_id = '{$room_data['id']}'");
                    $facilities_data = "";
                    while ($fac_row = mysqli_fetch_assoc($fac_q)) {
                        $fac_i = FACILITIES_IMG_PATH . $fac_row['icon'];
                        $facilities_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap'><img src='{$fac_i}' style='width: 20px;'></span> ";
                    }

                    // ดึง Thumbnail ของห้องพัก
                    $room_thumb = ROOMS_IMG_PATH . "thumbnail.jpg";
                    $thumb_q = mysqli_query($con, "SELECT * FROM `room_images` WHERE `room_id`='{$room_data['id']}' AND `thumb`='1'");
                    if (mysqli_num_rows($thumb_q) > 0) {
                        $thumb_res = mysqli_fetch_assoc($thumb_q);
                        $room_thumb = ROOMS_IMG_PATH . $thumb_res['image'];
                    }

                    // แสดงการ์ดห้องพัก
                    echo <<<data
                    <div class="card mb-4 border-0 shadow">
                        <div class="row g-0 p-3 align-items-center">
                            <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                                <img src="$room_thumb" class="img-fluid image rounded">
                            </div>
                            <div class="col-md-5 px-lg-3 px-md-3 px-0 border-end border-3 align-self-stretch">
                                <h3 class="mb-4 mt-2 fw-semibold">{$room_data['name']}</h3>
                                <div class="feature mb-3">
                                    <h6 class="mb-2">Features</h6>
                                    $features_data
                                </div>
                                <div class="facilities mb-3">
                                    <h6 class="mb-2">Facilities</h6>
                                    $facilities_data
                                </div>
                                <div class="description mb-3">
                                    <h6 class="mb-2">Description</h6>
                                    <p class="mb-0">{$room_data['description']}</p>
                                </div>
                            </div>
                            <div class="col-md-2 mt-lg-0 mt-md-3 mt-4 mb-3 ps-3 align-self-end text-center">
                                <span class="mb-3" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-content="(Adults) : {$room_data['adult']}  (Children) : {$room_data['children']}">
                                    <i class="bi bi-person-fill"></i>
                                </span>
                                <h4 class="mb-2">฿{$room_data['price']}</h4>
                                <button onclick="bookRoom({$room_data['id']})" class="btn btn-sm w-100 text-white custom-bg shadow-none mb-2">Book Now</button>                                        
                                <a href="room_details.php?id={$room_data['id']}" class="btn btn-sm w-100 text-dark border border-dark shadow-none">More Info</a>
                            </div>
                        </div>
                    </div>
                    data;
                }
                ?>
            </div>
        </div>
    </div>

    <?php require('inc/footer.php'); ?>
</body>
<script>
    function bookRoom(roomId) {
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/check_login.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onload = function() {
            if (this.responseText == "not_logged_in") {
                alert("error","Please login before booking a room.");
            } else if (this.responseText == "logged_in") {
                window.location.href = 'confirm_booking.php?id=' + roomId;
            }
        };

        xhr.send("room_id=" + roomId);
    }

    function applyFilters() {
        const checkin = document.querySelector('input[name="checkin"]').value;
        const checkout = document.querySelector('input[name="checkout"]').value;
        const adult = document.querySelector('input[name="adult"]').value;
        const children = document.querySelector('input[name="children"]').value;

        // สร้าง query string
        const queryString = `?checkin=${checkin}&checkout=${checkout}&adult=${adult}&children=${children}`;
        
        // ไปที่ URL ใหม่พร้อมกับ query string
        window.location.href = `room.php${queryString}`;
    }

    // เพิ่ม event listener สำหรับ input fields เพื่อให้เรียกใช้ฟังก์ชัน applyFilters เมื่อมีการเปลี่ยนแปลง
    document.addEventListener('DOMContentLoaded', function() {
        const inputs = document.querySelectorAll('input[name="checkin"], input[name="checkout"], input[name="adult"], input[name="children"]');
        
        inputs.forEach(input => {
            input.addEventListener('change', applyFilters);
        });
    });
</script>

</html>