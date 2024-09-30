<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <?php require('inc/links.php'); ?>
</head>

<body>
    <?php require('inc/header.php');

    if (!isset($_SESSION['login']) && $_SESSION['login'] == true) {
        redirect('index.php');
    }

    $u_exist = select("SELECT * FROM `users` WHERE `id`=? LIMIT 1", [$_SESSION['uId']], 's');

    if (mysqli_num_rows($u_exist) == 0) {
        redirect('index.php');
    }

    $u_fetch = mysqli_fetch_assoc($u_exist);

    $path = USERS_IMG_PATH . $u_fetch['picture'];
    ?>

    <div class="container">
        <div class="row">
            <h1 class="fw-semibold mt-5">My Profile</h1>
            <div class="mb-5" style="font-size: 14px;">
                <a href="index.php" class="text-secondary text-decoration-none">HOME</a>
                <span class="text-secondary"> > </span>
                <a href="#" class="text-secondary text-decoration-none">PROFILE</a>
            </div>
            <div class="col-lg-3 offset-lg-0 offset-md-4 col-md-12 offset-sm-2 col-sm-12  mb-3">
                <div class="row">
                    <div class="d-flex mt-2">
                        <img src="<?php echo $path; ?>" class="image-fluid" style="width: 250px; height: 250px; object-fit: cover; border-radius: 100%;" alt="">
                        <div class="d-flex align-items-start">
                            <button type="button" class="btn btn-outline-secondary btn-mb shadow-none" data-bs-toggle="modal" data-bs-target="#editProfilePictureModal">
                                <i class="bi bi-pencil ms-1"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="card mb-4">
                    <div class="card-body">
                        <form action="profile.php" method="POST">
                            <div class="row">
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h3 class="m-0">Personal Infomation</h3>
                                    <button type="button" class="btn btn-outline-secondary btn-mb shadow-none" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                                        Edit<i class="bi bi-pencil ms-1"></i>
                                    </button>
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label for="firstname" class="form-label">Username</label>
                                    <input type="text" class="form-control" value="<?php echo $u_fetch['name']; ?>" disabled required>
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="tel" class="form-control" value="<?php echo $u_fetch['phone']; ?>" disabled required>
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label for="phone" class="form-label">Date of birth</label>
                                    <input type="tel" class="form-control" value="<?php echo $u_fetch['date_of_birth']; ?>" disabled required>
                                </div>
                                <div class="col-lg-8 mb-3">
                                    <label for="phone" class="form-label">Address</label>
                                    <input type="text" class="form-control" value="<?php echo $u_fetch['address']; ?>" disabled required>
                                </div>
                                <div class="col-lg-4 mb-3">
                                    <label for="phone" class="form-label">Pincode</label>
                                    <input type="tel" class="form-control" value="<?php echo $u_fetch['pincode']; ?>" disabled required>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal สำหรับแก้ไขข้อมูล -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo $u_fetch['name']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="number" class="form-control" id="phone" name="phone" value="<?php echo $u_fetch['phone']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="dob" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $u_fetch['date_of_birth']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="<?php echo $u_fetch['address']; ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="pincode" class="form-label">Pincode</label>
                            <input type="text" class="form-control" id="pincode" name="pincode" value="<?php echo $u_fetch['pincode']; ?>" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="updateProfileBtn">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal สำหรับแก้ไขรูปโปรไฟล์ -->
    <div class="modal fade" id="editProfilePictureModal" tabindex="-1" aria-labelledby="editProfilePictureModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProfilePictureModalLabel">Update Profile Picture</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="updateProfilePictureForm" enctype="multipart/form-data">
                    <div class="modal-body">
                        <!-- รูปโปรไฟล์ปัจจุบัน -->
                        <div class="mb-3 text-center">
                            <label class="form-label">Current Profile Picture</label><br>
                            <img src="<?php echo USERS_IMG_PATH . $_SESSION['uPic']; ?>" class="rounded-circle" style="width: 150px; height: 150px; object-fit: cover;" alt="Current Profile Picture">
                        </div>
                        <!-- ฟิลด์สำหรับเลือกรูปใหม่ -->
                        <div class="mb-3">
                            <label for="profile_picture" class="form-label">Choose new profile picture</label>
                            <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <?php require('inc/footer.php'); ?>
</body>
<script>
    // เมื่อคลิกปุ่มบันทึกใน Modal
    document.getElementById('updateProfileBtn').addEventListener('click', function(e) {
        e.preventDefault(); // ป้องกันการรีเฟรชหน้า

        // เก็บค่าจากฟอร์ม
        var name = document.getElementById('name').value;
        var phone = document.getElementById('phone').value;
        var dob = document.getElementById('dob').value;
        var address = document.getElementById('address').value;
        var pincode = document.getElementById('pincode').value;

        // AJAX Request เพื่อส่งข้อมูลไปยังเซิร์ฟเวอร์
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'ajax/update_profile.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        xhr.onload = function() {
            if (this.status == 200) {
                var response = JSON.parse(this.responseText);
                if (response.success) {
                    // อัปเดตข้อมูลสำเร็จ
                    alert("success", "Profile updated successfully!");
                    // รีเฟรชหน้าเมื่อทำการอัปเดตสำเร็จ
                    window.location.reload();
                } else {
                    // เกิดข้อผิดพลาด
                    alert("Error updating profile: " + response.message);
                }
            }
        };

        // ส่งข้อมูลไปยัง PHP ผ่าน POST request
        xhr.send("name=" + name + "&phone=" + phone + "&dob=" + dob + "&address=" + address + "&pincode=" + pincode);
    });

    // เมื่อส่งฟอร์มเพื่ออัปโหลดรูปภาพ
    document.getElementById('updateProfilePictureForm').addEventListener('submit', function(e) {
        e.preventDefault(); // ป้องกันการรีเฟรชหน้า

        // เก็บข้อมูลจากฟอร์ม
        var formData = new FormData(this);

        // AJAX Request เพื่อส่งข้อมูลไปยังเซิร์ฟเวอร์
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'ajax/update_profile_picture.php', true);

        xhr.onload = function() {
            if (this.status == 200) {
                var response = JSON.parse(this.responseText);
                if (response.success) {
                    // รูปภาพถูกอัปเดตสำเร็จ
                    alert("Profile picture updated successfully!");
                    // รีเฟรชหน้าเมื่อทำการอัปเดตสำเร็จ
                    window.location.reload();
                } else {
                    // เกิดข้อผิดพลาด
                    alert("Error updating profile picture: " + response.message);
                }
            }
        };

        // ส่งข้อมูลไปยัง PHP ผ่าน POST request
        xhr.send(formData);
    });
</script>

</html>