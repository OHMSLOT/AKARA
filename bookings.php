<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - My Booking</title>
    <?php require('inc/links.php'); ?>
    <style>
        .receipt-container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: #f8f9fa;
        }

        .receipt-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .receipt-header h3 {
            margin: 0;
        }

        .receipt-body {
            margin-bottom: 20px;
        }

        .receipt-body .row {
            margin-bottom: 10px;
        }

        .receipt-footer {
            text-align: center;
        }
    </style>
</head>

<body>
    <?php require('inc/header.php'); ?>
    <?php
    if (!isset($_SESSION['login']) || $_SESSION['login'] != true) {
        redirect('index.php');
    }

    $user_id = $_SESSION['uId'];
    $sql = "SELECT bo.order_number, bo.status, bd.room_name, bd.checkin, bd.checkout, bd.nights, bd.total_price, bd.slip_image 
            FROM booking_order bo 
            JOIN booking_detail bd ON bo.order_id = bd.order_id 
            WHERE bo.user_id = ? 
            ORDER BY bd.checkin DESC";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('i', $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    ?>

    <div class="container">
        <div class="row">
            <div class="col-12 my-5 mb-4 px-4">
                <h1 class="fw-semibold">MY BOOKING</h1>
                <div style="font-size: 14px;">
                    <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
                    <span class="text-secondary"> > </span>
                    <span class="text-secondary">MY BOOKING</span>
                </div>
            </div>

            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <div class="col-lg-3 col-md-6 col-sm-6 mb-4">
                        <div class="card shadow-sm border-1">
                            <div class="card-body">
                                <h4 class="card-title fw-bold"><?php echo htmlspecialchars($row['room_name']); ?></h4>
                                <hr>
                                <p class="card-text m-0">
                                <div class="mb-2">
                                    <strong>Check-in:</strong> <?php echo $row['checkin']; ?><br>
                                    <strong>Check-out:</strong> <?php echo $row['checkout']; ?><br>
                                    <strong>Nights:</strong> <?php echo $row['nights']; ?><br>
                                </div>
                                <div class="mb-2">
                                    <strong>Total Price:</strong> ฿<?php echo number_format($row['total_price'], 2); ?>
                                </div>
                                <strong>Status:</strong>
                                <span class="badge <?php echo ($row['status'] == 'pending') ? 'bg-warning' : (($row['status'] == 'confirmed') ? 'bg-success' : 'bg-danger'); ?>">
                                    <?php echo ucfirst($row['status']); ?>
                                </span>
                                </p>
                                <button class="btn btn-sm btn-secondary" onclick="printReceipt('<?php echo $row['order_number']; ?>', '<?php echo $row['room_name']; ?>', '<?php echo $row['checkin']; ?>', '<?php echo $row['checkout']; ?>', '<?php echo $row['nights']; ?>', '<?php echo number_format($row['total_price'], 2); ?>')">
                                    <i class="bi bi-printer me-1"></i>Print
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        No booking records found.
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div id="printableReceipt" class="d-none">
        <div class="receipt-container">
            <div class="receipt-header">
                <h3>Booking Receipt</h3>
                <p>Thank you for booking with us!</p>
            </div>
            <div class="receipt-body">
                <div class="row">
                    <div class="col-6"><strong>Order Number:</strong></div>
                    <div class="col-6" id="receiptOrderNumber"></div>
                </div>
                <div class="row">
                    <div class="col-6"><strong>Room Name:</strong></div>
                    <div class="col-6" id="receiptRoomName"></div>
                </div>
                <div class="row">
                    <div class="col-6"><strong>Check-in:</strong></div>
                    <div class="col-6" id="receiptCheckin"></div>
                </div>
                <div class="row">
                    <div class="col-6"><strong>Check-out:</strong></div>
                    <div class="col-6" id="receiptCheckout"></div>
                </div>
                <div class="row">
                    <div class="col-6"><strong>Nights:</strong></div>
                    <div class="col-6" id="receiptNights"></div>
                </div>
                <div class="row">
                    <div class="col-6"><strong>Total Price:</strong></div>
                    <div class="col-6">฿<span id="receiptTotalPrice"></span></div>
                </div>
            </div>
            <div class="receipt-footer">
                <p>We hope you have a wonderful stay!</p>
                <p>Contact us at support@example.com for any questions.</p>
            </div>
        </div>
    </div>

    <?php require('inc/footer.php'); ?>
</body>
<script>
    function printReceipt(orderNumber, roomName, checkin, checkout, nights, totalPrice) {
        // เติมข้อมูลในใบเสร็จ
        document.getElementById('receiptOrderNumber').innerText = orderNumber;
        document.getElementById('receiptRoomName').innerText = roomName;
        document.getElementById('receiptCheckin').innerText = checkin;
        document.getElementById('receiptCheckout').innerText = checkout;
        document.getElementById('receiptNights').innerText = nights;
        document.getElementById('receiptTotalPrice').innerText = totalPrice;

        // เปิด print preview
        var printContents = document.getElementById('printableReceipt').innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        window.location.reload(); // รีเฟรชหน้าเพื่อให้กลับมาแสดงข้อมูลเดิม
    }
</script>

</html>