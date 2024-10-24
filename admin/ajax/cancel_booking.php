<?php
require_once('../inc/db_config.php');
require_once('../inc/essentials.php');
adminLogin();

if (isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];

    // อัปเดตสถานะการจองเป็น 'cancelled'
    $query = "UPDATE booking_order SET status = 'cancelled' WHERE order_id = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param('i', $order_id);

    if ($stmt->execute()) {
        echo 'success';
    } else {
        echo 'error';
    }

    $stmt->close();
} else {
    echo 'error';
}
?>
