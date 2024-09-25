<?php
require('../admin/inc/db_config.php');
require('../admin/inc/essentials.php');

session_start(); // เริ่มต้น session

if (isset($_POST['login'])) {
    // กรองข้อมูลจากฟอร์ม
    $data = filteration($_POST);

    // ตรวจสอบผู้ใช้ในฐานข้อมูลด้วยอีเมลหรือเบอร์โทรศัพท์
    $u_exist = select("SELECT * FROM `users` WHERE `email` = ? OR `phone` = ? LIMIT 1", [$data['login_email'], $data['login_email']], "ss");

    if (mysqli_num_rows($u_exist) == 0) {
        echo 'inv_email'; // ไม่พบผู้ใช้
    } else {
        $u_fetch = mysqli_fetch_assoc($u_exist);

        // ตรวจสอบรหัสผ่าน
        if (!password_verify($data['login_password'], $u_fetch['password'])) {
            echo 'inv_pass'; // รหัสผ่านไม่ถูกต้อง
        } else {
            // ตั้งค่าการเข้าสู่ระบบใน session
            $_SESSION['login'] = true;
            $_SESSION['uId'] = $u_fetch['id'];
            $_SESSION['uName'] = $u_fetch['name'];
            $_SESSION['uPic'] = $u_fetch['picture'];

            // ตรวจสอบว่าผู้ใช้เลือก "Remember Me" หรือไม่
            if (isset($data['remember_me']) && $data['remember_me'] == 1) {
                // ตั้งค่าคุกกี้ให้เก็บข้อมูล login_email และ login_password
                setcookie('login_email', $data['login_email'], time() + (86400 * 30), "/"); // เก็บไว้ 30 วัน
                setcookie('login_password', $data['login_password'], time() + (86400 * 30), "/"); // เก็บไว้ 30 วัน
            } else {
                // ลบคุกกี้ถ้าไม่ได้เลือก Remember Me
                if (isset($_COOKIE['login_email'])) {
                    setcookie('login_email', '', time() - 3600, "/");
                }
                if (isset($_COOKIE['login_password'])) {
                    setcookie('login_password', '', time() - 3600, "/");
                }
            }

            echo 'login_success'; // ส่งสัญญาณล็อกอินสำเร็จ
        }
    }
}
?>
