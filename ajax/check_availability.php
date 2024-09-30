<?php
require('../admin/inc/db_config.php');

// รับค่าจาก AJAX request
$checkin = $_POST['checkin'];
$checkout = $_POST['checkout'];
$room_id = $_POST['room_id'];

// คำสั่ง SQL เพื่อตรวจสอบว่าห้องว่างอยู่หรือไม่
$query = "SELECT * FROM bookings WHERE room_id = ? AND ((checkin BETWEEN ? AND ?) OR (checkout BETWEEN ? AND ?))";
$stmt = $con->prepare($query);
$stmt->bind_param('issss', $room_id, $checkin, $checkout, $checkin, $checkout);
$stmt->execute();
$result = $stmt->get_result();

// ตรวจสอบผลลัพธ์
if ($result->num_rows > 0) {
    echo 'unavailable'; // ห้องถูกจอง
} else {
    echo 'available'; // ห้องว่าง
}
$stmt->close();

?>
