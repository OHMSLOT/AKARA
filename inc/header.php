<?php
require_once('admin/inc/db_config.php');
require_once('admin/inc/essentials.php');

$contact_q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
$values = [1];
$contact_r = mysqli_fetch_assoc(select($contact_q, $values, 'i'));

if(isset($_COOKIE['login_email'])&& isset($_COOKIE['login_password'])){
    $id = $_COOKIE['login_email'];
    $pass = $_COOKIE['login_password'];
}
else{
    $id = "";
    $pass = "";
}

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
        <?php
            if (isset($_SESSION['login']) && $_SESSION['login'] == true) {
                $path = USERS_IMG_PATH;
                echo<<<data
                <div class="btn-group">
                    <button type="button" class="btn custom-outline-bg text-p dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
                        <img src="$path$_SESSION[uPic]" class="me-1 rounded-5" style="width: 25px; height: 25px;">
                        $_SESSION[uName]
                    </button>
                    <ul class="dropdown-menu dropdown-menu-lg-end">
                        <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                        <li><a class="dropdown-item" href="bookings.php">Bookings</a></li>
                        <li><a class="dropdown-item" href="logout.php">logout</a></li>
                    </ul>
                </div>
                data;
            }
            else{
                echo<<<data
                    <ul class="nav">
                        <button type="button" class="btn custom-outline-bg text-p me-2" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                        <button type="button" class="btn custom-bg text-light" data-bs-toggle="modal" data-bs-target="#registerModal">Sign-up</button>
                    </ul>
                data;
            }
        ?> 
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

<!-- Register Modal -->
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
<!-- <div class="modal fade" id="loginModal">
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
                </form>
            </div>
        </div>
    </div>
</div> -->

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="login_form">
                <div class="modal-header">
                    <h3 class="modal-title" id="loginModalLabel">Login</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-floating mb-4 mt-3">
                        <input type="email" class="form-control" id="loginEmail" name="login_email" placeholder="Enter your email" value="<?php echo $id ?>" required>
                        <label for="floatingInput">Email address</label>
                    </div>
                    <div class="form-floating mb-4">
                        <input type="password" class="form-control" id="loginPassword" name="login_password" placeholder="Enter your password" value="<?php echo $pass ?>" required>
                        <label for="floatingPassword">Password</label>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="rememberMe" name="rememberMe">
                            <label class="form-check-label" for="rememberMe">Remember me</label>
                        </div>
                        <div class="mb-3">
                            <!-- <a href="#" id="forgotPasswordLink">Forgot password?</a> -->
                            <button type="button" class="btn text-secondary text-decoration-none shadow-none p-0" data-bs-toggle="modal" data-bs-target="#forgotPasswordModal" data-bs-dismiss="modal">Forgot password?</button>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-lg custom-bg text-white w-100">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Forgot Password Modal -->
<div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="forgotPasswordModalLabel">Forgot Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="forgotPasswordForm">
                    <div class="mb-3">
                        <label for="resetEmail" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="resetEmail" name="reset_email" placeholder="Enter your email to reset password" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="sendResetLinkBtn">Send Reset Link</button>
            </div>
        </div>
    </div>
</div>

