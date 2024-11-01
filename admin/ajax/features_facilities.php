<?php 
    require('../inc/db_config.php');
    require('../inc/essentials.php');
    adminLogin();

    if(isset($_POST['add_feature']))
    {
        $frm_data =filteration($_POST);

        $q = "INSERT INTO `features`(`name`) VALUES (?)";
        $valuse = [$frm_data['name']];
        $res = insert($q,$valuse,'s');
        echo $res;
    } 

    if(isset($_POST['get_features']))
    {
        $res = selectAll('features');
        $i = 1;

        while($row = mysqli_fetch_assoc($res))
        {
            echo <<<data
                <tr class="align-middle">
                    <td>$i</td>
                    <td>$row[name]</td>
                    <td>
                        <button type="button" onclick="edit_feature($row[id],'$row[name]')" class="btn btn-secondary btn-sm shadow-none">
                            <i class="bi bi-pencil-square"></i> Edit
                        </button>
                        <button type="button" onclick="rem_feature($row[id])" class="btn btn-danger btn-sm shadow-none">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    </td>
                </tr>
            data;
            $i++;
        }
    }

    if(isset($_POST['update_feature']))
    {
        $frm_data = filteration($_POST);
        $q = "UPDATE `features` SET `name`=? WHERE `id`=?";
        $values = [$frm_data['name'], $frm_data['id']];
        $res = update($q, $values, 'si');
        echo $res;
    }


    if(isset($_POST['rem_feature']))
    {
        $frm_data = filteration($_POST);
        $valuse = [$frm_data['rem_feature']];

        $check_q = select('SELECT * FROM `room_features` WHERE `features_id`=?',[$frm_data['rem_feature']],'i');

        if(mysqli_num_rows($check_q)==0){
            $q = "DELETE FROM `features` WHERE `id`=?";
            $res = delete($q,$valuse,'i');
            echo $res;
        }
        else{
            echo 'room_added';
        }

        
    }

    if(isset($_POST['add_facilities']))
    {
        $frm_data =filteration($_POST);

        $img_r = uploadSVGImage($_FILES['icon'],FACILITIES_FOLDER);

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
            $q = "INSERT INTO `facilities`(`icon`, `name`, `description`) VALUES (?,?,?)";
            $valuse = [$img_r,$frm_data['name'],$frm_data['desc']];
            $res = insert($q,$valuse,'sss');
            echo $res;
        }
    } 

    if(isset($_POST['get_facilities']))
    {
        $res = selectAll('facilities');
        $i = 1;
        $path = FACILITIES_IMG_PATH;

        while($row = mysqli_fetch_assoc($res))
        {
            echo <<<data
                <tr class="align-middle">
                    <td>$i</td>
                    <td><img src="$path$row[icon]" width="50px"></td>
                    <td>$row[name]</td>
                    <td>$row[description]</td>
                    <td>
                        <button type="button" onclick="edit_facilities($row[id],'$row[name]','$row[description]')" class="btn btn-secondary btn-sm shadow-none">
                            <i class="bi bi-pencil-square"></i> Edit
                        </button>
                        <button type="button" onclick="edit_facilities_image($row[id], '$path$row[icon]')" class="btn btn-success btn-sm shadow-none">
                            <i class="bi bi-image"></i> Edit Image
                        </button>
                        <button type="button" onclick="rem_facilities($row[id])" class="btn btn-danger btn-sm shadow-none">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    </td>
                </tr>
            data;
            $i++;
        }
    }

    if(isset($_POST['update_facilities']))
    {
        $frm_data = filteration($_POST);
        $q = "UPDATE `facilities` SET `name`=?, `description`=? WHERE `id`=?";
        $values = [$frm_data['name'], $frm_data['desc'], $frm_data['id']];
        $res = update($q, $values, 'ssi');
        echo $res;
    }

    if(isset($_POST['update_facilities_image']))
    {
        $frm_data = filteration($_POST);
        
        $img_r = uploadSVGImage($_FILES['icon'], FACILITIES_FOLDER);

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
            // delete the old image
            $pre_q = "SELECT * FROM `facilities` WHERE `id`=?";
            $res = select($pre_q,[$frm_data['id']],'i');
            $img = mysqli_fetch_assoc($res);
            deleteImage($img['icon'],FACILITIES_FOLDER);

            // update with the new image
            $q = "UPDATE `facilities` SET `icon`=? WHERE `id`=?";
            $values = [$img_r, $frm_data['id']];
            $res = update($q, $values, 'si');
            echo $res;
        }
    }


    if(isset($_POST['rem_facilities']))
    {
        $frm_data = filteration($_POST);
        $valuse = [$frm_data['rem_facilities']];

        $check_q = select('SELECT * FROM `room_facilities` WHERE `facilities_id`=?',[$frm_data['rem_facilities']],'i');

        if(mysqli_num_rows($check_q)==0){ 
            $pre_q = "SELECT * FROM `facilities` WHERE `id`=?";
            $res = select($pre_q,$valuse,'i');
            $img = mysqli_fetch_assoc($res);
            
            if(deleteImage($img['icon'],FACILITIES_FOLDER)){
                $q = "DELETE FROM `facilities` WHERE `id`=?";
                $res = delete($q,$valuse,'i');
                echo $res;
            }
            else{
                echo 0;
            }
        }
        else{
            echo 'room_added';
        }

        
    }

?>