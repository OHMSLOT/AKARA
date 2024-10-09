<?php
require('inc/essentials.php');
require('inc/db_config.php');
adminLogin();

// ตรวจสอบว่ามี order_id ส่งมาหรือไม่
if (isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];

    // ดึงข้อมูลการจองจากฐานข้อมูล
    $sql = "SELECT * FROM booking_order WHERE order_id = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('i', $order_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $booking = $result->fetch_assoc();

        // ตรวจสอบว่าสถานะเป็น 'cancelled' เพื่อทำการคืนเงิน
        if ($booking['status'] == 'cancelled') {
            // อัปเดตสถานะการจองเป็น 'refunded'
            $update_sql = "UPDATE booking_order SET status = 'refunded' WHERE order_id = ?";
            $update_stmt = $con->prepare($update_sql);
            $update_stmt->bind_param('i', $order_id);
            if ($update_stmt->execute()) {
                $_SESSION['success'] = "Refund processed successfully for order #{$booking['order_number']}.";
            } else {
                $_SESSION['error'] = "Failed to process refund.";
            }
        } else {
            $_SESSION['error'] = "Booking status is not eligible for refund.";
        }
    } else {
        $_SESSION['error'] = "Booking not found.";
    }
} else {
    $_SESSION['error'] = "Invalid request.";
}

header('Location: refund_booking.php');
exit();
