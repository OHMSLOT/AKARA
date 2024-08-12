<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require('inc/links.php') ?>
    <style>
        /* * {
            font-family: "Crimson Text", serif;
        }

        .c-font {
            font-family: "Inter", sans-serif;
        } */

        .image {
            display: block;
            width: 100%;
            object-fit: cover;
        }

        .fs-18 {
            font-size: 18px;
        }
    </style>
</head>

<body>
    <!-- header -->
    <!-- <header>
        <div class="contact">
            <div class="contact-info">
                <div class="contact-p">
                    <img src="src/ic-phone.png">
                    +6653 215 995
                </div>
                <div class="contact-m">
                    <img src="src/ic-mail.png">
                    reservation@thaiakara.com
                </div>
            </div>
            <div class="head-btn">
                <button class="sign-up-btn" data-bs-toggle="modal" data-bs-target="#registerModal">Register</button>
                <button class="login-btn" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
            </div>
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
    </header> -->
    <?php require('inc/header.php') ?>
    <!-- search -->
    <section class="booking__container">
        <div class="container">
            <img src="src/image 3.png" class="slider" alt="Hotel Room">
        </div>

        <div class="container search-form">
            <div class="row">
                <div class="col-lg-10 col-md-10 col-sm-10 custom_bg mx-auto py-4 px-5">
                    <form>
                        <div class="row align-items-end">
                            <div class="col-lg-3 mb-2">
                                <label class="form-label fw-medium">Check-in</label>
                                <input type="date" class="form-control shadow-none">
                            </div>
                            <div class="col-lg-3 mb-2">
                                <label class="form-label fw-medium">Check-out</label>
                                <input type="date" class="form-control shadow-none">
                            </div>
                            <div class="col-lg-3 mb-2">
                                <label class="form-label fw-medium">Adult</label>
                                <select class="form-select shadow-none">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                            <div class="col-lg-2 mb-2">
                                <label class="form-label fw-medium">Children</label>
                                <select class="form-select shadow-none">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                </select>
                            </div>
                            <div class="col-lg-1 mb-lg-2 mt-3">
                                <button type="submit" class="btn btn-light text-dark shadow-none">Search</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </section>
    <!-- history -->
    <section class="history__container">
        <div class="container pt-5">
            <div class="my-5 px-4 pt-5">
                <h1 class="fw-semibold c-font text-center">. Heart of Chiang Mai .</h1>
            </div>
            <div class="container px-0">
                <img class="image" style="height: 700px;" src="src/carousel1.jpg" alt="">
            </div>
            <p class="my-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore, mollitia porro! Illum est,
                at sit eius eveniet corporis accusantium, quae similique unde libero soluta quam aperiam neque facere, quia nam?
            </p>
        </div>
    </section>
    <!-- room-type -->
    <section class="room__container">
        <div class="room-type">
            <div class="head-container">
                <div class="head-roomtype">
                    <h1>ROOM TYPE</h1>
                    <a href="#" class="allroom-btn">ALL ROOMS</a>
                </div>
            </div>
            <div class="card-container">
                <div class="card-ts">
                    <img src="src/LINE_ALBUM_Superior room Thai Akara_240716_1.jpg" alt="">
                    <div class="card-content">
                        <h3>Superior room</h3>
                        <h5>Features</h5>
                        <div class="features">
                            <span class="badge">
                                50 m2
                            </span>
                            <span class="badge">
                                1 beds
                            </span>
                            <span class="badge">
                                1 bathroom
                            </span>
                            <span class="badge">
                                1 balcony
                            </span>
                        </div>
                        <div class="line"></div>
                        <div class="card-footer">
                            <div class="card-price">
                                <span>Start from</span>
                                <h3>$1500/night</h3>
                            </div>
                            <div class="detail">
                                <a href="#" class="btn btn-outline-light">DETAIL</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-ts">
                    <img src="src/LINE_ALBUM_Superior room Thai Akara_240716_1.jpg" alt="">
                    <div class="card-content">
                        <h3>Superior room</h3>
                        <h5>Features</h5>
                        <div class="features">
                            <span class="badge">
                                50 m2
                            </span>
                            <span class="badge">
                                1 beds
                            </span>
                            <span class="badge">
                                1 bathroom
                            </span>
                            <span class="badge">
                                1 balcony
                            </span>
                        </div>
                        <div class="line"></div>
                        <div class="card-footer">
                            <div class="card-price">
                                <span>Start from</span>
                                <h3>$1500/night</h3>
                            </div>
                            <div class="detail">
                                <a href="#" class="btn btn-outline-light">DETAIL</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-ts">
                    <img src="src/LINE_ALBUM_Superior room Thai Akara_240716_1.jpg" alt="">
                    <div class="card-content">
                        <h3>Superior room</h3>
                        <h5>Features</h5>
                        <div class="features">
                            <span class="badge">
                                50 m2
                            </span>
                            <span class="badge">
                                1 beds
                            </span>
                            <span class="badge">
                                1 bathroom
                            </span>
                            <span class="badge">
                                1 balcony
                            </span>
                        </div>
                        <div class="line"></div>
                        <div class="card-footer">
                            <div class="card-price">
                                <span>Start from</span>
                                <h3>$1500/night</h3>
                            </div>
                            <div class="detail">
                                <a href="#" class="btn btn-outline-light">DETAIL</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- facilites -->
    <section class="facilities">
        <div class="container mt-5">
            <div class="row mb-2 gap-0">
                <div class="col-lg-6 col-md-12">
                    <h1 class="text-uppercase">Hotel Facilities</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Deleniti, dolores?</p>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 px-3">
                    <div class="facility-card">
                        <img style="height: 400px;" src="src/Fitness.jpg" class="img-fluid image" alt="Facility 1">
                        <div class="facility-card-title">
                            <h1 class="fs-5 fw-semibold c-font mb-0">FITNESS</h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 px-3">
                    <div class="facility-card">
                        <img style="height: 400px;" src="src/Pool_bar.jpg" class="img-fluid image" alt="Facility 1">
                        <div class="facility-card-title">
                            <h1 class="fs-5 fw-semibold c-font mb-0">POOL BAR</h1>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row gap-0">
                <div class="col-lg-6 col-md-6 mb-4 px-3">
                    <div class="facility-card">
                        <img style="height: 400px;" src="src/Restaurant.jpg" class="img-fluid image" alt="Facility 1">
                        <div class="facility-card-title">
                            <h1 class="fs-5 fw-semibold c-font mb-0">RESTAURANT</h1>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 mb-4 px-3">
                    <div class="facility-card">
                        <img style="height: 400px;" src="src/Swimming_pool.png" class="img-fluid image" alt="Facility 1">
                        <div class="facility-card-title">
                            <h1 class="fs-5 fw-semibold c-font mb-0">SWIMMING POOL</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Events section -->
    <!-- <section class="event__container"> -->
    <section>
        <div class="container-fluid bg-dark">
            <div class="container">
                <div class="py-5">
                    <h1 class="text-light text-center">Upcoming Events</h1>
                </div>
                <div class="row pb-5">
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card text-start bg-dark text-light">
                            <img src="src/event1.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h2 class="mb-3 c-font">BEAD BRACELET</h2>
                                <p class="mb-3 c-font fs-18"><i class="bi bi-clock me-1"></i> 12:00 - 16:00 PM</p>
                                <p class="mb-3 c-font fs-18"><i class="bi bi-calendar-event me-1"></i> 12 November 2024</p>
                                <a class="text-decoration-none text-light fs-5 c-font" href="#">SEE DETAIL</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card text-start bg-dark text-light">
                            <img src="src/event2.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h2 class="mb-3 c-font">BEAD BRACELET</h2>
                                <p class="mb-3 c-font fs-18"><i class="bi bi-clock me-1"></i> 12:00 - 16:00 PM</p>
                                <p class="mb-3 c-font fs-18"><i class="bi bi-calendar-event me-1"></i> 12 November 2024</p>
                                <a class="text-decoration-none text-light fs-5 c-font" href="#">SEE DETAIL</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card text-start bg-dark text-light">
                            <img src="src/event3.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h2 class="mb-3 c-font">BEAD BRACELET</h2>
                                <p class="mb-3 c-font fs-18"><i class="bi bi-clock me-1"></i> 12:00 - 16:00 PM</p>
                                <p class="mb-3 c-font fs-18"><i class="bi bi-calendar-event me-1"></i> 12 November 2024</p>
                                <a class="text-decoration-none text-light fs-5 c-font" href="#">SEE DETAIL</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- map -->
    <?php
    $contact_q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
    $values = [1];
    $contact_r = mysqli_fetch_assoc(select($contact_q, $values, 'i'));
    print_r($contact_r);
    ?>

    <section>
        <h1 class="mt-5 pt-4 mb-4 text-center fw-medium c-font fs-48">Reach us</h1>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 mb-3 rounded">
                    <iframe class="w-100" height="550" src="<?php echo $contact_r['iframe']?>"></iframe>
                </div>
            </div>
        </div>

    </section>
    <!-- Modal -->
    <?php require('inc/modal-login.php') ?>
    <?php require('inc/modal-register.php') ?>
    <!-- footer -->
    <?php require('inc/footer.php') ?>
</body>
<?php require('inc/script.php') ?>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->

</html>