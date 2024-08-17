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
                        <button type="button" onclick="rem_feature($row[id])" class="btn btn-danger btn-sm shadow-none">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    </td>
                </tr>
            data;
            $i++;
        }
    }

    if(isset($_POST['rem_feature']))
    {
        $frm_data = filteration($_POST);
        $valuse = [$frm_data['rem_feature']];

        $q = "DELETE FROM `features` WHERE `id`=?";
        $res = delete($q,$valuse,'i');
        echo $res;
    }

    if(isset($_POST['add_facilities']))
    {
        $frm_data =filteration($_POST);


        $img_r = uploadImage($_FILES['picture'],FACILITIES_FOLDER);

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
            $q = "INSERT INTO `facilities`(`image`, `name`, `description`) VALUES (?,?,?)";
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
                    <td><img src="$path$row[image]" width="200px"></td>
                    <td>$row[name]</td>
                    <td>$row[description]</td>
                    <td>
                        <button type="button" onclick="rem_facilities($row[id])" class="btn btn-danger btn-sm shadow-none">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    </td>
                </tr>
            data;
            $i++;
        }
    }

    if(isset($_POST['rem_facilities']))
    {
        $frm_data = filteration($_POST);
        $valuse = [$frm_data['rem_facilities']];

        $pre_q = "SELECT * FROM `facilities` WHERE `id`=?";
        $res = select($pre_q,$valuse,'i');
        $img = mysqli_fetch_assoc($res);
        
        if(deleteImage($img['image'],FACILITIES_FOLDER)){
            $q = "DELETE FROM `facilities` WHERE `id`=?";
            $res = delete($q,$valuse,'i');
            echo $res;
        }
        else{
            echo 0;
        }
    }

?>