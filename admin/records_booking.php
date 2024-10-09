<?php
require('inc/essentials.php');
require('inc/db_config.php');
adminLogin();

// ดึงข้อมูลการจองทั้งหมดจากฐานข้อมูล
$sql = "SELECT bo.order_id, bo.order_number, bo.total_amount, bo.status, bd.firstname, bd.lastname, bd.room_name, bd.checkin, bd.checkout, bd.nights, bd.total_price, bd.created_at
        FROM booking_order bo
        JOIN booking_detail bd ON bo.order_id = bd.order_id";
$result = $con->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Booking Records</title>
    <?php include 'inc/links.php'; ?>
    <style>
        .printable {
            max-width: 600px;
            margin:  auto;
            padding: 20px;
            font-family: 'Arial', sans-serif;
            background: #fff;
            color: #333;
            /* box-shadow: 0 0 15px rgba(0, 0, 0, 0.2); */
            border-radius: 10px;
        }

        .receipt-header h1 {
            font-size: 24px;
            margin-bottom: 5px;
            text-align: center;
            color: #0066cc;
        }

        .receipt-body,
        .receipt-footer {
            margin-top: 20px;
        }

        .receipt-body h2,
        .receipt-footer h2 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #444;
        }

        .receipt-body p,
        .receipt-footer p {
            margin: 0;
            line-height: 1.6;
            font-size: 14px;
        }

        .receipt-footer {
            text-align: center;
        }

        .receipt-footer p {
            font-size: 12px;
            margin-top: 10px;
        }

        hr {
            border: 0;
            border-top: 2px solid #0066cc;
            margin: 20px 0;
        }

        @media print {
        body * {
            visibility: hidden;
        }

        .printable, .printable * {
            visibility: visible;
        }

        .printable {
            position: absolute;
            left: 0;
            right: 0;
            top: 0; /* เพิ่มระยะห่างด้านบน */
            margin: auto;
        }
    }
    </style>

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
                            <h1 class="mb-4">Booking Records</h1>

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
                                                                <?php
                                                                $dateTime = strtotime($row['created_at']);
                                                                echo '<strong>Booking date:</strong> ' . date('Y-m-d', $dateTime) . '<br>';
                                                                ?>
                                                                <strong>Check-in:</strong> <?php echo $row['checkin']; ?><br>
                                                                <strong>Check-out:</strong> <?php echo $row['checkout']; ?><br>
                                                            </td>
                                                            <td><?php echo number_format($row['total_price'], 2); ?></td>
                                                            <td>
                                                                <span class="badge 
                                                                <?php echo ($row['status'] == 'pending') ? 'bg-warning' : (($row['status'] == 'confirmed') ? 'bg-success' : 'bg-danger'); ?>">
                                                                    <?php echo ucfirst($row['status']); ?>
                                                                </span>
                                                            </td>
                                                            <td>
                                                                <button class="btn btn-sm btn-primary" onclick="printReceipt(
                                                                        '<?php echo $row['order_number']; ?>',
                                                                        '<?php echo $row['firstname'] . ' ' . $row['lastname']; ?>',
                                                                        '<?php echo $row['room_name']; ?>',
                                                                        '<?php echo $row['checkin']; ?>',
                                                                        '<?php echo $row['checkout']; ?>',
                                                                        '<?php echo $row['nights']; ?>',
                                                                        '<?php echo number_format($row['total_price'], 2); ?>',
                                                                        '<?php echo number_format($row['total_amount'], 2); ?>'
                                                                    )">
                                                                    Print
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    <?php endwhile; ?>
                                                <?php else : ?>
                                                    <tr>
                                                        <td colspan="9" class="text-center">No booking records found</td>
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


    <?php include 'inc/script.php'; ?>
</body>
<script>
    function printReceipt(orderNumber, customerName, roomName, checkin, checkout, nights, totalPrice, totalAmount) {
        var printContent = `
        <div class="printable">
            <div class="receipt-header">
                <h1>Hotel Receipt</h1>
                <p><strong>Order Number:</strong> ${orderNumber}</p>
                <p><strong>Date:</strong> ${new Date().toLocaleDateString()}</p>
            </div>
            <hr>
            <div class="receipt-body">
                <h2>Customer Information</h2>
                <p><strong>Name:</strong> ${customerName}</p>
                <p><strong>Room:</strong> ${roomName}</p>
                <p><strong>Check-in:</strong> ${checkin}</p>
                <p><strong>Check-out:</strong> ${checkout}</p>
                <p><strong>Nights:</strong> ${nights}</p>
            </div>
            <hr>
            <div class="receipt-footer">
                <h2>Payment Summary</h2>
                <p><strong>Total Price:</strong> ฿${totalPrice}</p>
                <p><strong>Total Amount:</strong> ฿${totalAmount}</p>
                <p>Thank you for choosing our hotel! We hope you have a pleasant stay.</p>
            </div>
            <div class="receipt-footer text-center">
                <p>Safe travels and we look forward to serving you again.</p>
                <p><em>Hotel XYZ, 123 Main Street, City, Country</em></p>
            </div>
        </div>
    `;

        var printDiv = document.createElement('div');
        printDiv.innerHTML = printContent;
        printDiv.className = 'printable';
        document.body.appendChild(printDiv);

        setTimeout(() => {
            window.print();
            document.body.removeChild(printDiv);
        }, 500);
    }
</script>

</html>