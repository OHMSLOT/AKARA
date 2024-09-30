<?php
session_start();
require('../admin/inc/db_config.php');
require('../admin/inc/essentials.php');

// ตรวจสอบว่าข้อมูลถูกส่งมาครบถ้วนหรือไม่
if (isset($_POST['name']) && isset($_POST['phone']) && isset($_POST['dob']) && isset($_POST['address']) && isset($_POST['pincode'])) {
    
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $address = $_POST['address'];
    $pincode = $_POST['pincode'];

    // อัปเดตข้อมูลในฐานข้อมูล
    $query = "UPDATE `users` SET `name`=?, `phone`=?, `date_of_birth`=?, `address`=?, `pincode`=? WHERE `id`=?";
    $values = [$name, $phone, $dob, $address, $pincode, $_SESSION['uId']];
    $result = update($query, $values, 'sssssi');

    if ($result) {
        // อัปเดตข้อมูลใน $_SESSION
        $_SESSION['uName'] = $name; // อัปเดตชื่อในเซสชันด้วย

        // ส่งผลลัพธ์กลับไปให้ JavaScript
        echo json_encode(['success' => true]);
    } else {
        // หากการอัปเดตไม่สำเร็จ
        echo json_encode(['success' => false, 'message' => 'Database update failed']);
    }
} else {
    // หากข้อมูลไม่ครบถ้วน
    echo json_encode(['success' => false, 'message' => 'Incomplete data']);
}
?>
