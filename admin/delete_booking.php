<?php
require('inc/essentials.php');
require('inc/db_config.php');
adminLogin();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id'];

    // ลบข้อมูลจากตาราง booking_order และ booking_detail
    $sql = "DELETE FROM booking_order WHERE order_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("i", $order_id);
    $stmt->execute();

    // นำผู้ใช้กลับไปยังหน้าเดิมหลังจากลบ
    header('Location: admin_manage_bookings.php');
    exit;
}
?>
