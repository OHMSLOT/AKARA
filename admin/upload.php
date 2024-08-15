<?php
function alert($type, $msg)
{
    $bs_class = ($type == "success") ? "alert-success" : "alert-danger";

    echo <<<alert
        <div class="alert $bs_class alert-dismissible fade show custom-alert" role="alert">
            <strong class="me-3">$msg</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    alert;
}

// ตรวจสอบว่ามีการกดปุ่ม submit เพื่ออัปโหลดรูปภาพ
if (isset($_POST["submit"])) {
    // เชื่อมต่อฐานข้อมูล
    $conn = new mysqli("localhost", "root", "", "akara");

    // ตรวจสอบการเชื่อมต่อฐานข้อมูล
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // ตรวจสอบการอัปโหลดรูปภาพ
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $target_dir = "uploads/";
        $imageFileType = strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION));
        $target_file = uniqid() . '.' . $imageFileType;

        $allowed_types = array("jpg", "jpeg", "png", "gif");
        if (in_array($imageFileType, $allowed_types)) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_dir . $target_file)) {
                $sql = "INSERT INTO images (image_name) VALUES ('$target_file')";
                if ($conn->query($sql) === TRUE) {
                    alert('success', 'Image uploaded successfully!');
                } else {
                    alert('danger', 'Error: ' . $sql . '<br>' . $conn->error);
                }
            } else {
                alert('danger', 'Sorry, there was an error uploading your file.');
            }
        } else {
            alert('danger', 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed.');
        }
    } else {
        alert('danger', 'No file uploaded or there was an upload error.');
    }

    // ปิดการเชื่อมต่อฐานข้อมูล
    $conn->close();
}

// ตรวจสอบว่ามีการกดปุ่มลบรูปภาพ
if (isset($_GET['delete'])) {
    $conn = new mysqli("localhost", "root", "", "akara");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $image_id = $_GET['delete'];
    $sql = "SELECT image_name FROM images WHERE id = '$image_id'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    // ลบไฟล์ภาพจากเซิร์ฟเวอร์
    if (file_exists('uploads/' . $row['image_name'])) {
        unlink('uploads/' . $row['image_name']);
    }

    // ลบข้อมูลจากฐานข้อมูล
    $sql = "DELETE FROM images WHERE id = '$image_id'";
    if ($conn->query($sql) === TRUE) {
        alert('success', 'Image deleted successfully!');
    } else {
        alert('danger', 'Error: ' . $sql . '<br>' . $conn->error);
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Image</title>
    <?php include 'inc/links.php'; ?>
    <style>
        .image-container {
            position: relative;
        }

        .delete-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            border: 3px solid #fff;
            background-color: #6c757d;
            border-radius: 10px;
            color: #fff;
            padding: 4px 10px 4px 10px;
            font-size: 24px;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <?php include 'inc/header.php'; ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">GALLERY</h3>

                <!-- Carousel section -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Images</h5>
                            <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#uploadimage">
                                <i class="bi bi-pencil-square me-1"></i> Add
                            </button>
                        </div>
                        <div class="container-fluid">
                            <div class="row">
                                <!-- เริ่มดึงข้อมูลรูปภาพจากฐานข้อมูล -->
                                <?php
                                // เชื่อมต่อฐานข้อมูล
                                $conn = new mysqli("localhost", "root", "", "akara");

                                // ตรวจสอบการเชื่อมต่อฐานข้อมูล
                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }

                                // ดึงข้อมูลรูปภาพจากฐานข้อมูล
                                $sql = "SELECT id, image_name FROM images";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo '<div class="col-md-3 mb-3">';
                                        echo '<div class="card image-container">';
                                        echo '<img src="uploads/' . $row["image_name"] . '" class="card-img-top img-fluid" alt="Image">';
                                        echo '<a href="?delete=' . $row["id"] . '" onclick="return confirm(\'Are you sure you want to delete this image?\');"><i class="bi bi-trash delete-btn"></i></a>';
                                        echo '</div>';
                                        echo '</div>';
                                    }
                                } else {
                                    echo '<p>No images found</p>';
                                }

                                // ปิดการเชื่อมต่อฐานข้อมูล
                                $conn->close();
                                ?>
                            </div>
                        </div>  
                    </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="uploadimage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Add Image</h5>
                            </div>
                            <!-- ฟอร์มสำหรับอัปโหลดรูปภาพ -->
                            <form action="upload.php" method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <label class="form-label fw-bold">Picture</label>
                                    <input type="file" name="image" class="form-control shadow-none" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php include 'inc/script.php'; ?>

</body>

</html>