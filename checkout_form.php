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
        <h1 class="fw-semibold text-center my-5">PAYMENT</h1>

        <!-- ส่วนฟอร์มข้อมูลลูกค้า -->
        <div class="row g-5">
            <div class="col-lg-8">
                <h3 class="summary-title">Customer Information</h3>
                <form id="mainCheckoutForm" action="confirm_payment.php" method="POST" enctype="multipart/form-data">
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
                    <input type="hidden" name="room_id" value="<?php echo $_POST['room_id']; ?>">
                    <input type="hidden" id="roomName" name="roomName" value="<?php echo $roomName; ?>">
                    <input type="hidden" id="checkin" name="checkin" value="<?php echo $checkin; ?>">
                    <input type="hidden" id="checkout" name="checkout" value="<?php echo $checkout; ?>">
                    <input type="hidden" id="nights" name="nights" value="<?php echo $nights; ?>">
                    <input type="hidden" id="totalPrice" name="totalPrice" value="<?php echo $totalPrice; ?>">

                    <!-- Payment Method Selection -->
                    <h3 class="my-4">Payment Method</h3>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="paymentMethod" id="paymentQR" value="qr" required>
                        <label class="form-check-label" for="paymentQR">
                            QR Code Payment
                        </label>
                    </div>
                    <button type="submit" class="btn custom-bg text-white w-100 mt-3" id="confirmBookingBtn">Confirm Booking</button>
                </form>
            </div>

            <!-- QR Code Modal -->
            <div class="modal fade" id="qrCodeModal" tabindex="-1" aria-labelledby="qrCodeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="qrCodeModalLabel">Scan the QR Code to Pay</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form id="modalReceiptForm" enctype="multipart/form-data">
                            <div class="modal-body text-center">
                                <img src="src/promtpay.jpg" alt="QR Code" style="width: 200px; height: 200px;">
                                <p class="mt-3">Please scan the QR code using your mobile banking app to complete the payment.</p>

                                <!-- File upload input for payment receipt -->
                                <div class="mt-4">
                                    <label for="paymentReceipt" class="form-label">Upload Payment Receipt:</label>
                                    <input type="file" class="form-control" id="paymentReceipt" name="paymentReceipt" accept=".jpg, .jpeg, .png, .pdf" required>
                                    <small class="text-muted">Accepted formats: JPG, PNG, PDF</small>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn custom-bg shadow-none" id="submitReceiptBtn">Submit Payment</button>
                            </div>
                        </form>
                    </div>
                </div>
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
<script>
    const confirmBookingBtn = document.getElementById('confirmBookingBtn');
    const mainCheckoutForm = document.getElementById('mainCheckoutForm');
    const paymentQR = document.getElementById('paymentQR');
    const qrCodeModal = new bootstrap.Modal(document.getElementById('qrCodeModal'));
    const paymentReceipt = document.getElementById('paymentReceipt');
    const submitReceiptBtn = document.getElementById('submitReceiptBtn');

    mainCheckoutForm.addEventListener('submit', function(event) {
        event.preventDefault();

        if (paymentQR.checked) {
            qrCodeModal.show();
        } else {
            mainCheckoutForm.submit();
        }
    });

    submitReceiptBtn.addEventListener('click', function() {
        if (paymentReceipt.files.length === 0) {
            alert("Please upload a payment receipt before proceeding.");
            return;
        }

        // คัดลอกค่าจากฟอร์มหลักไปยังฟอร์มใน Modal ก่อนส่งข้อมูล
        const formData = new FormData(mainCheckoutForm);
        formData.append('paymentReceipt', paymentReceipt.files[0]);

        fetch('confirm_payment.php', {
                method: 'POST',
                body: formData,
            })
            .then(response => response.text())
            .then(data => {
                alert('Payment receipt submitted successfully.');
                qrCodeModal.hide();
                // Optional: เปลี่ยนเส้นทางหลังจากสำเร็จ
                window.location.href = 'booking_success.php';
            })
            .catch(error => {
                console.error('Error:', error);
                alert('There was an error submitting your payment receipt. Please try again.');
            });
    });
</script>

</html>
