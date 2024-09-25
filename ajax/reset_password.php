<?php
require('admin/inc/db_config.php');
require('admin/inc/essentials.php');

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // ตรวจสอบว่าโทเค็นถูกต้องและยังไม่หมดอายุ
    $query = "SELECT * FROM `users` WHERE `reset_token` = ? AND `token_expire` > NOW() LIMIT 1";
    $result = select($query, [$token], "s");

    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        if (isset($_POST['new_password'])) {
            $new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

            // อัปเดตรหัสผ่านใหม่และลบโทเค็น
            $update_query = "UPDATE `users` SET `password` = ?, `reset_token` = NULL, `token_expire` = NULL WHERE `id` = ?";
            $update_result = update($update_query, [$new_password, $user['id']], "si");

            if ($update_result) {
                echo "Password reset successfully.";
            } else {
                echo "Error resetting password.";
            }
        }
    } else {
        echo "Invalid or expired token.";
    }
}
?>

<!-- HTML สำหรับหน้าเปลี่ยนรหัสผ่าน -->
<form method="POST">
    <label>New Password:</label>
    <input type="password" name="new_password" required>
    <button type="submit">Reset Password</button>
</form>
