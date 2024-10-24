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
    <style>
        .reset-password-container {
            max-width: 450px;
            margin: 50px auto;
            background-color: #ffffff;
            box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.2);
            border-radius: 15px;
            padding: 30px;
            text-align: center;
        }

        .reset-password-header {
            margin-bottom: 30px;
        }

        .reset-password-header h1 {
            font-size: 32px;
            font-weight: bold;
            color: #000000;
            margin-bottom: 5px;
        }

        .reset-password-header p {
            font-size: 16px;
            color: #666;
        }
    </style>
</head>

<body>
    <?php require('inc/header.php'); ?>
    <div class="reset-password-container">
        <div class="reset-password-header">
            <h1>Reset Password</h1>
            <p>Enter a new password for your account</p>
        </div>
        <form action="reset_password.php" method="POST">
            <input type="hidden" name="token" value="<?php echo htmlspecialchars($_GET['token'] ?? ''); ?>" required>
            <input type="password" class="form-control shadow-none mb-4" name="password" placeholder="Enter new password" required>
            <input type="password" class="form-control shadow-none mb-4" name="confirm_password" placeholder="Confirm new password" required>
            <button type="submit" class="btn custom-bg w-100 text-white shadow-none mb-4">Reset Password</button>
        </form>
    </div>
    <?php require('inc/footer.php'); ?>
</body>

</html>