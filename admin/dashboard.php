<?php
require('inc/db_config.php');
require('inc/essentials.php');
adminLogin();

// กำหนดวันที่ปัจจุบัน
$currentMonth = date('m');
$currentYear = date('Y');

// ดึงข้อมูลจำนวนการจองใหม่ที่สถานะเป็น pending ภายในเดือนปัจจุบัน
$query_new_bookings = "SELECT COUNT(*) AS new_bookings FROM booking_order 
                       WHERE status = 'pending' 
                       AND MONTH(order_date) = ? AND YEAR(order_date) = ?";
$stmt_new_bookings = $con->prepare($query_new_bookings);
$stmt_new_bookings->bind_param('ii', $currentMonth, $currentYear);
$stmt_new_bookings->execute();
$result_new_bookings = $stmt_new_bookings->get_result();
$new_bookings_count = $result_new_bookings->fetch_assoc()['new_bookings'];

// ดึงข้อมูลจำนวนการจองที่ถูกยกเลิกที่สถานะเป็น cancelled ภายในเดือนปัจจุบัน
$query_cancelled_bookings = "SELECT COUNT(*) AS cancelled_bookings FROM booking_order 
                             WHERE status = 'cancelled' 
                             AND MONTH(order_date) = ? AND YEAR(order_date) = ?";
$stmt_cancelled_bookings = $con->prepare($query_cancelled_bookings);
$stmt_cancelled_bookings->bind_param('ii', $currentMonth, $currentYear);
$stmt_cancelled_bookings->execute();
$result_cancelled_bookings = $stmt_cancelled_bookings->get_result();
$cancelled_bookings_count = $result_cancelled_bookings->fetch_assoc()['cancelled_bookings'];

// ดึงข้อมูลจำนวนการจองทั้งหมด
$query_total_bookings = "SELECT COUNT(*) AS total_bookings FROM booking_order";
$stmt_total_bookings = $con->prepare($query_total_bookings);
$stmt_total_bookings->execute();
$result_total_bookings = $stmt_total_bookings->get_result();
$total_bookings_count = $result_total_bookings->fetch_assoc()['total_bookings'];

// กำหนดปีปัจจุบัน, ปีที่แล้ว และปีถัดไป
$currentYear = date('Y');
$previousYear = $currentYear - 1;
$nextYear = $currentYear + 1;

// ดึงข้อมูลยอดขายตามเดือนจากตาราง booking_order สำหรับ 3 ปีนี้
$sales_data = [];
$yearly_sales_data = [];
$months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];

// ดึงยอดขายรายเดือนเฉพาะ 3 ปีที่ต้องการ
$query_monthly = "SELECT YEAR(order_date) AS year, MONTH(order_date) AS month, SUM(total_amount) AS total_sales 
                  FROM booking_order 
                  WHERE status = 'confirmed' AND YEAR(order_date) BETWEEN ? AND ?
                  GROUP BY YEAR(order_date), MONTH(order_date)";
$stmt = $con->prepare($query_monthly);
$stmt->bind_param('ii', $previousYear, $nextYear);
$stmt->execute();
$result_monthly = $stmt->get_result();

while ($row = mysqli_fetch_assoc($result_monthly)) {
    $year = (int)$row['year'];
    $month = (int)$row['month'];
    $total_sales = (float)$row['total_sales'];

    if (!isset($sales_data[$year])) {
        $sales_data[$year] = array_fill(1, 12, 0); // เติมค่าเริ่มต้นเป็น 0 สำหรับทุกเดือนในปีนั้น
    }
    $sales_data[$year][$month] = $total_sales;
}

// ดึงยอดขายรายปีสำหรับ 3 ปีนี้
$query_yearly = "SELECT YEAR(order_date) AS year, SUM(total_amount) AS total_sales 
                 FROM booking_order 
                 WHERE status = 'confirmed' AND YEAR(order_date) BETWEEN ? AND ?
                 GROUP BY YEAR(order_date)";
$stmt_yearly = $con->prepare($query_yearly);
$stmt_yearly->bind_param('ii', $previousYear, $nextYear);
$stmt_yearly->execute();
$result_yearly = $stmt_yearly->get_result();

while ($row = mysqli_fetch_assoc($result_yearly)) {
    $yearly_sales_data[(int)$row['year']] = (float)$row['total_sales'];
}

// เตรียมข้อมูล JSON สำหรับใช้ใน JavaScript
$sales_json = json_encode($sales_data);
$yearly_sales_json = json_encode(array_values($yearly_sales_data));
$years = json_encode(array_keys($yearly_sales_data));
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Dashboard</title>
    <?php require('inc/links.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-light">
    <?php require('inc/header.php') ?>
    <div id="layoutSidenav">
        <!-- side navbar -->
        <?php include_once "inc/sidenav.php"; ?>
        <!-- main content -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4 mb-5">Dashboard</h1>
                    <!-- <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol> -->
                    <div class="row mb-4">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-info text-white mb-4">
                                <div class="card-header text-center">
                                    <h5 class="m-0">Total Bookings</h5>
                                </div>
                                <div class="card-body text-center">
                                    <h1 class="m-0" style="font-size: 50px;">
                                        <?php echo $total_bookings_count; ?>
                                    </h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-header text-center">
                                    <h5 class="m-0">Refund Bookings</h5>
                                </div>
                                <div class="card-body text-center">
                                    <h1 class="m-0" style="font-size: 50px;">
                                        0
                                    </h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-header text-center">
                                    <h5 class="m-0">New Bookings</h5>
                                </div>
                                <div class="card-body text-center">
                                    <h1 class="m-0" style="font-size: 50px;">
                                        <?php echo $new_bookings_count; ?>
                                    </h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-danger text-white mb-4">
                                <div class="card-header text-center">
                                    <h5 class="m-0">Cancelled Bookings</h5>
                                </div>
                                <div class="card-body text-center">
                                    <h1 class="m-0" style="font-size: 50px;">
                                        <?php echo $cancelled_bookings_count; ?>
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-area me-1"></i>
                                    Monthly Sales
                                </div>
                                <div class="card-body"><canvas id="myAreaChart" width="100%" height="60"></canvas></div>
                            </div>
                        </div>
                        <div class="col-xl-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar me-1"></i>
                                    Yearly Sales Comparison
                                </div>
                                <div class="card-body"><canvas id="myYearlyChart" width="100%" height="60"></canvas></div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <?php require('inc/script.php') ?>
</body>

<script>
    // ข้อมูลที่ส่งมาจาก PHP
    const months = <?php echo json_encode($months); ?>;
    const salesData = <?php echo $sales_json; ?>;
    const years = <?php echo $years; ?>;
    const yearlySalesData = <?php echo $yearly_sales_json; ?>;

    // กราฟรายได้ต่อเดือน แสดง 3 ปี
    const ctxArea = document.getElementById('myAreaChart').getContext('2d');
    const datasets = Object.keys(salesData).map(year => {
        return {
            label: `Year ${year}`,
            data: Object.values(salesData[year]),
            borderWidth: 2,
            fill: false,
            borderColor: `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 1)`
        };
    });

    const myAreaChart = new Chart(ctxArea, {
        type: 'line',
        data: {
            labels: months,
            datasets: datasets
        },
        options: {
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    // กราฟรายได้ต่อปี
    const ctxBar = document.getElementById('myYearlyChart').getContext('2d');
    const myYearlyChart = new Chart(ctxBar, {
        type: 'bar',
        data: {
            labels: years,
            datasets: [{
                label: 'Total Sales per Year',
                data: yearlySalesData,
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 2
            }]
        },
        options: {
            scales: {
                x: {
                    beginAtZero: true
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

</html>