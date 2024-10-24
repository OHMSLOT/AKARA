<?php
require('inc/essentials.php');
adminLogin();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Refund Booking</title>
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
                            <h3 class="mb-4">Refund Bookings</h3>

                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-body">
                                    <div class="text-end mb-3">
                                        <input type="text" id="searchInput" class="form-control w-25 ms-auto" placeholder="Search bookings..." aria-label="Search">
                                    </div>
                                    <div class="table-responsive-md" style="height: 580px;">
                                        <table class="table table-hover border">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th>Order Number</th>
                                                    <th>Customer Name</th>
                                                    <th>Room Name</th>
                                                    <th>Bookings Details</th>
                                                    <th>Total Price (THB)</th>
                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody id="refund-booking-data">
                                                <!-- AJAX loaded content will appear here -->
                                            </tbody>
                                        </table>
                                    </div>
                                    <nav aria-label="Page navigation" id="pagination-container">
                                        <!-- Pagination will be loaded here dynamically -->
                                    </nav>
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

        document.getElementById('searchInput').addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                getRefundBookings(this.value, 1);
            }, 500); 
        });

        function getRefundBookings(query = '', page = 1) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/refund_booking.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function() {
                const response = JSON.parse(this.responseText);
                document.getElementById('refund-booking-data').innerHTML = response.data;
                document.getElementById('pagination-container').innerHTML = response.pagination;
            };

            xhr.send(`query=${query}&page=${page}`);
        }

        function processRefund(orderId) {
            if (confirm('Are you sure you want to refund this booking?')) {
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "ajax/refund_booking.php", true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

                xhr.onload = function() {
                    if (this.responseText.trim() == 'success') {
                        alert('Booking has been refunded successfully.');
                        getRefundBookings(document.getElementById('searchInput').value);
                    } else {
                        alert('Failed to refund the booking. Please try again.');
                    }
                };

                xhr.send(`refund_order=${orderId}`);
            }
        }

        window.onload = function() {
            getRefundBookings();
        };
    </script>
</body>

</html>
