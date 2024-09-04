<?php
session_start();
include('inc/db_config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the admin name and password from the form
    $admin_name = $_POST['admin_name'];
    $admin_pass = $_POST['admin_pass'];

    // Prepare and execute the SQL statement
    $sql = "SELECT sr_no, admin_pass FROM admin_cred WHERE admin_name = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("s", $admin_name);
    $stmt->execute();
    $stmt->store_result();

    // Check if the admin exists
    if ($stmt->num_rows > 0) {
        // Bind the result to variables
        $stmt->bind_result($id, $hashed_pass);
        $stmt->fetch();

        // Verify the password  
        if (password_verify($admin_pass, $hashed_pass)) {
            // Start a session and save the admin ID
            $_SESSION['admin_id'] = $id;
            $_SESSION['admin_name'] = $admin_name;
            header("Location: welcome.php"); // Redirect to a welcome page
            exit;
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No admin found with that name.";
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
    <title>Admin Login Panel</title>
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

<body class="bg-light">
    <div class="login-form text-center">
        <h2 class="py-3">Admin Login Page</h2>

        <?php
        if (isset($error)) {
            echo "<p style='color:red;'>$error</p>";
        }
        ?>

        <form action="login.php" method="post">
            <div class="mb-3">
                <input type="text" name="admin_name" class="form-control" placeholder="Admin Name" required>
            </div>
            <div class="mb-3">
                <input type="password" name="admin_pass" class="form-control" placeholder="Password" required>
            </div>
            <input type="submit" value="Login" class="btn btn-dark">
        </form>
    </div>
    <?php require('inc/script.php') ?>
</body>

</html>