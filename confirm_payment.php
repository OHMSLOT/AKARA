<?php
session_start();
require('admin/inc/db_config.php');

if (!isset($_SESSION['uId'])) {
    echo "<script>alert('กรุณาเข้าสู่ระบบก่อนดำเนินการ');</script>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $room_id = $_POST['room_id'];
    $room_name = $_POST['roomName'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $nights = $_POST['nights'];
    $total_price = $_POST['totalPrice'];
    $user_id = $_SESSION['uId'];
    $slip_image = '';

    // ตรวจสอบว่ามีข้อมูลครบหรือไม่
    if (empty($firstname) || empty($lastname) || empty($email) || empty($phone) || empty($room_name)) {
        echo "Please fill in all required fields.";
        exit;
    }

    // สร้างหมายเลขการจอง
    $order_number = uniqid('ORDER_');

    // เริ่มต้น Transaction เพื่อให้มั่นใจว่าการบันทึกข้อมูลในทั้งสองตารางสำเร็จ
    mysqli_begin_transaction($con);

    try {
        // 1. บันทึกข้อมูลลงใน booking_order
        $sql_order = "INSERT INTO booking_order (order_number, user_id, total_amount) VALUES (?, ?, ?)";
        $stmt_order = $con->prepare($sql_order);
        $stmt_order->bind_param("sid", $order_number, $user_id, $total_price);
        $stmt_order->execute();

        // ดึงค่า order_id ที่เพิ่งถูกสร้างขึ้น
        $order_id = $con->insert_id;

        // 3. การอัปโหลดไฟล์
        if (isset($_FILES['paymentReceipt']) && $_FILES['paymentReceipt']['error'] === UPLOAD_ERR_OK) {
            $upload_dir = 'src/receipts/';
            $file_name = uniqid() . '-' . basename($_FILES['paymentReceipt']['name']);
            $file_tmp_path = $_FILES['paymentReceipt']['tmp_name'];
            $file_path = $upload_dir . $file_name;

            if (move_uploaded_file($file_tmp_path, $file_path)) {
                // ไฟล์อัปโหลดสำเร็จ, เก็บเฉพาะชื่อไฟล์
                $slip_image = $file_name;
            } else {
                throw new Exception("Failed to move uploaded file.");
            }
        }

        // 2. บันทึกข้อมูลลงใน booking_detail รวม slip_image
        $sql_detail = "INSERT INTO booking_detail (order_id, room_id, firstname, lastname, email, phone, room_name, checkin, checkout, nights, total_price, slip_image)
               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt_detail = $con->prepare($sql_detail);
        $stmt_detail->bind_param("iisssssssids", $order_id, $room_id, $firstname, $lastname, $email, $phone, $room_name, $checkin, $checkout, $nights, $total_price, $slip_image);
        $stmt_detail->execute();

        // Commit transaction เมื่อทุกอย่างสำเร็จ
        mysqli_commit($con);
        echo "Booking and payment successfully saved.";
    } catch (Exception $e) {
        // Rollback เมื่อมีข้อผิดพลาด
        mysqli_rollback($con);
        echo "Error: " . $e->getMessage();
    }

    // ปิด statement
    $stmt_order->close();
    $stmt_detail->close();
}
