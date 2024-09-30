<?php
session_start();

// ตรวจสอบสถานะการล็อกอิน
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    echo "not_logged_in";  // ส่งกลับข้อมูลว่าผู้ใช้ยังไม่ได้เข้าสู่ระบบ
} else {
    echo "logged_in";  // ส่งกลับข้อมูลว่าผู้ใช้ล็อกอินแล้ว
}
?>
