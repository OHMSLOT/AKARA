<?php
$error_message = ""; // เพื่อเก็บข้อความข้อผิดพลาด
$email = ""; // เพื่อเก็บอีเมลของผู้ใช้

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // ตรวจสอบว่ารหัสผ่านทั้งสองช่องตรงกันหรือไม่
    if ($password !== $confirm_password) {
        $error_message = "รหัสผ่านไม่ตรงกัน."; // เก็บข้อความข้อผิดพลาด
    } else {
        $new_password = password_hash($password, PASSWORD_DEFAULT);

        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "akara";
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Validate the token using prepared statement
        $stmt = $conn->prepare("SELECT * FROM users WHERE reset_token=?");
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $token_expiry = $row['token_expiry'];
            $email = $row['email']; // ดึงอีเมลจากฐานข้อมูล

            // Check if token has expired
            if (new DateTime() > new DateTime($token_expiry)) {
                header("Location: reset_password.php?error=Token has expired. Please request a new password reset link.");
                exit();
            } else {
                // Update the password using prepared statement
                $update_stmt = $conn->prepare("UPDATE users SET password=?, reset_token=NULL, token_expire=NULL WHERE reset_token=?");
                $update_stmt->bind_param("ss", $new_password, $token);
                if ($update_stmt->execute()) {
                    header("Location: reset_password.php?success=1"); // Redirect to reset_password page
                    exit();
                } else {
                    header("Location: reset_password.php?error=Error updating password.");
                    exit();
                }
                $update_stmt->close();
            }
        } else {
            header("Location: reset_password.php?error=Invalid token.");
            exit();
        }

        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require('inc/links.php'); ?>
    <title>Reset Password</title>
</head>

<body>
    <?php require('inc/header.php'); ?>
    <div class="my-5 px-4">
        <h1 class="fw-semibold c-font text-center">RESER PASSWORD</h1>
        <p class="text-center mt-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore, mollitia porro! Illum est, <br>
            at sit eius eveniet corporis accusantium, quae similique unde libero soluta quam aperiam neque facere, quia nam?
        </p>
    </div>
    <div class="login">
        <form action="reset_password.php" method="POST">
            <div class="login-header">
                <header>Reset Password</header>
                <p>Enter a new password for you</p>
            </div>
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token'] ?? ''); ?>" required>
            <div class="input-box">
                <input type="password" class="input-field" name="password" placeholder="Enter new password" required>
            </div>
            <div class="input-box">
                <input type="password" class="input-field" name="confirm_password" id="confirm_password" placeholder="Confirm new password" required>
                <?php if (!empty($error_message)): ?>
                    <small class="error-message"><?php echo $error_message; ?></small> <!-- แสดงข้อความข้อผิดพลาด -->
                <?php endif; ?>
            </div>
            <div class="input-submit">
                <button class="submit-btn" id="submit"></button>
                <label for="submit">Reset Password</label>
            </div>
        </form>
    </div>

    <?php require('inc/footer.php'); ?>
</body>

</html>