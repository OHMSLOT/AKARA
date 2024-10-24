<?php
require('../inc/db_config.php');
require('../inc/essentials.php');
adminLogin();

if (isset($_POST['query']) && isset($_POST['page'])) {
    $query = filteration($_POST['query']);
    $page = filteration($_POST['page']);
    $recordsPerPage = 5;
    $offset = ($page - 1) * $recordsPerPage;

    $searchTerm = "%$query%";
    $sql = "SELECT bo.order_id, bo.order_number, bo.total_amount, bo.status, bd.firstname, bd.lastname, bd.room_name, bd.checkin, bd.checkout, bd.nights, bd.total_price
            FROM booking_order bo
            JOIN booking_detail bd ON bo.order_id = bd.order_id
            WHERE bo.status = 'cancelled' AND (bo.order_number LIKE ? OR bd.firstname LIKE ? OR bd.lastname LIKE ? OR bd.room_name LIKE ?)
            LIMIT ?, ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param('ssssii', $searchTerm, $searchTerm, $searchTerm, $searchTerm, $offset, $recordsPerPage);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = '';
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data .= "
                <tr class='align-middle'>
                    <td><span class='badge text-bg-primary'>{$row['order_number']}</span></td>
                    <td>{$row['firstname']} {$row['lastname']}</td>
                    <td>{$row['room_name']}</td>
                    <td>
                        <strong>Check-in:</strong> {$row['checkin']}<br>
                        <strong>Check-out:</strong> {$row['checkout']}<br>
                        <strong>Nights:</strong> {$row['nights']}
                    </td>
                    <td>" . number_format($row['total_price'], 2) . "</td>
                    <td><span class='badge bg-danger'>" . ucfirst($row['status']) . "</span></td>
                    <td>
                        <button type='button' onclick='processRefund({$row['order_id']})' class='btn btn-sm btn-primary'>
                            Refund
                        </button>
                    </td>
                </tr>";
        }
    } else {
        $data = "<tr><td colspan='7' class='text-center'>No bookings available for refund</td></tr>";
    }

    // Pagination
    $total_sql = "SELECT COUNT(*) AS total FROM booking_order bo 
                  JOIN booking_detail bd ON bo.order_id = bd.order_id
                  WHERE bo.status = 'cancelled' AND (bo.order_number LIKE ? OR bd.firstname LIKE ? OR bd.lastname LIKE ? OR bd.room_name LIKE ?)";
    $stmt_total = $con->prepare($total_sql);
    $stmt_total->bind_param('ssss', $searchTerm, $searchTerm, $searchTerm, $searchTerm);
    $stmt_total->execute();
    $total_result = $stmt_total->get_result();
    $total_rows = $total_result->fetch_assoc()['total'];
    $total_pages = ceil($total_rows / $recordsPerPage);

    $pagination = '<ul class="pagination justify-content-center">';
    if ($page > 1) {
        $pagination .= "<li class='page-item'><a class='page-link' href='#' onclick='getRefundBookings(\"$query\", " . ($page - 1) . ")'>&laquo;</a></li>";
    }

    for ($i = 1; $i <= $total_pages; $i++) {
        $active = $i == $page ? 'active' : '';
        $pagination .= "<li class='page-item $active'><a class='page-link' href='#' onclick='getRefundBookings(\"$query\", $i)'>$i</a></li>";
    }

    if ($page < $total_pages) {
        $pagination .= "<li class='page-item'><a class='page-link' href='#' onclick='getRefundBookings(\"$query\", " . ($page + 1) . ")'>&raquo;</a></li>";
    }
    $pagination .= '</ul>';

    echo json_encode(['data' => $data, 'pagination' => $pagination]);
}

if (isset($_POST['refund_order'])) {
    $order_id = filteration($_POST['refund_order']);
    $q = "UPDATE booking_order SET status='refunded' WHERE order_id=?";
    $res = update($q, [$order_id], 'i');
    echo $res ? 'success' : 'error';
}
