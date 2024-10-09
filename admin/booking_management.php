<?php
require('inc/essentials.php');
require('inc/db_config.php');
adminLogin();

// ดึงข้อมูลการจองจากตาราง booking_order และ booking_detail ที่สถานะเป็น pending
$sql = "SELECT bo.order_id, bo.order_number, bo.total_amount, bo.status, bd.firstname, bd.lastname, bd.room_name, bd.checkin, bd.checkout, bd.nights, bd.total_price, bd.slip_image
        FROM booking_order bo
        JOIN booking_detail bd ON bo.order_id = bd.order_id
        WHERE bo.status = 'pending'";
$result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Booking Management</title>
    <?php include 'inc/links.php'; ?>
</head>

<body>
    <?php include 'inc/header.php'; ?>
    <div id="layoutSidenav">
        <!-- side navbar -->
        <?php include_once "inc/sidenav.php"; ?>
        <!-- main content -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid" id="main-content">
                    <div class="row">
                        <div class="col-lg-12 ms-auto p-4 overflow-hidden">
                            <h1 class="mb-4">Manage Bookings</h1>

                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-body">

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-hover">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>Order Number</th>
                                                    <th>Customer Name</th>
                                                    <th>Room Name</th>
                                                    <th>Bookings_details</th>
                                                    <th>Total Price (THB)</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if ($result->num_rows > 0) : ?>
                                                    <?php while ($row = $result->fetch_assoc()) : ?>
                                                        <tr>
                                                            <td><span class="badge text-bg-primary"><?php echo $row['order_number']; ?></span></td>
                                                            <td><?php echo $row['firstname'] . ' ' . $row['lastname']; ?></td>
                                                            <td><?php echo $row['room_name']; ?></td>
                                                            <td>
                                                                <strong>Check-in:</strong> <?php echo $row['checkin']; ?><br>
                                                                <strong>Check-out:</strong> <?php echo $row['checkout']; ?><br>
                                                                <strong>Nights:</strong> <?php echo $row['nights']; ?>
                                                            </td>
                                                            <td><?php echo number_format($row['total_price'], 2); ?></td>
                                                            <td>
                                                                <span class="badge 
                                                                    <?php echo ($row['status'] == 'pending') ? 'bg-warning' : (($row['status'] == 'confirmed') ? 'bg-success' : 'bg-danger'); ?>">
                                                                    <?php echo ucfirst($row['status']); ?>
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <!-- ปุ่มเปิด Modal สำหรับแสดง slip_image -->
                                                                <button type="button" class="btn btn-sm btn-secondary text-white" data-bs-toggle="modal" data-bs-target="#slipImageModal" data-slip-image="<?php echo htmlspecialchars($row['slip_image']); ?>">
                                                                    <i class="bi bi-image"></i>
                                                                </button>

                                                                <!-- ปุ่มเปิด Modal -->
                                                                <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#roomModal" data-order-id="<?php echo $row['order_id']; ?>">
                                                                    <i class="bi bi-pencil-square"></i>
                                                                </button>

                                                                <form class="cancel-booking-form" data-order-id="<?php echo $row['order_id']; ?>" style="display:inline-block;">
                                                                    <button type="button" class="btn btn-sm btn-danger cancel-booking-btn">
                                                                        <i class="bi bi-x-lg"></i>
                                                                    </button>
                                                                </form>

                                                            </td>
                                                        </tr>
                                                    <?php endwhile; ?>
                                                <?php else : ?>
                                                    <tr>
                                                        <td colspan="9" class="text-center">No bookings found</td>
                                                    </tr>
                                                <?php endif; ?>
                                            </tbody>


                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Modal สำหรับกรอกเลขห้อง -->
    <div class="modal fade" id="roomModal" tabindex="-1" aria-labelledby="roomModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="roomModalLabel">กรอกเลขห้อง</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="update_booking_status.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="order_id" id="modal_order_id">
                        <input type="hidden" name="status" value="confirmed">
                        <div class="mb-3">
                            <label for="room_number" class="form-label">เลขห้อง</label>
                            <input type="text" class="form-control" id="room_number" name="room_number" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        <button type="submit" class="btn btn-primary">ยืนยันการจอง</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal สำหรับแสดงใบเสร็จ -->
    <div class="modal fade" id="slipImageModal" tabindex="-1" aria-labelledby="slipImageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="slipImageModalLabel">Slip Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="slipImage" src="" alt="Slip Image" class="img-fluid rounded d-none">
                    <p id="noSlipMessage" class="text-muted d-none">No slip uploaded.</p>
                </div>
            </div>
        </div>
    </div>



    <?php include 'inc/script.php'; ?>
</body>
<script>

    document.querySelectorAll('.cancel-booking-btn').forEach(button => {
        button.addEventListener('click', function() {
            const orderId = this.closest('.cancel-booking-form').getAttribute('data-order-id');

            if (confirm('Are you sure you want to cancel this booking?')) {
                fetch('update_booking_status.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded',
                        },
                        body: `order_id=${orderId}&status=cancelled`
                    })
                    .then(response => response.text())
                    .then(data => {
                        alert('Booking has been successfully cancelled.');
                        location.reload(); // Reload the page to update the list
                    })
                    .catch(error => {
                        alert('There was an error cancelling the booking. Please try again.');
                        console.error('Error:', error);
                    });
            }
        });
    });

    // ส่ง order_id ไปยัง Modal เมื่อกดปุ่ม "จัดการห้อง"
    var roomModal = document.getElementById('roomModal');
    roomModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget; // ปุ่มที่ถูกกด
        var orderId = button.getAttribute('data-order-id'); // ดึง order_id จากปุ่ม

        // อัปเดตค่าในฟอร์มที่อยู่ใน Modal
        var modalOrderIdInput = document.getElementById('modal_order_id');
        modalOrderIdInput.value = orderId;
    });

    var slipImageModal = document.getElementById('slipImageModal');
    slipImageModal.addEventListener('show.bs.modal', function(event) {
        var button = event.relatedTarget; // The button that triggered the modal
        var slipImage = button.getAttribute('data-slip-image'); // Get the slip_image from the button

        var modalSlipImage = document.getElementById('slipImage');
        var noSlipMessage = document.getElementById('noSlipMessage');

        // Check if there is a slip image
        if (slipImage && slipImage !== 'null' && slipImage.trim() !== '') {
            modalSlipImage.src = 'http://127.0.0.1/AKARA/src/receipts/' + slipImage; // Ensure the path is correct
            modalSlipImage.classList.remove('d-none'); // Show the image
            noSlipMessage.classList.add('d-none'); // Hide the no-slip message
        } else {
            modalSlipImage.classList.add('d-none'); // Hide the image
            noSlipMessage.classList.remove('d-none'); // Show the no-slip message
        }
    });
</script>

</html>