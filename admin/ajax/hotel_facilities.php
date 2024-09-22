<?php 
    require('../inc/db_config.php');
    require('../inc/essentials.php');
    adminLogin();

    if(isset($_POST['add_facility']))
    {
        $frm_data =filteration($_POST);
        $img_r = uploadImage($_FILES['picture'],HOTEL_FACILITIES_FOLDER);

        if($img_r == 'inv_img'){
            echo $img_r;
        }
        else if($img_r == 'inv_size'){
            echo $img_r;
        }
        else if($img_r == 'upd_failed'){
            echo $img_r;
        }
        else{
            $q = "INSERT INTO `hotel_facilities`(`image`, `name`,`time_s`, `time_e`, `description`) VALUES (?,?,?,?,?)";
            $valuse = [$img_r,$frm_data['name'],$frm_data['time_s'],$frm_data['time_e'],$frm_data['desc']];
            $res = insert($q,$valuse,'sssss');
            echo $res;

            // Debugging output
            if ($res === false) {
                echo "Database insert failed!";
            } else {
                echo "Event added successfully!";
            }
        }
    } 

    if(isset($_POST['get_facility']))
    {
        $res = selectAll('hotel_facilities');
        $i = 1;
        $path = HOTEL_FACILITIES_IMG_PATH;

        while($row = mysqli_fetch_assoc($res))
        {
            echo <<<data
                <tr class="align-middle">
                    <td>$i</td>
                    <td><img class="image" src="$path$row[image]" height="150px"></td>
                    <td>$row[name]</td>
                    <td>$row[time_s]</td>
                    <td>$row[time_e]</td>
                    <td>$row[description]</td>
                    <td>
                        <button type="button" onclick="edit_facility_info($row[id],'$row[name]','$row[time_s]','$row[time_e]','$row[description]')" class="btn btn-secondary btn-md shadow-none">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <button type="button" onclick="edit_facility_image($row[id],'$path$row[image]')" class="btn btn-success btn-md shadow-none">
                            <i class="bi bi-image"></i>
                        </button>
                        <button type="button" onclick="rem_facility($row[id])" class="btn btn-danger btn-md shadow-none">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
            data;
            $i++;
        }
    }

    if(isset($_POST['update_facility_info']))
    {
        $frm_data = filteration($_POST);
        $q = "UPDATE `hotel_facilities` SET `name`=?, `time_s`=?, `time_e`=?, `description`=? WHERE `id`=?";
        $values = [$frm_data['name'], $frm_data['time_s'], $frm_data['time_e'], $frm_data['desc'], $frm_data['id']];
        $res = update($q, $values, 'ssssi');
        echo $res;
    }

    if(isset($_POST['update_facility_image']))
    {
        $frm_data = filteration($_POST);
        
        $img_r = uploadImage($_FILES['image'], HOTEL_FACILITIES_FOLDER);

        if($img_r == 'inv_img'){
            echo $img_r;
        }
        else if($img_r == 'inv_size'){
            echo $img_r;
        }
        else if($img_r == 'upd_failed'){
            echo $img_r;
        }
        else{
            // ลบรูปภาพเก่า
            $pre_q = "SELECT * FROM `hotel_facilities` WHERE `id`=?";
            $res = select($pre_q,[$frm_data['id']],'i');
            $img = mysqli_fetch_assoc($res);
            deleteImage($img['image'],HOTEL_FACILITIES_FOLDER);

            // อัปเดตรูปภาพใหม่
            $q = "UPDATE `hotel_facilities` SET `image`=? WHERE `id`=?";
            $values = [$img_r, $frm_data['id']];
            $res = update($q, $values, 'si');
            echo $res;
        }
    }


    if(isset($_POST['rem_facility']))
    {
        $frm_data = filteration($_POST);
        $valuse = [$frm_data['rem_facility']];

        $pre_q = "SELECT * FROM `hotel_facilities` WHERE `id`=?";
        $res = select($pre_q,$valuse,'i');
        $img = mysqli_fetch_assoc($res);
        
        if(deleteImage($img['image'],HOTEL_FACILITIES_FOLDER)){
            $q = "DELETE FROM `hotel_facilities` WHERE `id`=?";
            $res = delete($q,$valuse,'i');
            echo $res;
        }
        else{
            echo 0;
        }
    }

?>