<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $gallery_data['name']; ?> - Gallery</title> <!-- ชื่อแกลเลอรี -->
    <?php require('inc/links.php'); ?>
    <style>
        .image {
            display: block;
            width: 100%;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <?php require('inc/header.php'); ?>

    <?php
        // ตรวจสอบว่ามีการส่ง 'id' มาหรือไม่
        if (!isset($_GET['id'])) {
            echo '<p class="text-center">ไม่พบแกลเลอรีที่ต้องการแสดง</p>';
            exit();
        }

        // กรองข้อมูลที่ส่งมาจาก GET ด้วยฟังก์ชัน filteration
        $data = filteration($_GET);

        // ดึงข้อมูลจาก table gallery โดยใช้เฉพาะ id
        $gallery_res = select("SELECT * FROM `gallery` WHERE `id`=?", [$data['id']], 'i');

        // ถ้าไม่พบข้อมูลหรือข้อมูลไม่ถูกต้อง ให้แสดงข้อความ
        if (mysqli_num_rows($gallery_res) == 0) {
            echo '<p class="text-center">ไม่พบแกลเลอรีที่ต้องการแสดง</p>';
            exit();
        }

        // ดึงข้อมูลของแกลเลอรีที่เลือกมาใช้งาน
        $gallery_data = mysqli_fetch_assoc($gallery_res);

        // Query to fetch images with the provided gallery_id
        $query = "SELECT * FROM gallery_images WHERE gallery_id = ?";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "i", $data['id']); // ใช้ id ที่ได้รับมาจาก GET
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        // เตรียมข้อมูลรูปภาพทั้งหมด
        $image_paths = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $image_paths[] = GALLERY_IMG_PATH . $row['image'];
        }
    ?>

    <div class="my-5 px-4">
        <h1 class="fw-semibold c-font text-center"><?php echo $gallery_data['name']; ?></h1> <!-- ชื่อแกลเลอรี -->
        <p class="text-center mt-3">Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
    </div>

    <div class="container">
        <div class="row">
            <?php
            // แสดงรูปภาพในแกลเลอรีและให้คลิกเพื่อเปิดใน Modal พร้อมระบุ slide-to index
            foreach ($image_paths as $index => $image_path) {
                echo '
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card">
                        <img style="margin-bottom: 0; height: 270px" class="card-img image content" src="' . $image_path . '" alt="Image" data-bs-toggle="modal" data-bs-target="#galleryModal" data-bs-slide-to="' . $index . '">
                    </div>
                </div>';
            }
            ?>
        </div>
    </div>

    <!-- Modal with Carousel -->
    <div class="modal fade" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl    modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="galleryModalLabel"><?php echo $gallery_data['name']; ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="carouselGallery" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php
                            $active_class = 'active';
                            foreach ($image_paths as $index => $image_path) {
                                echo '
                                <div class="carousel-item ' . $active_class . '">
                                    <img src="' . $image_path . '" class="d-block w-100" alt="Image">
                                </div>';
                                $active_class = ''; // ใช้ active แค่ครั้งเดียวสำหรับภาพแรก
                            }
                            ?>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselGallery" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselGallery" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require('inc/modal-login.php'); ?>
    <?php require('inc/modal-register.php'); ?>
    <?php require('inc/footer.php'); ?>
</body>
<?php require('inc/script.php'); ?>

<script>
    // JavaScript เพื่อให้ Carousel เปิดที่ภาพที่คลิก
    const galleryModal = document.getElementById('galleryModal');
    const carouselGallery = document.getElementById('carouselGallery');
    galleryModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // ปุ่มที่ถูกคลิก (รูปภาพ)
        const slideTo = button.getAttribute('data-bs-slide-to'); // ดึง index ของรูปภาพที่คลิก
        const carousel = new bootstrap.Carousel(carouselGallery);
        carousel.to(slideTo); // เลื่อนไปยังรูปที่ตรงกับ index ที่คลิก
    });
</script>

</html>
