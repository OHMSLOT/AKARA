<?php
    
    //frontend 

    define('SITE_URL','http://127.0.0.1/AKARA/');
    define('CAROUSEL_IMG_PATH',SITE_URL.'src/carousel/');
    define('FACILITIES_IMG_PATH',SITE_URL.'src/facilities/');
    define('EVENTS_IMG_PATH',SITE_URL.'src/event/');
    define('HOTEL_FACILITIES_IMG_PATH',SITE_URL.'src/hotel_facilities/');
    define('ROOMS_IMG_PATH',SITE_URL.'src/rooms/');
    define('GALLERY_IMG_PATH',SITE_URL.'src/gallery/');
    define('USERS_IMG_PATH',SITE_URL.'src/users/');


    //backend 

    define('UPLOAD_IMAGE_PATH',$_SERVER['DOCUMENT_ROOT'].'/AKARA/src/');
    define('CAROUSEL_FOLDER','carousel/');
    define('ABOUT_FOLDER','carousel/');
    define('FACILITIES_FOLDER','facilities/');
    define('EVENTS_FOLDER','event/');
    define('HOTEL_FACILITIES_FOLDER','hotel_facilities/');
    define('ROOMS_FOLDER','rooms/');
    define('GALLERY_FOLDER','gallery/');
    define('USERS_FOLDER','users/');

    function adminLogin(){
        session_start();
        if(!(isset($_SESSION['adminLogin'])&& $_SESSION['adminLogin']==true)){
            echo"<script>
                window.location.href='index.php';
            </script>";
            exit;
        }
    }

    function redirect($url){
        echo"<script>
            window.location.href='$url';
        </script>";
        exit;
    }

    function alert($type,$msg){
        $bs_class = ($type == "success") ? "alert-success" : "alert-danger"; 
        
        echo <<<alert
            <div class="alert $bs_class alert-dismissible fade show custom-alert" role="alert">
                <strong class="me-3">$msg</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        alert;
    }

    function uploadImage($image,$folder){
        $valid_mime =['image/jpeg','image/png','image/wedp'];
        $img_mime = $image['type'];

        if(!in_array($img_mime,$valid_mime)){
            return 'inv_img';
        }
        else if(($image['size']/(1024*1024))>2){
            return 'inv_size'; 
        }
        else{
            $ext = pathinfo($image['name'],PATHINFO_EXTENSION);
            $rname = 'IMG'.random_int(11111,99999).".$ext";
            $img_path = UPLOAD_IMAGE_PATH.$folder.$rname;
            if(move_uploaded_file($image['tmp_name'],$img_path)){
                return $rname;
            }
            else{
                return 'upd_failed';
            }
        }
    }

    function uploadSVGImage($image,$folder){
        $valid_mime =['image/svg+xml'];
        $img_mime = $image['type'];

        if(!in_array($img_mime,$valid_mime)){
            return 'inv_img';
        }
        else if(($image['size']/(1024*1024))>1){
            return 'inv_size'; 
        }
        else{
            $ext = pathinfo($image['name'],PATHINFO_EXTENSION);
            $rname = 'IMG'.random_int(11111,99999).".$ext";
            $img_path = UPLOAD_IMAGE_PATH.$folder.$rname;
            if(move_uploaded_file($image['tmp_name'],$img_path)){
                return $rname;
            }
            else{
                return 'upd_failed';
            }
        }
    }

    function deleteImage($image,$folder){
        if(unlink(UPLOAD_IMAGE_PATH.$folder.$image)){
            return true;
        }
        else{
            return false;
        }
    }
    
    function uploadUserImage($image){
        $valid_mime =['image/jpeg','image/png','image/wedp'];
        $img_mime = $image['type'];

        if(!in_array($img_mime,$valid_mime)){
            return 'inv_img';
        }
        else{
            $ext = pathinfo($image['name'],PATHINFO_EXTENSION);
            $rname = 'IMG'.random_int(11111,99999).".jpeg";
            $img_path = UPLOAD_IMAGE_PATH.USERS_FOLDER.$rname;
            if($ext== 'png' || $ext == 'PNG'){
                $img = imagecreatefrompng($image['tmp_name']);
            }
            else if($ext== 'webp' || $ext == 'WEBP'){
                $img = imagecreatefromwebp($image['tmp_name']);
            }
            else{
                $img = imagecreatefromjpeg($image['tmp_name']);
            }
            if(imagejpeg($img,$img_path,75)){
                return $rname;
            }
            else{
                return 'upd_failed';
            }
        }
    }
?>