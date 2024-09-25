    <?php
    require('../admin/inc/db_config.php'); 
    require('../admin/inc/essentials.php'); 

if (isset($_POST['register'])) {
    // กรองข้อมูลจากฟอร์ม
    $frm_data = filteration($_POST);

    // ข้อมูลจากฟอร์ม
    $name = $frm_data['name'];
    $email = $frm_data['email'];
    $phone = $frm_data['phone'];
    $address = $frm_data['address'];
    $pincode = $frm_data['pincode'];
    $dob = $frm_data['dob'];
    $password = $frm_data['password'];
    $confirm_password = $frm_data['confirm_password'];

    // ตรวจสอบความถูกต้องของข้อมูล
    if (empty($name) || empty($email) || empty($phone) || empty($address) || empty($pincode) || empty($dob) || empty($password) || empty($confirm_password)) {
        echo json_encode(['success' => false, 'message' => 'Please fill in all fields.']);
        exit;
    }

    if ($password !== $confirm_password) {
        echo 'pass_mismatch';
        exit;
    }

    // อัปโหลดรูปภาพ
    $img_r = uploadUserImage($_FILES['picture']); // สมมติว่า `uploadImage` เป็นฟังก์ชันที่ใช้จัดการการอัปโหลดรูปภาพ

    if ($img_r == 'inv_img') {
        echo 'inv_img';
        exit;
    } else if ($img_r == 'upd_failed') {
        echo 'upd_failed';
        exit;
    } else {
        // เข้ารหัสรหัสผ่าน
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // ตรวจสอบว่ามีผู้ใช้อยู่แล้วหรือไม่
        $u_exist = select("SELECT * FROM `users` WHERE `email` = ? AND `phone` = ? LIMIT 1",[$email,$phone],"ss");
    
        if(mysqli_num_rows($u_exist) != 0) {
            $u_exist_fetch =mysqli_fetch_assoc($u_exist);
            echo ($u_exist_fetch['email'] == $email)? 'email_already': 'phone_already';
            exit;
        }

        // แทรกข้อมูลลงในฐานข้อมูล
        $insert_query = "INSERT INTO `users` (`name`, `email`, `phone`, `address`, `pincode`, `date_of_birth`, `password`, `picture`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $insert_values = [$name, $email, $phone, $address, $pincode, $dob, $hashed_password, $img_r];
        $insert_res = insert($insert_query, $insert_values, 'ssssssss');

        if ($insert_res > 0) {
            echo 1;
        } else {
            error_log(mysqli_error($con)); // บันทึกข้อผิดพลาดลงใน log
            echo 'insert_failed';
        }
    }
}

?>