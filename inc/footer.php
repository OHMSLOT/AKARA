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
        <div class="col-lg-2 lg-py-4 md-p-4 p-4">
            <h5>Call us</h5>
            <a href="tel: +<?php echo $contact_r['pn1'] ?>" class="d-inline-block mb-2 text-decoration-none text-dark">
                <i class="bi bi-telephone-fill"></i> +<?php echo $contact_r['pn1'] ?>
            </a>
            <br>
            <?php 
                if($contact_r['pn2']!=''){
                    echo<<<data
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

<?php include 'inc/script.php';?>

<script>
    function setActive(){
        let navbar = document.getElementById('nav-bar-menu');
        let a_tags = navbar.getElementsByTagName('a');

        for(i=0; i<a_tags.length; i++){
            let file = a_tags[i].href.split('/').pop();
            let file_name = file.split('.')[0];

            if(document.location.href.indexOf(file_name)>=0){
                a_tags[i].classList.add('active');
            }
        }   
    }
    setActive();
</script>
