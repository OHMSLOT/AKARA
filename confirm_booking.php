<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Room details</title>
    <?php require('inc/links.php') ?>
    <style>
        .fs-18 {
            font-size: 18px;
        }

        .fs-14 {
            font-size: 14px;
        }

        .custom-popover {
            border-color: #996600;
            max-width: 220px;
            font-size: 15px;
        }

        .image {
            display: block;
            width: 100%;
            object-fit: cover;
        }

        .custom-bg:disabled {
            background-color: var(--dis-color);
            /* สีพื้นหลังเมื่อปุ่มถูกปิดการใช้งาน */
            color: #fff;
            /* สีตัวอักษรเมื่อปุ่มถูกปิดการใช้งาน */
        }
    </style>
</head>

<body>
    <?php require('inc/header.php') ?>

    <?php
    if (!isset($_GET['id'])) {
        redirect('room.php');
    } else if (!(isset($_SESSION['login']) && $_SESSION['login'] == true)) {
        redirect('room.php');
    }

    $data = filteration($_GET);

    $room_res = select("SELECT * FROM `rooms` WHERE `id`=? AND `status`=? AND `removed`=?", [$data['id'], 1, 0], 'iii');

    if (mysqli_num_rows($room_res) == 0) {
        redirect('room.php');
    }

    $room_data = mysqli_fetch_assoc($room_res);

    $_SESSION['room'] = [
        "id" => $room_data['id'],
        "name" => $room_data['name'],
        "price" => $room_data['price'],
        "payment" => null,
        "availble" => false,
    ];

    ?>

    <div class="container">
        <div class="row">

            <div class="col-12 my-5 mb-4 px-4">
                <h1 class="fw-semibold">CONFIRM BOOKING</h1>
                <div style="font-size: 14px;">
                    <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
                    <span class="text-secondary"> > </span>
                    <a href="room.php" class="text-secondary text-decoration-none">ROOMS</a>
                    <span class="text-secondary"> > </span>
                    <a href="#" class="text-secondary text-decoration-none">CONFIRM</a>
                </div>
            </div>

            <div class="col-lg-8 col-md-12 px-4 ">
                <div id="roomcarousel" class="carousel slide">
                    <div class="carousel-inner">
                        <?php
                        $room_img = ROOMS_IMG_PATH . "thumbnail.jpg";
                        $img_q = mysqli_query($con, "SELECT * FROM `room_images` WHERE `room_id`='$room_data[id]'");

                        if (mysqli_num_rows($img_q) > 0) {
                            $active_class = 'active';
                            while ($img_res = mysqli_fetch_assoc($img_q)) {
                                echo "
                                    <div class='carousel-item $active_class'>
                                        <img src='" . ROOMS_IMG_PATH . $img_res['image'] . "' class='d-block w-100' style='max-height: 515px; object-fit: cover;'>
                                    </div>
                                ";
                                $active_class = '';
                            }
                        } else {
                            echo "<div class='carousel-item active'>
                                <img src='$room_img' class='d-block w-100'>
                            </div>";
                        }
                        ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#roomcarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#roomcarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <form action="checkout_form.php" method="POST" id="bookingForm">
                            <div class="d-flex mb-4">
                                <h2 class='mt-1 me-2'><?php echo $room_data['name'] ?></h2>
                                <div class='d-flex align-items-center'>
                                    <i class="bi bi-star-fill text-warning me-1"></i>
                                    <h6 style="margin-top: 11px;">5</h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Check-in</label>
                                    <input type="date" name="checkin" id="checkin" class="form-control shadow-none" required>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Check-out</label>
                                    <input type="date" name="checkout" id="checkout" class="form-control shadow-none" required>
                                </div>
                                <h6 id="availability-msg" class="text-danger mb-4">Provide check-in & check-out date!</h6>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-2 mb-3">
                                <h4>Pricing per night</h4>
                                <h4 class='mt-1'>฿<?php echo $room_data['price'] ?></h4>
                            </div>
                            <!-- ส่งข้อมูลการจองไปยังหน้า checkout_form.php -->
                            <input type="hidden" name="room_id" value="<?php echo $room_data['id']; ?>">
                            <input type="hidden" name="roomName" value="<?php echo $room_data['name']; ?>">
                            <input type="hidden" name="checkin" id="hiddenCheckin" value="">
                            <input type="hidden" name="checkout" id="hiddenCheckout" value="">
                            <input type="hidden" name="price" value="<?php echo $room_data['price']; ?>">
                            <button type="submit" id="bookNowBtn" class="btn w-100 text-white custom-bg shadow-none mb-2" disabled>Book Now</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-8 mt-5">
                <div class="mb-5">
                    <h5 class="mb-3">Description</h5>
                    <p>
                        <?php echo $room_data['description'] ?>
                    </p>
                </div>
                <?php

                $fac_q = mysqli_query($con, "SELECT f.icon, f.name FROM `facilities` f INNER JOIN `room_facilities` rfac ON f.id = rfac.facilities_id WHERE rfac.room_id = '$room_data[id]'");

                $facilities_data = "";
                while ($fac_row = mysqli_fetch_assoc($fac_q)) {
                    $fac_i = FACILITIES_IMG_PATH . $fac_row['icon'];
                    $facilities_data .= "<span class='badge rounded-pill bg-light text-dark text-wrap me-2' style='font-size: 15px; font-weight: 500;'>
                    <img src='$fac_i' class='me-1' style='width: 24px;'> $fac_row[name]
                    </span>";
                }

                echo <<<facilities
                        <div class="mb-5">
                            <h5 class='mb-3'>Facilities</h5>
                            $facilities_data   
                        </div>
                    facilities;

                ?>
            </div>

            <div class="col-12 mt-5 px-4">
                <h5 class="mb-3">Ratings</h5>
                <div>
                    <div class="d-flex align-items-center justify-content-between mb-2">
                        <div class="d-flex">
                            <img src="src/users/IMG89899.jpeg" style="width: 25px;">
                            <h6 class="m-0 ms-2">Random user1</h6>
                        </div>
                        <div class="rating d-flex align-items-center">
                            <h6 class="m-0 me-2">5.0</h6>
                            <i class="bi bi-star-fill text-warning me-1"></i>
                            <i class="bi bi-star-fill text-warning me-1"></i>
                            <i class="bi bi-star-fill text-warning me-1"></i>
                            <i class="bi bi-star-fill text-warning me-1"></i>
                            <i class="bi bi-star-fill text-warning me-1"></i>
                        </div>
                    </div>
                    <p>
                        Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eaque, quam aperiam. Nulla, aut dolor dolores unde maiores neque quos ipsum?
                    </p>
                </div>
            </div>

        </div>
    </div>

    <?php require('inc/footer.php') ?>
</body>
<script>
    document.getElementById('checkin').addEventListener('change', checkAvailability);
    document.getElementById('checkout').addEventListener('change', checkAvailability);

    function checkAvailability() {
        var checkin = document.getElementById('checkin').value;
        var checkout = document.getElementById('checkout').value;
        var roomId = "<?php echo $room_data['id']; ?>"; // ใช้ room_id แทน room_name
        var bookNowBtn = document.getElementById('bookNowBtn');
        var availabilityMsg = document.getElementById('availability-msg');

        // Update the hidden inputs with the selected dates
        document.getElementById('hiddenCheckin').value = checkin;
        document.getElementById('hiddenCheckout').value = checkout;

        if (checkin && checkout) {
            // ส่ง request AJAX เพื่อตรวจสอบห้องว่าง
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/check_availability.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onload = function() {
                if (this.responseText == 'available') {
                    availabilityMsg.innerHTML = 'Room is available!';
                    availabilityMsg.classList.remove('text-danger');
                    availabilityMsg.classList.add('text-success');
                    bookNowBtn.disabled = false; // Enable the button
                } else {
                    availabilityMsg.innerHTML = 'Room is not available for the selected dates!';
                    availabilityMsg.classList.remove('text-success');
                    availabilityMsg.classList.add('text-danger');
                    bookNowBtn.disabled = true; // Disable the button
                }
            };
            xhr.send("checkin=" + checkin + "&checkout=" + checkout + "&room_id=" + roomId); // เปลี่ยนเป็น room_id
        } else {
            availabilityMsg.innerHTML = 'Please select both check-in and check-out dates!';
            availabilityMsg.classList.add('text-danger');
            bookNowBtn.disabled = true;
        }
    }


    // function openBookingModal() {
    //     // ดึงข้อมูลจาก input ของวันที่
    //     var roomId = 1; // สมมติว่ามี room_id เก็บไว้ หรือดึงจาก DOM
    //     var checkin = document.getElementById('checkin').value;
    //     var checkout = document.getElementById('checkout').value;

    //     // ตรวจสอบว่ามีการเลือกวันที่แล้วหรือไม่
    //     if (!checkin || !checkout) {
    //         alert("Please select both check-in and check-out dates.");
    //         return;
    //     }

    //     // ส่ง request AJAX เพื่อตรวจสอบราคาจากฐานข้อมูล
    //     var xhr = new XMLHttpRequest();
    //     xhr.open("POST", "ajax/get_room_price.php", true);
    //     xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    //     xhr.onload = function() {
    //         if (this.status === 200) {
    //             // ดึงค่าราคาจากฐานข้อมูล
    //             var response = JSON.parse(this.responseText);
    //             if (response.success) {
    //                 var pricePerNight = response.price_per_night;

    //                 // คำนวณจำนวนคืนที่พัก
    //                 var nights = calculateNights(checkin, checkout);

    //                 // คำนวณราคาทั้งหมด
    //                 var totalPrice = nights * pricePerNight;

    //                 // แสดงข้อมูลใน Modal
    //                 document.getElementById('modalRoomName').innerText = response.room_name;
    //                 document.getElementById('modalCheckin').innerText = checkin;
    //                 document.getElementById('modalCheckout').innerText = checkout;
    //                 document.getElementById('modalNights').innerText = nights;
    //                 document.getElementById('modalTotalPrice').innerText = totalPrice;

    //                 // เปิด Modal
    //                 var bookingModal = new bootstrap.Modal(document.getElementById('bookingModal'));
    //                 bookingModal.show();
    //             } else {
    //                 alert("Error: " + response.message);
    //             }
    //         }
    //     };

    //     xhr.send("room_id=" + roomId);
    // }

    // ฟังก์ชันสำหรับคำนวณจำนวนคืนที่พัก
    function calculateNights(checkin, checkout) {
        const checkinDate = new Date(checkin);
        const checkoutDate = new Date(checkout);

        // คำนวณจำนวนคืน
        const timeDifference = checkoutDate.getTime() - checkinDate.getTime();
        const daysDifference = timeDifference / (1000 * 3600 * 24); // แปลงจาก millisecond เป็นวัน
        return daysDifference;
    }
</script>


</html>