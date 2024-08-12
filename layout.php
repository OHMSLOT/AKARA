<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Crimson+Text:ital,wght@0,400;0,600;0,700;1,400;1,600;1,700&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
</head>

<body>
    <?php require('inc/modal.php') ?>
    <header>
        <div class="contact-info">
            <span>
                <img src="src/ic-phone.png">
                +6653 215 995
            </span>
            <span>
                <img src="src/ic-mail.png">
                reservation@thaiakara.com
            </span>
            <button id="Sign-up-btn" class="sign-up-btn">Sign up</button>
        </div>
        <div class="banner">
            <img class="logo" src="src/logo.png" alt="">
            <ul class="nav">
                <li><a href="#">Home</a></li>
                <li><a href="#">Room Type</a></li>
                <li><a href="#">Facilities</a></li>
                <li><a href="#">Gallery</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
        </div>
    </header>
    <div class="center">
        <div class="content">
            <?php include 'index.php'; ?>
        </div>
    </div>
    <footer>

    </footer>
</body>

</html>