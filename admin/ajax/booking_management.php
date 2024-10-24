<?php
require_once('../inc/db_config.php');
require_once('../inc/essentials.php');
adminLogin();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = isset($_POST['action']) ? $_POST['action'] : '';
    $query = isset($_POST['query']) ? $_POST['query'] : '';
    $page = isset($_POST['page']) ? (int)$_POST['page'] : 1;
    $recordsPerPage = 5;
    $offset = ($page - 1) * $recordsPerPage;

    if ($action === 'get_bookings') {
        // Fetch bookings data
        $searchTerm = "%$query%";
        $sql = "SELECT bo.order_id, bo.order_number, bo.total_amount, bo.status, bd.firstname, bd.lastname, bd.room_name, bd.checkin, bd.checkout, bd.nights, bd.total_price, bd.slip_image
                FROM booking_order bo
                JOIN booking_detail bd ON bo.order_id = bd.order_id
                WHERE bo.status = 'pending' AND (bo.order_number LIKE ? OR bd.firstname LIKE ? OR bd.lastname LIKE ? OR bd.room_name LIKE ?)
                LIMIT ?, ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('ssssii', $searchTerm, $searchTerm, $searchTerm, $searchTerm, $offset, $recordsPerPage);
        $stmt->execute();
        $result = $stmt->get_result();

        $data = '';
        while ($row = $result->fetch_assoc()) {
            $data .= '
                <tr>
                    <td><span class="badge text-bg-primary">' . $row['order_number'] . '</span></td>
                    <td>' . $row['firstname'] . ' ' . $row['lastname'] . '</td>
                    <td>' . $row['room_name'] . '</td>
                    <td>
                        <strong>Check-in:</strong> ' . $row['checkin'] . '<br>
                        <strong>Check-out:</strong> ' . $row['checkout'] . '<br>
                        <strong>Nights:</strong> ' . $row['nights'] . '
                    </td>
                    <td>' . number_format($row['total_price'], 2) . '</td>
                    <td>
                        <span class="badge bg-warning">' . ucfirst($row['status']) . '</span>
                    </td>
                    <td>
                        <button type="button" class="btn btn-sm btn-secondary text-white" data-bs-toggle="modal" data-bs-target="#slipImageModal" data-slip-image="' . htmlspecialchars($row['slip_image']) . '">
                            <i class="bi bi-image"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#roomModal" data-order-id="' . $row['order_id'] . '">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-danger cancel-booking-btn" data-order-id="' . $row['order_id'] . '">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </td>
                </tr>';
        }

        // Get total rows for pagination
        $total_sql = "SELECT COUNT(*) AS total FROM booking_order bo 
                      JOIN booking_detail bd ON bo.order_id = bd.order_id
                      WHERE bo.status = 'pending' AND (bo.order_number LIKE ? OR bd.firstname LIKE ? OR bd.lastname LIKE ? OR bd.room_name LIKE ?)";
        $stmt_total = $con->prepare($total_sql);
        $stmt_total->bind_param('ssss', $searchTerm, $searchTerm, $searchTerm, $searchTerm);
        $stmt_total->execute();
        $total_result = $stmt_total->get_result();
        $total_rows = $total_result->fetch_assoc()['total'];
        $total_pages = ceil($total_rows / $recordsPerPage);

        // Generate pagination HTML
        $pagination = '<ul class="pagination justify-content-center">';
        if ($page > 1) {
            $pagination .= '<li class="page-item"><a class="page-link" href="#" onclick="getBookings(\'' . $query . '\', ' . ($page - 1) . ')">&laquo;</a></li>';
        }
        for ($i = 1; $i <= $total_pages; $i++) {
            $active = ($i == $page) ? 'active' : '';
            $pagination .= '<li class="page-item ' . $active . '"><a class="page-link" href="#" onclick="getBookings(\'' . $query . '\', ' . $i . ')">' . $i . '</a></li>';
        }
        if ($page < $total_pages) {
            $pagination .= '<li class="page-item"><a class="page-link" href="#" onclick="getBookings(\'' . $query . '\', ' . ($page + 1) . ')">&raquo;</a></li>';
        }
        $pagination .= '</ul>';

        // Return the data and pagination as JSON
        echo json_encode(['data' => $data, 'pagination' => $pagination]);
    }

    if ($action === 'confirm') {
        // Confirm booking action
        $order_id = filter_var($_POST['order_id'], FILTER_SANITIZE_NUMBER_INT);
        $room_number = filter_var($_POST['room_number'], FILTER_SANITIZE_STRING);

        // Update booking status to confirmed
        $update_sql = "UPDATE booking_order SET status = 'confirmed' WHERE order_id = ?";
        $res = update($update_sql, [$order_id], 'i');

        if ($res) {
            echo 'success';
        } else {
            echo 'error';
        }
    }

    if ($action === 'cancel') {
        // Cancel booking action
        $order_id = filter_var($_POST['order_id'], FILTER_SANITIZE_NUMBER_INT);

        // Update booking status to cancelled
        $update_sql = "UPDATE booking_order SET status = 'cancelled' WHERE order_id = ?";
        $res = update($update_sql, [$order_id], 'i');

        if ($res) {
            echo 'success';
        } else {
            echo 'error';
        }
    }
}
?>
