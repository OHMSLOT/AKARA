    <?php
    require('../inc/db_config.php');
    require('../inc/essentials.php');
    adminLogin();

    if (isset($_POST['query']) && isset($_POST['page'])) {
        $query = filter_var($_POST['query'], FILTER_SANITIZE_STRING);
        $page = (int)$_POST['page'];
        $recordsPerPage = 5;
        $offset = ($page - 1) * $recordsPerPage;

        $searchTerm = "%$query%";
        $sql = "SELECT bo.order_id, bo.order_number, bo.total_amount, bo.status, bd.firstname, bd.lastname, bd.room_name, bd.checkin, bd.checkout, bd.nights, bd.total_price
                FROM booking_order bo
                JOIN booking_detail bd ON bo.order_id = bd.order_id
                WHERE bo.order_number LIKE ? OR bd.firstname LIKE ? OR bd.lastname LIKE ? OR bd.room_name LIKE ?
                LIMIT ?, ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param('ssssii', $searchTerm, $searchTerm, $searchTerm, $searchTerm, $offset, $recordsPerPage);
        $stmt->execute();
        $result = $stmt->get_result();

        // Get the total number of rows for pagination
        $total_sql = "SELECT COUNT(*) AS total FROM booking_order bo 
                    JOIN booking_detail bd ON bo.order_id = bd.order_id
                    WHERE bo.order_number LIKE ? OR bd.firstname LIKE ? OR bd.lastname LIKE ? OR bd.room_name LIKE ?";
        $stmt_total = $con->prepare($total_sql);
        $stmt_total->bind_param('ssss', $searchTerm, $searchTerm, $searchTerm, $searchTerm);
        $stmt_total->execute();
        $total_result = $stmt_total->get_result();
        $total_rows = $total_result->fetch_assoc()['total'];
        $total_pages = ceil($total_rows / $recordsPerPage);

        $data = '';
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
                    <td><span class='badge " . ($row['status'] == 'cancelled' ? 'bg-danger' : 'bg-success') . "'>" . ucfirst($row['status']) . "</span></td>
                    <td>
                        <button type='button' onclick='printReceipt(\"{$row['order_number']}\", \"{$row['firstname']} {$row['lastname']}\", \"{$row['room_name']}\", \"{$row['checkin']}\", \"{$row['checkout']}\", \"{$row['nights']}\", \"" . number_format($row['total_price'], 2) . "\", \"" . number_format($row['total_amount'], 2) . "\")' class='btn btn-sm btn-primary'>
                            Print
                        </button>
                    </td>
                </tr>";
        }

        echo json_encode([
            'data' => $data,
            'pagination' => pagination($total_pages, $page, $query)
        ]);
    }

    function pagination($total_pages, $current_page, $query)
    {
        $pagination = '<ul class="pagination justify-content-center">';

        if ($current_page > 1) {
            $pagination .= '<li class="page-item">
                            <a class="page-link" href="#" onclick="getBookingRecords(\'' . $query . '\', ' . ($current_page - 1) . ')">&laquo;</a>
                        </li>';
        }

        for ($i = 1; $i <= $total_pages; $i++) {
            $active = ($i == $current_page) ? 'active' : '';
            $pagination .= '<li class="page-item ' . $active . '">
                            <a class="page-link" href="#" onclick="getBookingRecords(\'' . $query . '\', ' . $i . ')">' . $i . '</a>
                        </li>';
        }

        if ($current_page < $total_pages) {
            $pagination .= '<li class="page-item">
                            <a class="page-link" href="#" onclick="getBookingRecords(\'' . $query . '\', ' . ($current_page + 1) . ')">&raquo;</a>
                        </li>';
        }

        $pagination .= '</ul>';

        return $pagination;
    }
