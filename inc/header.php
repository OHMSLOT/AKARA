<?php
require('admin/inc/db_config.php');
require('admin/inc/essentials.php');

$contact_q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
$values = [1];
$contact_r = mysqli_fetch_assoc(select($contact_q, $values, 'i'));  
?>

<nav class="py-2 bg-light border-bottom custom-border border-2">
    <div class="container d-flex flex-wrap">
        <ul class="nav me-auto gap-3">
            <div class="d-flex align-items-center">
                <i style="font-size: 18px;" class="bi bi-telephone-fill me-1"></i>+6653 215 995
            </div>
            <div class="d-flex align-items-center">
                <i style="font-size: 20px;" class="bi bi-envelope-fill me-2"></i>reservation@thaiakara.com
            </div>
        </ul>
        <ul class="nav">
            <button type="button" class="btn custom-outline-bg text-p me-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
            <button type="button" class="btn custom-bg text-light" data-bs-toggle="modal" data-bs-target="#registerModal">Sign-up</button>
        </ul>
    </div>
</nav>
<!-- banner section -->
<div class="container-fluid px-0">
    <div class="banner">
        <img class="logo" src="src/logo.png">
    </div>
</div>
<!-- navbar section -->
<nav class="navbar navbar-expand-lg stiky-top py-0" id="nav-bar-menu">
    <div class="container-fluid p-0">
        <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsdropdown" aria-controls="navbarsdropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-collapse collapse custom_bg justify-content-md-center" id="navbarsdropdown">
            <ul class="navbar-nav gap-2">
                <li class="nav-item">
                    <a class="nav-link px-4 text-light" href="index.php">HOME</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-4 text-light" href="room-type.php">ROOM TYPE</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-4 text-light" href="facilities.php">FACILITIES</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-4 text-light" href="gallery.php">GALLERY</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link px-4 text-light" href="contact.php">CONTACT</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
