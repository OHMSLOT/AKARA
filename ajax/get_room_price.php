<?php
require('../admin/inc/db_config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['room_id'])) {
        $room_id = $_POST['room_id'];

        // คำสั่ง SQL เพื่อตรวจสอบราคาของห้อง
        $query = "SELECT name, price FROM rooms WHERE id = ?";
        $stmt = $con->prepare($query);
        $stmt->bind_param("i", $room_id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $room_data = $result->fetch_assoc();

            // ส่งข้อมูลกลับเป็น JSON
            echo json_encode([
                'success' => true,
                'room_name' => $room_data['name'],
                'price_per_night' => $room_data['price']
            ]);
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Room not found'
            ]);
        }

        $stmt->close();
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Invalid request'
        ]);
    }
}
?>
