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

<!-- Modal -->
<div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form id="register_form"> <!-- เพิ่ม form id -->
                <div class="modal-header">
                    <h1 class="modal-title fs-2 fw-bold d-flex align-items-center">Register</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span class="badge rounded-pill text-bg-light mb-3 text-wrap lh-base">
                        Note: Your details must match with your ID (ID card, passport, driving license, etc.)
                        that will be required during check-in.
                    </span>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 mb-3 ps-0">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control shadow-none" name="name">
                            </div>
                            <div class="col-md-6 mb-3 p-0">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control shadow-none" name="email">
                            </div>
                            <div class="col-md-6 mb-3 ps-0">
                                <label class="form-label">Phone Number</label>
                                <input type="number" class="form-control shadow-none" name="phone">
                            </div>
                            <div class="col-md-6 mb-3 p-0">
                                <label class="form-label">Picture</label>
                                <input type="file" class="form-control shadow-none" name="picture">
                            </div>
                            <div class="col-md-12 mb-3 p-0">
                                <label class="form-label">Address</label>
                                <textarea class="form-control shadow-none" name="address" rows="1"></textarea>
                            </div>
                            <div class="col-md-6 mb-3 ps-0">
                                <label class="form-label">Pincode</label>
                                <input type="number" class="form-control shadow-none" name="pincode">
                            </div>
                            <div class="col-md-6 mb-3 p-0">
                                <label class="form-label">Date of birth</label>
                                <input type="date" class="form-control shadow-none" name="dob">
                            </div>
                            <div class="col-md-6 mb-3 ps-0">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control shadow-none" name="password">
                            </div>
                            <div class="col-md-6 mb-3 p-0">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" class="form-control shadow-none" name="confirm_password">
                            </div>
                        </div>
                    </div>
                    <div class="text-center my-2">
                        <button type="submit" class="btn btn-md custom-bg text-white shadow-none">REGISTER</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="loginModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header p-5 pb-4 border-bottom-0">
                <h1 class="fw-bold mb-0 fs-2">Login</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body p-5 pt-0">
                <form class="login__form">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control rounded-3" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Email address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control rounded-3" id="floatingPassword" placeholder="Password">
                        <label for="floatingPassword">Password</label>
                    </div>
                    <button class="btn w-100 mb-2 btn-lg rounded-3 custom-bg text-white" type="submit">Sign up</button>
                    <small class="text-body-secondary">By clicking Sign up, you agree to the terms of use.</small>
                    <!-- <hr class="my-4">
                    <h2 class="fs-5 fw-bold mb-3">Or use a third-party</h2>
                    <button class="w-100 py-2 mb-2 btn btn-outline-secondary rounded-3" type="submit">
                        <svg class="bi me-1" width="16" height="16">
                            <use xlink:href="#twitter"></use>
                        </svg>
                        Sign up with Twitter
                    </button>
                    <button class="w-100 py-2 mb-2 btn btn-outline-primary rounded-3" type="submit">
                        <svg class="bi me-1" width="16" height="16">
                            <use xlink:href="#facebook"></use>
                        </svg>
                        Sign up with Facebook
                    </button>
                    <button class="w-100 py-2 mb-2 btn btn-outline-secondary rounded-3" type="submit">
                        <svg class="bi me-1" width="16" height="16">
                            <use xlink:href="#github"></use>
                        </svg>
                        Sign up with GitHub
                    </button> -->
                </form>
            </div>
        </div>
    </div>
</div>