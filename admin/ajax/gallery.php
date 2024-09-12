<?php
    require('../inc/db_config.php'); // Include db_config which contains the database connection and functions
    require('../inc/essentials.php');

    if (isset($_POST['add_gallery'])) {
        $frm_data = filteration($_POST); // Filter the input

        // Insert into the database
        $q = "INSERT INTO `gallery`(`name`) VALUES (?)";
        $values = [$frm_data['gallery_name']];
        $res = insert($q, $values, 's'); // Insert using the insert function
        echo $res;
    }

    if (isset($_POST['get_gallery'])) {
        $res = selectAll('gallery');
        $i = 1;

        $data = "";

        while ($row = mysqli_fetch_assoc($res)) {
            $data.="
                    <tr class='align-middle'>
                        <td>$i</td>
                        <td>$row[name]</td>
                        <td>
                            <button type='button' onclick=\"gallery_images($row[id],'$row[name]')\" class='btn btn-success text-white shadow-none btn-sm' data-bs-toggle='modal' data-bs-target='#gallery-image'>
                                <i class='bi bi-images'></i> Image
                            </button>
                            <button type='button' onclick='edit_gallery($row[id], \"$row[name]\")' class='btn btn-secondary text-white btn-sm shadow-none' data-bs-toggle='modal' data-bs-target='#edit-gallery'>
                                <i class='bi bi-pencil'></i> Edit
                            </button>
                            <button type='button' onclick='rem_gallery($row[id])' class='btn btn-danger btn-sm shadow-none'>
                                <i class='bi bi-trash'></i> Delete
                            </button>
                        </td>
                    </tr>
                ";
            $i++;
        }
        echo $data;
    }

    if (isset($_POST['edit_gallery'])) {
        $frm_data = filteration($_POST);
    
        $q = "UPDATE `gallery` SET `name`=? WHERE `id`=?";
        $values = [$frm_data['gallery_name'], $frm_data['gallery_id']];
        $res = update($q, $values, 'si'); // อัปเดตชื่อแกลเลอรี
    
        echo $res; // ส่งผลลัพธ์กลับไปยัง AJAX
    }
    

    if (isset($_POST['rem_gallery'])) {
        $frm_data = filteration($_POST);
    
        // Select all images related to the gallery
        $res1 = select("SELECT * FROM `gallery_images` WHERE `gallery_id`=?", [$frm_data['gallery_id']], 'i');
    
        // Loop through each image and delete the file
        while ($row = mysqli_fetch_assoc($res1)) {
            deleteImage($row['image'], GALLERY_FOLDER);
        }
    
        // Delete all images in the gallery from the database
        $res2 = delete("DELETE FROM `gallery_images` WHERE `gallery_id`=?", [$frm_data['gallery_id']], 'i');
    
        // Delete the gallery itself from the database
        $res3 = delete("DELETE FROM `gallery` WHERE `id`=?", [$frm_data['gallery_id']], 'i');
    
        // Check if the operations were successful
        if ($res2 || $res3) {
            echo 1;
        } else {
            echo 0;
        }
    }
    

    if (isset($_POST['add_gallery_image'])) {
        $frm_data = filteration($_POST);
    
        // Handle image upload
        $img_r = uploadImage($_FILES['image'], GALLERY_FOLDER);
    
        if ($img_r == 'inv_img') {
            echo $img_r;
        } else if ($img_r == 'inv_size') {
            echo $img_r;
        } else if ($img_r == 'upd_failed') {
            echo $img_r;
        } else {
            // Insert the uploaded image into the database
            $q = "INSERT INTO `gallery_images`(`gallery_id`, `image`) VALUES (?,?)";
            $values = [$frm_data['gallery_id'], $img_r];
            $res = insert($q, $values, 'is');
            echo $res;  
        }
    }
    
    if (isset($_POST['get_gallery_images'])) {
        $frm_data =filteration($_POST);
        $res = select("SELECT * FROM `gallery_images` WHERE `gallery_id`=?",[$frm_data['get_gallery_images']],'i');
        $path = GALLERY_IMG_PATH;
    
        while ($row = mysqli_fetch_assoc($res)) 
        {
            if($row['thumb']==1){
                $thumb_btn = "<i class='bi bi-check-lg text-light bg-success px-2 py-1 rounded fs-5'></i>";
            }
            else{
                $thumb_btn = "<button onclick='thumb_image($row[sr_no],$row[gallery_id])' class='btn btn-secondary shadow-none'>
                    <i class='bi bi-check-lg'></i>
                </button>";
            }

            echo "<tr class='align-middle'>
                    <td><img src='$path$row[image]' width='100%'></td>
                    <td>$thumb_btn</td>
                    <td>
                        <button onclick='rem_image($row[sr_no],$row[gallery_id])' class='btn btn-danger shadow-none'>
                            <i class='bi bi-trash'></i>
                        </button>
                    </td>
                  </tr>";
        }
    }
    
    if (isset($_POST['rem_image'])) {
        $frm_data = filteration($_POST);

        $valuse = [$frm_data['image_id'],$frm_data['gallery_id']];

        $pre_q = "SELECT * FROM `gallery_images` WHERE `sr_no`=? AND `gallery_id`=?";
        $res = select($pre_q, $valuse, 'ii');
        $img = mysqli_fetch_assoc($res);

        if (deleteImage($img['image'], GALLERY_FOLDER)) 
        {
            $q = "DELETE FROM `gallery_images` WHERE `sr_no`=? AND `gallery_id`=?";
            $res = delete($q, $valuse, 'ii');
            echo $res;
        } else {
            echo 0;
        }

        
    }
    
    if (isset($_POST['thumb_image'])) {
        $frm_data = filteration($_POST);
    
        // Set thumbnail image
        $pre_q = "UPDATE `gallery_images` SET `thumb`=? WHERE `gallery_id`=?";
        $pre_v = [0,$frm_data['gallery_id']];
        $pre_res = update($pre_q,$pre_v,'ii');

        $q = "UPDATE `gallery_images` SET `thumb`=? WHERE `sr_no`=? AND `gallery_id`=?";
        $v = [1,$frm_data['image_id'],$frm_data['gallery_id']];
        $res = update($q,$v,'iii');
        echo $res;
    }

?>    
