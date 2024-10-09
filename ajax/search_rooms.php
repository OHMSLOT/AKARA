<?php
require('../admin/inc/db_config.php');
require('../admin/inc/essentials.php');

// รับข้อมูลจาก AJAX request
$checkin = isset($_POST['checkin']) ? $_POST['checkin'] : '';
$checkout = isset($_POST['checkout']) ? $_POST['checkout'] : '';
$adult = isset($_POST['adult']) ? (int)$_POST['adult'] : 1;
$children = isset($_POST['children']) ? (int)$_POST['children'] : 0;
$facilities = isset($_POST['facilities']) ? explode(',', $_POST['facilities']) : [];

// สร้างคำสั่ง SQL เพื่อค้นหาห้องว่างในช่วงเวลาที่เลือก
$sql = "SELECT * FROM `rooms` WHERE `status`=1 AND `removed`=0";
$params = [];
$types = '';

// ตรวจสอบและเพิ่มเงื่อนไขของการค้นหา
if ($checkin && $checkout) {
    $sql .= " AND `id` NOT IN (SELECT `room_id` FROM `booking_detail` WHERE (? < `checkout` AND ? > `checkin`))";
    $params[] = $checkin;
    $params[] = $checkout;
    $types .= 'ss';
}

if ($adult) {
    $sql .= " AND `adult` >= ?";
    $params[] = $adult;
    $types .= 'i';
}

if ($children) {
    $sql .= " AND `children` >= ?";
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

// แสดงผลลัพธ์ห้องที่ค้นหา
while ($room_data = $result->fetch_assoc()) {
    // ดึงคุณสมบัติและสิ่งอำนวยความสะดวกของห้อง
    $fea_q = mysqli_query($con, "SELECT f.name FROM `features` f INNER JOIN `room_features` rfea on f.id = rfea.features_id WHERE rfea.room_id = '{$room_data['id']}'");

    $features_data = "";
    while ($fea_row = mysqli_fetch_assoc($fea_q)) {
        $features_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap fs-14'>
                {$fea_row['name']}
            </span>";
    }

    $fac_q = mysqli_query($con, "SELECT f.icon FROM `facilities` f INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id WHERE rfac.room_id = '{$room_data['id']}'");

    $facilities_data = "";
    while ($fac_row = mysqli_fetch_assoc($fac_q)) {
        $fac_i = FACILITIES_IMG_PATH . $fac_row['icon'];
        $facilities_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap'>
                    <img src='$fac_i' style='width: 20px;'>
                </span>";
    }

    // ดึงรูปภาพ thumbnail ของห้อง
    $room_thumb = ROOMS_IMG_PATH . "thumbnail.jpg";
    $thumb_q = mysqli_query($con, "SELECT * FROM `room_images` WHERE `room_id`='{$room_data['id']}' AND `thumb`='1'");

    if (mysqli_num_rows($thumb_q) > 0) {
        $thumb_res = mysqli_fetch_assoc($thumb_q);
        $room_thumb = ROOMS_IMG_PATH . $thumb_res['image'];
    }

    // แสดงผลลัพธ์เป็นการ์ด
    echo <<<data
        <div class="card mb-4 border-0 shadow">
            <div class="row g-0 p-3 align-items-center">
                <div class="col-md-5 mb-lg-0 mb-md-0 mb-3">
                    <img src="$room_thumb" style="max-height: 330px;" class="img-fluid image rounded">
                </div>
                <div class="col-md-5 px-lg-3 px-md-3 px-0 border-end border-3 align-self-stretch">
                    <h3 class="mb-4 mt-2 fw-semibold">{$room_data['name']}</h3>
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
                        <p style="font-size: 15px;">{$room_data['description']}</p> 
                    </div>  
                </div>
                <div class="col-md-2 mt-lg-0 mt-md-3 mt-4 mb-3 ps-3 align-self-end text-center">
                    <span class="mb-3" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-custom-class="custom-popover" data-bs-content="(Adults) : {$room_data['adult']}  (Children) : {$room_data['children']}">
                        <i style="font-size: 24px;" class="ri-team-fill"></i>
                    </span>
                    <h4 class="mb-2">฿{$room_data['price']}</h4>
                    <button onclick="bookRoom({$room_data['id']})" style="border-radius: 0;" class="btn btn-sm w-100 text-white custom-bg shadow-none mb-2">Book Now</button>                                        
                    <a href="room_details.php?id={$room_data['id']}" style="border-radius: 0;" class="btn btn-sm w-100 text-p custom-outline-bg shadow-none">More Info</a>
                </div>
            </div>
        </div>
    data;
}

$stmt->close();
?>
