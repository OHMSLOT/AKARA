<?php
include('inc/db_config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the admin name and password from the form
    $admin_name = $_POST['admin_name'];
    $admin_pass = $_POST['admin_pass'];

    // Hash the password
    $hashed_pass = password_hash($admin_pass, PASSWORD_DEFAULT);

    // Check if the admin name already exists
    $sql = "SELECT sr_no FROM admin_cred WHERE admin_name = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $admin_name);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $error = "Admin name already taken.";
    } else {
        // Insert the new admin credentials into the database
        $sql = "INSERT INTO admin_cred (admin_name, admin_pass) VALUES (?, ?)";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("ss", $admin_name, $hashed_pass);

        if ($stmt->execute()) {
            $success = "Registration successful! You can now <a href='login.php'>login</a>.";
        } else {
            $error = "There was an error in registration. Please try again.";
        }
    }

    $stmt->close();
}

$con->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <?php require('inc/links.php'); ?>
    <style>
        div.login-form {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
        }
    </style>
</head>

<body>
    <div class="login-form text-center">
        <h2 class="py-3">Admin Register Page</h2>

        <?php
            if (isset($error)) {
                echo "<p style='color:red;'>$error</p>";
            }
            if (isset($success)) {
                echo "<p style='color:green;'>$success</p>";
            }
        ?>

        <form action="register.php" method="post">
            <div class="mb-3">
                <input type="text" name="admin_name" class="form-control" placeholder="Admin Name" required>
            </div>
            <div class="mb-3">
                <input type="password" name="admin_pass" class="form-control" placeholder="Admin Password" required>
            </div>
            <input type="submit" value="Register" class="btn btn-dark">
        </form>
    </div>
</body>

</html>