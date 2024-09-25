<?php
require('../admin/inc/db_config.php');
require('../admin/inc/essentials.php');

if (isset($_POST['reset_email'])) {
    $email = filter_var($_POST['reset_email'], FILTER_SANITIZE_EMAIL);

    // ตรวจสอบว่ามีอีเมลในระบบหรือไม่
    $u_exist = select("SELECT * FROM `users` WHERE `email` = ? LIMIT 1", [$email], "s");

    if (mysqli_num_rows($u_exist) == 0) {
        echo "no_email"; // ไม่พบอีเมล
    } else {
        $u_fetch = mysqli_fetch_assoc($u_exist);
        $token = bin2hex(random_bytes(50)); // สร้างโทเค็นแบบสุ่ม

        // บันทึกโทเค็นสำหรับใช้รีเซ็ตรหัสผ่าน
        $query = "UPDATE `users` SET `reset_token` = ?, `token_expire` = DATE_ADD(NOW(), INTERVAL 30 MINUTE) WHERE `email` = ?";
        $values = [$token, $email];
        $result = update($query, $values, "ss");

        if ($result) {
            // ส่งอีเมลรีเซ็ตรหัสผ่าน
            $reset_link = "http://yourdomain.com/reset_password.php?token=" . $token;
            $subject = "Reset Your Password";
            $message = "Click the following link to reset your password: $reset_link";
            $headers = "From: noreply@yourdomain.com";

            if (mail($email, $subject, $message, $headers)) {
                echo "email_sent"; // ส่งอีเมลสำเร็จ
            } else {
                echo "email_failed"; // ส่งอีเมลไม่สำเร็จ
            }
        } else {
            echo "token_failed"; // การบันทึกโทเค็นไม่สำเร็จ
        }
    }
}
?>
