<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <?php require('inc/links.php') ?>
</head>

<body>
    <?php require('inc/header.php') ?>
    <div class="container">
        <h1 class="fw-semibold text-center my-5">CHECK-OUT</h1>

        <!-- ส่วนฟอร์มข้อมูลลูกค้า -->
        <div class="row g-5">
            <div class="col-lg-8">
                <h3 class="summary-title">Customer Information</h3>
                <form id="checkoutForm" action="confirm_payment.php" method="POST">
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label for="name" class="form-label">First name</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" required>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="name" class="form-label">Last name</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" required>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phone" name="phone" required>
                        </div>
                    </div>

                    <!-- ข้อมูลการจองที่ส่งมาจากหน้า confirm_booking.php -->
                    <?php
                    $roomName = $_POST['roomName'];
                    $checkin = $_POST['checkin'];
                    $checkout = $_POST['checkout'];
                    $price = $_POST['price'];

                    // คำนวณจำนวนคืนที่พัก
                    $checkinDate = new DateTime($checkin);
                    $checkoutDate = new DateTime($checkout);
                    $nights = $checkinDate->diff($checkoutDate)->days;
                    $totalPrice = $nights * $price;
                    ?>

                    <!-- ข้อมูลที่ซ่อนอยู่เพื่อส่งไปยัง confirm_payment.php -->
                    <input type="hidden" id="roomName" name="roomName" value="<?php echo $roomName; ?>">
                    <input type="hidden" id="checkin" name="checkin" value="<?php echo $checkin; ?>">
                    <input type="hidden" id="checkout" name="checkout" value="<?php echo $checkout; ?>">
                    <input type="hidden" id="nights" name="nights" value="<?php echo $nights; ?>">
                    <input type="hidden" id="totalPrice" name="totalPrice" value="<?php echo $totalPrice; ?>">

                    <button type="submit" class="btn btn-primary w-100">Confirm Booking</button>
                </form>
            </div>

            <!-- ส่วนข้อมูลสรุปการจอง -->
            <div class="col-lg-4">
                <h3 class="mb-3">Booking Summary</h3>
                <div class="card">
                    <img src="src/LINE_ALBUM_Deluxe room  Thai Akara_240716_1.jpg" class="card-img-top" style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $roomName; ?></h5>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <div>
                                <span style="font-size: 14px; color:gray;">Check-in</span>
                                <h6><?php echo $checkin; ?></h6>
                            </div>
                            <div class="d-flex my-auto">
                                <i class="bi bi-chevron-right"></i>
                            </div>
                            <div>
                                <span style="font-size: 14px; color:gray;">Check-out</span>
                                <h6><?php echo $checkout; ?></h6>
                            </div>
                            <div class="text-center">
                                <span style="font-size: 14px; color:gray;">Total Nights</span>
                                <h6><?php echo $nights; ?></h6>
                            </div>
                        </div>
                        <hr>
                        <div class="d-flex justify-content-between">
                            <h6>Total:</h6>
                            <strong>฿<?php echo $totalPrice; ?></strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require('inc/footer.php') ?>
</body>

</html>
