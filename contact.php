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
                    <iframe class="w-100 mb-4" height="320" src="<?php echo $contact_r['iframe'] ?>"></iframe>
                    <h5>Address</h5>
                    <a href="<?php echo $contact_r['gmap'] ?>" target="_blank" class="d-inline-block text-decoration-none text-dark mb-3">
                        <i class="bi bi-geo-alt-fill me-1"></i> <?php echo $contact_r['address'] ?>
                    </a>
                    <h5 class="mt-4">Call us</h5>
                    <a href="tel: +<?php echo $contact_r['pn1'] ?>" class="d-inline-block mb-2 text-decoration-none text-dark">
                        <i class="bi bi-telephone-fill"></i> +<?php echo $contact_r['pn1'] ?>
                    </a>
                    <br>
                    <?php
                    if ($contact_r['pn2'] != '') {
                        echo <<<data
                        <a href="tel: +$contact_r[pn2]" class="d-inline-block text-decoration-none text-dark">
                            <i class="bi bi-telephone-fill"></i> +$contact_r[pn2]
                        </a>
                    data;
                    }
                    ?>
                    <h5 class="mt-4">Email</h5>
                    <a href="mailto:<?php echo $contact_r['email'] ?>" class="d-inline-block text-decoration-none text-dark">
                        <i class="bi bi-envelope-fill me-1"></i> <?php echo $contact_r['email'] ?>
                    </a>
                    <h5 class="mt-4">Follow us</h5>
                    <a href="<?php echo $contact_r['fb'] ?>" class="d-inline-block text-dark fs-4 me-2">
                        <i class="bi bi-facebook me-1"></i>
                    </a>
                    <a href="<?php echo $contact_r['ig'] ?>" class="d-inline-block text-dark fs-4">
                        <i class="bi bi-instagram me-1"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mb-5 px-4">
                <div class="bg-white shadow p-4">
                    <form method="POST">
                        <h5>Send a message</h5>
                        <div class="mt-3">
                            <label class="form-label fw-medium">Name</label>
                            <input name="name" type="text" class="form-control shadow-none" required>
                        </div>
                        <div class="mt-3">
                            <label class="form-label fw-medium">Email</label>
                            <input name="email" type="email" class="form-control shadow-none" required>
                        </div>
                        <div class="mt-3">
                            <label class="form-label fw-medium">Subject</label>
                            <input name="subject" type="text" class="form-control shadow-none" required>
                        </div>
                        <div class="mt-3">
                            <label class="form-label fw-medium">Message</label>
                            <textarea name="message" class="form-control shadow-none" rows="6" style="resize: none;" required></textarea>
                        </div>
                        <button type="submit" name="send" class="btn custom-bg text-light shadow-none mt-3 px-3">SEND</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php 
        if(isset($_POST['send'])){
            $frm_data = filteration($_POST);

            $q = "INSERT INTO `user_queries`(`name`, `email`, `subject`, `message`) VALUES (?,?,?,?)";
            $values =[$frm_data['name'],$frm_data['email'],$frm_data['subject'],$frm_data['message']];

            $res = insert($q,$values,'ssss');
            if($res==1){
                alert('success','Mail sent!');
            }
            else{
                alert('error','Server Down! Try again later.');
            }
            
        }
    ?>

    <?php require('inc/modal-login.php') ?>
    <?php require('inc/modal-register.php') ?>
    <?php require('inc/footer.php') ?>

</body>
<?php require('inc/script.php') ?>

</html>

