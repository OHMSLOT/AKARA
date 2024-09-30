<?php
session_start();

// เชื่อมต่อฐานข้อมูล
require('admin/inc/db_config.php'); // สมมติว่าคุณมีไฟล์สำหรับการเชื่อมต่อกับฐานข้อมูล

// ตรวจสอบว่าผู้ใช้ล็อกอินหรือไม่
if (!isset($_SESSION['user_id'])) {
    // ถ้าผู้ใช้ยังไม่ได้ล็อกอิน นำไปที่หน้าเข้าสู่ระบบ
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // ข้อมูลที่รับมาจากฟอร์ม
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $room_name = $_POST['roomName'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $nights = $_POST['nights'];
    $total_price = $_POST['totalPrice'];

    // สร้างหมายเลขการจอง
    $order_number = uniqid('ORDER_');
    $user_id = 1; // สมมติว่าผู้ใช้มี ID เท่ากับ 1

    // 1. บันทึกข้อมูลใน booking_order
    $sql_order = "INSERT INTO booking_order (order_number, user_id, total_amount) VALUES (?, ?, ?)";
    $stmt_order = $con->prepare($sql_order);
    $stmt_order->bind_param("sid", $order_number, $user_id, $total_price);
    $stmt_order->execute();

    // ดึง order_id ที่เพิ่งถูกสร้างขึ้น
    $order_id = $con->insert_id;

    // 2. บันทึกข้อมูลใน booking_detail
    $sql_detail = "INSERT INTO booking_detail (order_id, firstname, lastname, email, phone, room_name, checkin, checkout, nights, total_price)
                   VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt_detail = $con->prepare($sql_detail);
    $stmt_detail->bind_param("isssssssid", $order_id, $firstname, $lastname, $email, $phone, $room_name, $checkin, $checkout, $nights, $total_price);
    $stmt_detail->execute();

    // ปิด statement
    $stmt_order->close();
    $stmt_detail->close();

    // นำผู้ใช้ไปยังหน้าการจองสำเร็จ
    header('Location: booking_success.php');
    exit;
}
?>
