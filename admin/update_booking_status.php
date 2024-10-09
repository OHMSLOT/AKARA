<?php
require('inc/essentials.php');
require('inc/db_config.php');
adminLogin();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order_id'], $_POST['status'])) {
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    $stmt = $con->prepare("UPDATE booking_order SET status = ? WHERE order_id = ?");
    $stmt->bind_param("si", $status, $order_id);
    if ($stmt->execute()) {
        echo "Booking status updated successfully.";
    } else {
        echo "Failed to update booking status.";
    }
    $stmt->close();
}
?>
