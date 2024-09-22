<?php 
    require('../inc/db_config.php');
    require('../inc/essentials.php');
    adminLogin();

    if(isset($_POST['add_event']))
    {
        $frm_data =filteration($_POST);
        $img_r = uploadImage($_FILES['picture'],EVENTS_FOLDER);

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
            $q = "INSERT INTO `events`(`image`, `name`,`time_s`, `time_e`, `date`, `description`) VALUES (?,?,?,?,?,?)";
            $valuse = [$img_r,$frm_data['name'],$frm_data['time_s'],$frm_data['time_e'],$frm_data['date'],$frm_data['desc']];
            $res = insert($q,$valuse,'ssssss');
            echo $res;

            // Debugging output
            if ($res === false) {
                echo "Database insert failed!";
            } else {
                echo "Event added successfully!";
            }
        }
    } 

    if(isset($_POST['get_event']))
    {
        $res = selectAll('events');
        $i = 1;
        $path = EVENTS_IMG_PATH;

        while($row = mysqli_fetch_assoc($res))
        {
            echo <<<data
                <tr class="align-middle">
                    <td>$i</td>
                    <td><img src="$path$row[image]" width="200px"></td>
                    <td>$row[name]</td>
                    <td>$row[time_s]</td>
                    <td>$row[time_e]</td>
                    <td>$row[date]</td>
                    <td>$row[description]</td>
                    <td>
                        <button type="button" onclick="edit_info($row[id],'$row[name]','$row[time_s]','$row[time_e]','$row[date]','$row[description]')" class="btn btn-secondary btn-md shadow-none">
                            <i class="bi bi-pencil-square"></i>
                        </button>
                        <button type="button" onclick="edit_image($row[id],'$row[image]')" class="btn btn-success btn-md shadow-none">
                            <i class="bi bi-image"></i>
                        </button>
                        <button type="button" onclick="rem_event($row[id])" class="btn btn-danger btn-md shadow-none">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
            data;
            $i++;
        }
    }

    if(isset($_POST['update_event_info'])) {
        $frm_data = filteration($_POST);
        $q = "UPDATE `events` SET `name`=?, `time_s`=?, `time_e`=?, `date`=?, `description`=? WHERE `id`=?";
        $values = [$frm_data['name'], $frm_data['time_s'], $frm_data['time_e'], $frm_data['date'], $frm_data['desc'], $frm_data['id']];
        $res = update($q, $values, 'sssssi');
        echo $res;
    }

    if(isset($_POST['update_event_image'])) {
        if(isset($_FILES['picture']) && $_FILES['picture']['size'] > 0) {
            $frm_data = filteration($_POST);
            $img_r = uploadImage($_FILES['picture'], EVENTS_FOLDER);
    
            if($img_r == 'inv_img'){
                echo $img_r;
            } else if($img_r == 'inv_size'){
                echo $img_r;
            } else {
                // Delete old image and update with new one
                $pre_q = "SELECT * FROM `events` WHERE `id`=?";
                $res = select($pre_q,[$frm_data['id']],'i');
                $img = mysqli_fetch_assoc($res);
    
                if(deleteImage($img['image'], EVENTS_FOLDER)) {
                    $q = "UPDATE `events` SET `image`=? WHERE `id`=?";
                    $values = [$img_r, $frm_data['id']];
                    $res = update($q, $values, 'si');
                    echo $res;
                } else {
                    echo 'upd_failed';
                }
            }
        }
    }

    if(isset($_POST['rem_event']))
    {
        $frm_data = filteration($_POST);
        $valuse = [$frm_data['rem_event']];

        $pre_q = "SELECT * FROM `events` WHERE `id`=?";
        $res = select($pre_q,$valuse,'i');
        $img = mysqli_fetch_assoc($res);
        
        if(deleteImage($img['image'],EVENTS_FOLDER)){
            $q = "DELETE FROM `events` WHERE `id`=?";
            $res = delete($q,$valuse,'i');
            echo $res;
        }
        else{
            echo 0;
        }
    }

?>