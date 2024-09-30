<?php
require('inc/essentials.php');
require('inc/db_config.php');
adminLogin();


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id'];
    $new_status = $_POST['status'];

    // อัปเดตสถานะการจอง
    $sql = "UPDATE booking_order SET status = ? WHERE order_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("si", $new_status, $order_id);
    $stmt->execute();

    // นำผู้ใช้กลับไปยังหน้าเดิมหลังจากอัปเดต
    header('Location: admin_manage_bookings.php');
    exit;
}
?>
