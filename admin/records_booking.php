<?php
require('inc/essentials.php');
adminLogin();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Booking Records</title>
    <?php include 'inc/links.php'; ?>
    <style>
        .printable {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            font-family: 'Arial', sans-serif;
            background: #fff;
            color: #333;
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

            .printable,
            .printable * {
                visibility: visible;
            }

            .printable {
                position: absolute;
                left: 0;
                right: 0;
                top: 0;
            }
        }
    </style>
</head>

<body class="bg-light">
    <?php include 'inc/header.php'; ?>
    <div id="layoutSidenav">
        <?php include_once "inc/sidenav.php"; ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid" id="main-content">
                    <div class="row">
                        <div class="col-lg-12 ms-auto p-4 overflow-hidden">
                            <h3 class="mb-4">Booking Records</h3>

                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-body">
                                    <div class="text-end mb-3">
                                        <input type="text" id="searchInput" class="form-control w-25 ms-auto" placeholder="Search bookings...">
                                    </div>
                                    <div class="table-responsive-md" style="height: 580px; overflow-y: scroll;">
                                        <table class="table table-hover border">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th scope="col">Order Number</th>
                                                    <th scope="col">Customer Name</th>
                                                    <th scope="col">Room Name</th>
                                                    <th scope="col">Details</th>
                                                    <th scope="col">Total Price (THB)</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="booking-records-data">
                                            </tbody>
                                        </table>
                                    </div>
                                    <nav id="pagination" class="mt-3"></nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <?php include 'inc/script.php'; ?>
    <script>
        let searchTimeout;

        function getBookingRecords(query = '', page = 1) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/record_booking.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function() {
                const response = JSON.parse(this.responseText);
                document.getElementById("booking-records-data").innerHTML = response.data;
                document.getElementById("pagination").innerHTML = response.pagination;
            };

            xhr.send(`query=${query}&page=${page}`);
        }



        document.getElementById('searchInput').addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                getBookingRecords(this.value);
            }, 500);
        });

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
            document.body.appendChild(printDiv);

            setTimeout(() => {
                window.print();
                document.body.removeChild(printDiv);
            }, 500);
        }

        window.onload = function() {
            getBookingRecords();
        };
    </script>
</body>

</html>