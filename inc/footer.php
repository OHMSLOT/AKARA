<?php
$contact_q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
$values = [1];
$contact_r = mysqli_fetch_assoc(select($contact_q, $values, 'i'));
// print_r($contact_r);
?>

<div class="container-fluid custom_bg mt-5">
    <div class="row justify-content-between">
        <div class="col-lg-6 p-4">
            <h1 class="fw-medium c-font">THAI AKARA</h1>
            <p>
                133 Ratchapakinai Road, Sriphum Sub-district,
                Muang Chiang Mai District, Chiang Mai 50200, Thailand
            </p>
        </div>
        <div class="col-lg-2 p-4">
            <h5 class="mb-3">Links</h5>
            <a href="index.php" class="d-inline-block mb-2 text-dark text-decoration-none">Home</a> <br>
            <a href="room-type.php" class="d-inline-block mb-2 text-dark text-decoration-none">Room Type</a> <br>
            <a href="facilities.php" class="d-inline-block mb-2 text-dark text-decoration-none">Facilities</a> <br>
            <a href="gallery.php" class="d-inline-block mb-2 text-dark text-decoration-none">Gallery</a> <br>
            <a href="contact.php" class="d-inline-block mb-2 text-dark text-decoration-none">Contact</a>
        </div>
        <div class="col-lg-2 py-4 ps-4">
            <h5>Call us</h5>
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
        </div>
        <div class="col-lg-2 p-4">
            <h5>Follow us</h5>
            <a href="<?php echo $contact_r['fb'] ?>" class="d-inline-block mb-2 text-dark text-decoration-none">
                <i class="bi bi-facebook me-1"></i> Facebook
            </a>
            <br>
            <a href="<?php echo $contact_r['ig'] ?>" class="d-inline-block text-dark text-decoration-none">
                <i class="bi bi-instagram me-1"></i> Instagram
            </a>
        </div>
    </div>
</div>

<?php include 'inc/script.php'; ?>

<script>

    function alert(type,msg,position='body')
    {
        let bs_class = (type == 'success') ? 'alert-success' : 'alert-danger';
        let element = document.createElement('div');
        element.innerHTML = `
            <div class="alert ${bs_class} alert-dismissible fade show" role="alert">
                <strong class="me-3">${msg}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;

        if(position=='body'){
            document.body.append(element);
            element.classList.add('custom-alert');
        }else{
            document.getElementById(position).appendChild(element);
        }
        setTimeout(remAlert, 2000);
    }

    function remAlert(){
        document.getElementsByClassName('alert')[0].remove();
    }

    function setActive() {
        let navbar = document.getElementById('nav-bar-menu');
        let a_tags = navbar.getElementsByTagName('a');

        for (i = 0; i < a_tags.length; i++) {
            let file = a_tags[i].href.split('/').pop();
            let file_name = file.split('.')[0];

            if (document.location.href.indexOf(file_name) >= 0) {
                a_tags[i].classList.add('active');
            }
        }
    }

    let register_form = document.getElementById("register_form");

    register_form.addEventListener("submit", function(e) {
        e.preventDefault();
        
        let data = new FormData();
        data.append("picture", register_form.elements["picture"].files[0]);
        data.append("name", register_form.elements["name"].value);
        data.append("email", register_form.elements["email"].value);
        data.append("phone", register_form.elements["phone"].value);
        data.append("address", register_form.elements["address"].value);
        data.append("pincode", register_form.elements["pincode"].value);
        data.append("dob", register_form.elements["dob"].value);
        data.append("password", register_form.elements["password"].value);
        data.append("confirm_password", register_form.elements["confirm_password"].value);
        data.append("register", ""); // flag ให้ PHP ทราบว่าเป็นการลงทะเบียน

        var myModal = document.getElementById("registerModal");
        var modal = bootstrap.Modal.getInstance(myModal);
        modal.hide();

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/register.php", true);

        xhr.onload = function() {
            if (this.responseText == "pass_mismatch") {
                alert("error", "Password Mismatch");
            } else if (this.responseText == "email_already") {
                alert("error", "Email is already registered");
            } else if (this.responseText == "phone_already") {
                alert("error", "Phone number is already registered");
            } else if (this.responseText == "inv_img") {
                alert("error", "Only JPG and PNG images are allowed!");
            } else if (this.responseText == "upd_failed") {
                alert("error", "Image upload failed");
            } else if (this.responseText == "insert_failed") {
                alert("error", "Register failded");
            } else {
                alert("success", "User registered successfully!");
                register_form.reset(); // รีเซ็ตฟอร์มเมื่อการลงทะเบียนสำเร็จ
            }
        };
        xhr.send(data);
    });

    setActive();
</script>