<?php
require_once('../inc/essentials.php');
require_once('../inc/db_config.php');
adminLogin();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // ตรวจสอบว่ามี order_id และ status ถูกส่งมาหรือไม่
        if (isset($_POST['order_id']) && isset($_POST['status'])) {
            $order_id = filter_var($_POST['order_id'], FILTER_SANITIZE_NUMBER_INT);
            $status = filter_var($_POST['status'], FILTER_SANITIZE_STRING);

            // อัปเดตสถานะการจองในฐานข้อมูล
            $sql = "UPDATE booking_order SET status = ? WHERE order_id = ?";
            $stmt = $con->prepare($sql);
            $stmt->bind_param('si', $status, $order_id);
            $res = $stmt->execute();

            if ($res) {
                echo 'success';
            } else {
                echo 'error';
            }
        } else {
            echo 'invalid_request'; // ถ้าข้อมูลไม่ครบถ้วน
        }
    } else {
        echo 'invalid_method'; // ถ้าไม่ได้ใช้ POST method
    }
?>
