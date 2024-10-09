<?php
require('../admin/inc/db_config.php');

// รับค่าจาก AJAX request
$checkin = $_POST['checkin'];
$checkout = $_POST['checkout'];
$room_id = $_POST['room_id']; // เปลี่ยนเป็น room_id

// 1. ดึงข้อมูลจำนวนห้องทั้งหมดจากตาราง rooms โดยใช้ room_id
$query = "SELECT quantity FROM rooms WHERE id = ?";
$stmt = $con->prepare($query);
$stmt->bind_param('i', $room_id); // เปลี่ยนเป็น room_id
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $room_data = $result->fetch_assoc();
    $total_rooms = $room_data['quantity'];
} else {
    echo 'error'; // ไม่พบข้อมูลห้อง
    exit;
}
$stmt->close();

// 2. ตรวจสอบจำนวนการจองที่มีอยู่ในช่วงวันที่ที่เลือกจากตาราง booking_detail โดยใช้ room_id
$query = "SELECT COUNT(*) AS booked_rooms FROM booking_detail WHERE room_id = ? AND ((checkin BETWEEN ? AND ?) OR (checkout BETWEEN ? AND ?))";
$stmt = $con->prepare($query);
$stmt->bind_param('issss', $room_id, $checkin, $checkout, $checkin, $checkout); // เปลี่ยนเป็น room_id
$stmt->execute();
$result = $stmt->get_result();
$booked_data = $result->fetch_assoc();
$booked_rooms = $booked_data['booked_rooms'];
$stmt->close();

// 3. เปรียบเทียบจำนวนการจองกับจำนวนห้องทั้งหมด
if ($booked_rooms < $total_rooms) {
    echo 'available'; // ห้องยังว่าง
} else {
    echo 'unavailable'; // ห้องถูกจองเต็มแล้ว
}
?>
