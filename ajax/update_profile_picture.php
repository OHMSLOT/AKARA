<?php
session_start();
require('../admin/inc/db_config.php');
require('../admin/inc/essentials.php');

if (isset($_FILES['profile_picture']['name'])) {
    $img_name = $_FILES['profile_picture']['name'];
    $img_tmp = $_FILES['profile_picture']['tmp_name'];
    $img_ext = pathinfo($img_name, PATHINFO_EXTENSION);
    $allowed_ext = array('jpg', 'jpeg', 'png');

    if (in_array($img_ext, $allowed_ext)) {
        $new_img_name = uniqid() . '.' . $img_ext;
        $upload_path = UPLOAD_IMAGE_PATH . USERS_FOLDER . $new_img_name; // ใช้ USERS_FOLDER แทนที่ตำแหน่ง

        // ย้ายไฟล์ไปยังโฟลเดอร์ที่เก็บรูป
        if (move_uploaded_file($img_tmp, $upload_path)) {
            // ลบรูปภาพเก่าหากมี
            $old_img_query = select("SELECT picture FROM `users` WHERE `id`=?", [$_SESSION['uId']], 'i');
            $old_img_result = mysqli_fetch_assoc($old_img_query);
            if ($old_img_result['picture'] != "" && file_exists(UPLOAD_IMAGE_PATH . USERS_FOLDER . $old_img_result['picture'])) {
                unlink(UPLOAD_IMAGE_PATH . USERS_FOLDER . $old_img_result['picture']);
            }

            // อัปเดตข้อมูลรูปภาพในฐานข้อมูล
            $query = "UPDATE `users` SET `picture`=? WHERE `id`=?";
            $values = [$new_img_name, $_SESSION['uId']];
            if (update($query, $values, 'si')) {
                $_SESSION['uPic'] = $new_img_name; // อัปเดตรูปภาพในเซสชัน

                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Database update failed']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to upload image']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid image file type']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No image file uploaded']);
}
?>
