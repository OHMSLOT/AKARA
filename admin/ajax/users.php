<?php 
    require('../inc/db_config.php');
    require('../inc/essentials.php');
    adminLogin();

    if(isset($_POST['get_users']))
    {
        $res = selectAll('users');
        $i = 1;
        $path = USERS_IMG_PATH;

        $data = "";

        while($row =mysqli_fetch_assoc($res))
        {
            $data.="
                <tr>
                <td>$i</td>
                <td>
                    <img src='$path$row[picture]' width='55px'>
                    <br>
                    $row[name]
                </td>
                <td>$row[email]</td>
                <td>$row[phone]</td>
                <td>$row[address] | $row[pincode]</td>
                <td>$row[date_of_birth]</td>
                <td>
                    <button type='button' onclick='rem_user($row[id])' class='btn btn-danger btn-sm shadow-none'>
                        <i class='bi bi-trash'></i> Delete
                    </button>
                </td>
                 </tr>
            ";
            $i++;
        }
        echo $data;
    }

    if(isset($_POST['rem_user'])) 
    {
        $frm_data = filteration($_POST);
        $valuse = [$frm_data['user_id']];

        // ดึงข้อมูลผู้ใช้เพื่อตรวจสอบรูปภาพ
        $pre_q = "SELECT * FROM users WHERE id=?";
        $res = select($pre_q, $valuse, 'i');
        $img = mysqli_fetch_assoc($res);

        // ลบรูปภาพของผู้ใช้
        if(deleteImage($img['picture'], USERS_FOLDER)) {
            // ลบข้อมูลผู้ใช้จากฐานข้อมูล
            $q = "DELETE FROM users WHERE id=?";
            $res = delete($q, $valuse, 'i');
            echo $res; // ส่งค่าการลบสำเร็จหรือไม่กลับไป
        } else {
            echo 0; // ลบรูปภาพไม่สำเร็จ
        }
    }

    // การค้นหาผู้ใช้
    if(isset($_POST['search_user'])) 
    {
        $frm_data = filteration($_POST);
        $query = "%" . $frm_data['search_user'] . "%"; // ใช้ wildcard สำหรับการค้นหา

        $q = "SELECT * FROM `users` WHERE `name` LIKE ? OR `email` LIKE ?";
        $res = select($q, [$query, $query], 'ss');
        $i = 1;
        $path = USERS_IMG_PATH;

        $data = "";

        while($row = mysqli_fetch_assoc($res))
        {
            $data .= "
                <tr>
                <td>$i</td>
                <td>
                    <img src='$path$row[picture]' width='55px'>
                    <br>
                    $row[name]
                </td>
                <td>$row[email]</td>
                <td>$row[phone]</td>
                <td>$row[address] | $row[pincode]</td>
                <td>$row[date_of_birth]</td>
                <td>
                    <button type='button' onclick='rem_user($row[id])' class='btn btn-danger btn-sm shadow-none'>
                        <i class='bi bi-trash'></i> Delete
                    </button>
                </td>
                </tr>
            ";
            $i++;
        }
        echo $data;
    }
?>
