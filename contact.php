<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <?php require('inc/links.php') ?>
</head>

<body>
    <?php require('inc/header.php') ?>

    <div class="my-5 px-4">
        <h1 class="fw-semibold c-font text-center">CONTACT</h1>
        <p class="text-center mt-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolore, mollitia porro! Illum est, <br>
            at sit eius eveniet corporis accusantium, quae similique unde libero soluta quam aperiam neque facere, quia nam?
        </p>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 mb-5 px-4">
                <div class="bg-white shadow p-4">
                    <iframe class="w-100 mb-4" height="320" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2245.9240966634975!2d98.98994768834675!3d18.790172583920928!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30da3a98667fe3d5%3A0xfe635098d07b53d6!2sThai%20Akara%20-%20Lanna%20Boutique%20Hotel!5e0!3m2!1sth!2sth!4v1723064266676!5m2!1sth!2sth" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    <h5>Address</h5>
                    <a href="https://maps.app.goo.gl/aaSXNsBuJxeqq6u16" target="_blank" class="d-inline-block text-decoration-none text-dark mb-3">
                        <i class="bi bi-geo-alt-fill me-1"></i> 133 ถนน ราชภาคินัย ตำบลศรีภูมิ เมือง เชียงใหม่ 50200
                    </a>
                    <h5 class="mt-4">Call us</h5>
                    <a href="tel: +6653 215 995" class="d-inline-block mb-2 text-decoration-none text-dark">
                        <i class="bi bi-telephone-fill"></i> +6653 215 995
                    </a>
                    <br>
                    <a href="tel: +6653 215 995" class="d-inline-block text-decoration-none text-dark">
                        <i class="bi bi-telephone-fill"></i> +6653 215 995
                    </a>
                    <h5 class="mt-4">Email</h5>
                    <a href="mailto: reservation@thaiakara.com" class="d-inline-block text-decoration-none text-dark">
                        <i class="bi bi-envelope-fill me-1"></i> reservation@thaiakara.com
                    </a>
                    <h5 class="mt-4">Follow us</h5>
                    <a href="#" class="d-inline-block text-dark fs-4 me-2">
                        <i class="bi bi-facebook me-1"></i>
                    </a>
                    <a href="#" class="d-inline-block text-dark fs-4">
                        <i class="bi bi-instagram me-1"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mb-5 px-4">
                <div class="bg-white shadow p-4">
                    <form>
                        <h5>Send a message</h5>
                        <div class="mt-3">
                            <label class="form-label fw-medium">Name</label>
                            <input type="text" class="form-control shadow-none">
                        </div>
                        <div class="mt-3">
                            <label class="form-label fw-medium">Email</label>
                            <input type="email" class="form-control shadow-none">
                        </div>
                        <div class="mt-3">
                            <label class="form-label fw-medium">Subject</label>
                            <input type="text" class="form-control shadow-none">
                        </div>
                        <div class="mt-3">
                            <label class="form-label fw-medium">Message</label>
                            <textarea class="form-control shadow-none" rows="6" style="resize: none;"></textarea>
                        </div>
                        <button type="submit" class="btn custom-bg text-light shadow-none mt-3 px-3">SEND</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php require('inc/modal-login.php') ?>
    <?php require('inc/modal-register.php') ?>
    <?php require('inc/footer.php') ?>
    
</body>
<?php require('inc/script.php') ?>

</html>