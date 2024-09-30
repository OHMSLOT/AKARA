<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <?php require('inc/links.php'); ?>
</head>

<body>
    <?php require('inc/header.php'); ?>
    <?php
    if (!isset($_SESSION['login']) && $_SESSION['login'] == true) {
        redirect('index.php');
    }
    ?>

    <div class="container">
        <div class="row">
            <div class="col-12 my-5 mb-4 px-4">
                <h1 class="fw-semibold">CONFIRM BOOKING</h1>
                <div style="font-size: 14px;">
                    <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
                    <span class="text-secondary"> > </span>
                    <a href="room.php" class="text-secondary text-decoration-none">BOOKING</a>
                </div>
            </div>
            <div class="col-lg-8 mx-auto">
                <form action="profile.php" method="POST">
                    <div class="mb-3">
                        <label for="firstname" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $user_data['firstname']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="lastname" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $user_data['lastname']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo $user_data['email']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="tel" class="form-control" id="phone" name="phone" value="<?php echo $user_data['phone']; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Update Profile</button>
                </form>
            </div>
        </div>
    </div>

    <?php require('inc/footer.php'); ?>
</body>

</html>