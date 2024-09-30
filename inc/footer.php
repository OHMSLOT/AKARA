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
    function alert(type, msg, position = 'body') {
        let bs_class = (type == 'success') ? 'alert-success' : 'alert-danger';
        let element = document.createElement('div');
        element.innerHTML = `
            <div class="alert ${bs_class} alert-dismissible fade show" role="alert">
                <strong class="me-3">${msg}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;

        if (position == 'body') {
            document.body.append(element);
            element.classList.add('custom-alert');
        } else {
            document.getElementById(position).appendChild(element);
        }
        setTimeout(remAlert, 2000);
    }

    function remAlert() {
        document.getElementsByClassName('alert')[0].remove();
    }

    function setActive() {
        let navbar = document.getElementById('nav-bar-menu');
        let a_tags = navbar.getElementsByTagName('a');

        // ดึง path ของไฟล์จาก URL ปัจจุบัน
        let currentPage = window.location.pathname.split("/").pop();

        for (let i = 0; i < a_tags.length; i++) {
            let file = a_tags[i].href.split("/").pop(); // ดึงชื่อไฟล์จาก href ของแต่ละลิงก์

            // ตรวจสอบว่าชื่อไฟล์ตรงกับ URL ปัจจุบันหรือไม่
            if (file === currentPage) {
                a_tags[i].classList.add('active'); // ถ้าตรงกัน เพิ่มคลาส active
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

    let login_form = document.getElementById("login_form");

    login_form.addEventListener("submit", function(e) {
        e.preventDefault(); // ป้องกันการรีเฟรชหน้า

        let email = login_form.elements["login_email"].value;
        let password = login_form.elements["login_password"].value;
        let rememberMe = document.getElementById("rememberMe").checked ? 1 : 0; // ตรวจสอบว่า Remember Me ถูกเลือกหรือไม่

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "ajax/login.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        xhr.onload = function() {
            if (this.responseText === "inv_email") {
                alert("error", "Invalid Email");
            } else if (this.responseText === "inv_pass") {
                alert("error", "Incorrect Password!");
            } else if (this.responseText === "login_success") {

                // Remember me option
                if (rememberMe) {
                    localStorage.setItem("email", email);
                } else {
                    localStorage.removeItem("email");
                }

                // Refresh the page or redirect to another page
                window.location.reload(); // รีเฟรชหน้า
            } else {
                alert("Error: " + this.responseText);
            }
        };

        // ส่งข้อมูลไปยังเซิร์ฟเวอร์
        xhr.send(`login_email=${email}&login_password=${password}&remember_me=${rememberMe}&login=1`);
    });

    function checkLoginToBook(status, room_id) {
        if (status) {
            window.location.href = 'confirm_booking.php?id=' + room_id;
        } else {
            alert("error", "Plese Login to booking");
        }
    }

    document.getElementById('sendResetLinkBtn').addEventListener('click', function() {
        var email = document.getElementById('resetEmail').value;

        if (email.trim() === "") {
            alert("Please enter your email address.");
            return;
        }

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'ajax/forgot_password.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        xhr.onload = function() {
            if (this.status == 200) {
                var response = this.responseText.trim(); // รับข้อมูล response จาก PHP
                alert(response);
                if (response.includes('ข้อความได้ถูกส่งไปยังอีเมลของคุณ')) {
                    // ปิด modal หลังจากที่ส่งข้อความสำเร็จ
                    $('#forgotPasswordModal').modal('hide');
                }
            } else {
                alert('An error occurred while processing the request.');
            }
        };

        // ส่งข้อมูล email ไปยัง PHP ผ่าน POST request
        xhr.send('email=' + encodeURIComponent(email));
    });

    window.onload = function() {
        if (localStorage.getItem('login_email') && localStorage.getItem('login_password')) {
            document.getElementById("loginEmail").value = localStorage.getItem('login_email');
            document.getElementById("loginPassword").value = localStorage.getItem('login_password');
            document.getElementById("rememberMe").checked = true;
        }
    }

    setActive();
</script>