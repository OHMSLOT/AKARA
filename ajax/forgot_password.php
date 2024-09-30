<?php
require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// ฟังก์ชันสร้าง token
function generateToken() {
    return bin2hex(random_bytes(16));
}

// เชื่อมต่อฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "akara";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
    $userEmail = trim($_POST['email']); // ตรวจสอบอีเมลจากฟอร์ม

    if (!filter_var($userEmail, FILTER_VALIDATE_EMAIL)) {
        echo "ที่อยู่อีเมลไม่ถูกต้อง";
    } else {
        // สร้าง token และวันหมดอายุ (1 ชั่วโมงจากเวลาปัจจุบัน)
        $token = generateToken();
        $expiry = date("Y-m-d H:i:s", strtotime('+1 hour'));

        // บันทึก token และวันหมดอายุในฐานข้อมูล
        $stmt = $conn->prepare("UPDATE users SET reset_token=?, token_expire=? WHERE email=?");
        $stmt->bind_param("sss", $token, $expiry, $userEmail);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            $stmt->close();
            $mail = new PHPMailer(true);

            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';  // ใช้ SMTP ของ Gmail
                $mail->SMTPAuth   = true;
                $mail->Username   = 'kulwadee45@gmail.com';  // อีเมลของคุณ
                $mail->Password   = 'oqbi xoob sfrj cpzh';  // App password ของ Gmail
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // การเข้ารหัส TLS
                $mail->Port       = 587;

                // Recipients
                $mail->setFrom('kulwadee45@gmail.com', 'Mailer');
                $mail->addAddress($userEmail);  // ส่งอีเมลไปยังที่อยู่ที่กรอก

                // Content
                $mail->isHTML(true);
                $resetLink = "http://localhost/AKARA/reset_password.php?token=" . $token; // สร้างลิงค์รีเซ็ตรหัสผ่าน
                $mail->Subject = 'Reset Password Poolvila';
                $mail->Body    = 'กรุณาคลิกที่ลิงค์นี้เพื่อตั้งค่ารหัสผ่านใหม่: <a href="' . $resetLink . '">รีเซ็ตรหัสผ่าน</a>';
                $mail->AltBody = 'กรุณาคลิกที่ลิงค์นี้เพื่อตั้งค่ารหัสผ่านใหม่: ' . $resetLink;

                $mail->send();
                echo 'ข้อความได้ถูกส่งไปยังอีเมลของคุณ กรุณาตรวจสอบเพื่อทำการรีเซ็ตรหัสผ่าน';
            } catch (Exception $e) {
                echo "ไม่สามารถส่งข้อความได้. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            echo "อีเมลนี้ไม่ถูกต้อง กรุณาใส่อีเมลใหม่";
        }
    }
}

$conn->close();
?>
