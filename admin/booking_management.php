<?php
require('inc/essentials.php');
require('inc/db_config.php');
adminLogin();

// ดึงข้อมูลการจองจากตาราง booking_order และ booking_detail
$sql = "SELECT bo.order_id, bo.order_number, bo.total_amount, bo.status, bd.firstname, bd.lastname, bd.room_name, bd.checkin, bd.checkout, bd.nights, bd.total_price
        FROM booking_order bo
        JOIN booking_detail bd ON bo.order_id = bd.order_id";
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

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
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
                                        <th>Check-in Date</th>
                                        <th>Check-out Date</th>
                                        <th>Total Nights</th>
                                        <th>Total Price (THB)</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($result->num_rows > 0) : ?>
                                        <?php while ($row = $result->fetch_assoc()) : ?>
                                            <tr>
                                                <td><?php echo $row['order_number']; ?></td>
                                                <td><?php echo $row['firstname'] . ' ' . $row['lastname']; ?></td>
                                                <td><?php echo $row['room_name']; ?></td>
                                                <td><?php echo $row['checkin']; ?></td>
                                                <td><?php echo $row['checkout']; ?></td>
                                                <td><?php echo $row['nights']; ?></td>
                                                <td><?php echo number_format($row['total_price'], 2); ?></td>
                                                <td>
                                                    <span class="badge 
                                    <?php echo ($row['status'] == 'pending') ? 'bg-warning' : (($row['status'] == 'confirmed') ? 'bg-success' : 'bg-danger'); ?>">
                                                        <?php echo ucfirst($row['status']); ?>
                                                    </span>
                                                </td>
                                                <td>
                                                    <form action="update_booking_status.php" method="POST" style="display:inline-block;">
                                                        <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                                                        <select name="status" class="form-select form-select-sm" onchange="this.form.submit()">
                                                            <option value="pending" <?php if ($row['status'] == 'pending') echo 'selected'; ?>>Pending</option>
                                                            <option value="confirmed" <?php if ($row['status'] == 'confirmed') echo 'selected'; ?>>Confirmed</option>
                                                            <option value="cancelled" <?php if ($row['status'] == 'cancelled') echo 'selected'; ?>>Cancelled</option>
                                                        </select>
                                                    </form>
                                                    <form action="delete_booking.php" method="POST" style="display:inline-block;">
                                                        <input type="hidden" name="order_id" value="<?php echo $row['order_id']; ?>">
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this booking?');">
                                                            Delete
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

    <?php include 'inc/script.php'; ?>
</body>

</html>