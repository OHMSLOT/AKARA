<?php
require('admin/inc/essentials.php');

session_start(); 
session_destroy();  // ทำลาย session

header("Location: index.php"); // หลังจาก logout ให้ redirect ไปที่หน้าแรก
exit();
