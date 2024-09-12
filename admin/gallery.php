<?php
require('inc/essentials.php');
adminLogin();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Gallery</title>
    <?php include 'inc/links.php'; ?>
</head>

<body class="bg-light">
    <?php include 'inc/header.php'; ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">GALLERY</h3>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">

                        <div class="text-end mb-3">
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#gallery">
                                <i class="bi bi-plus-square"></i>
                                Add
                            </button>
                        </div>

                        <div class="table-responsive-md" style="height: 650px; overflow-y: scroll;">
                            <table class="table table-hover border">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col" width="10%">#</th>
                                        <th scope="col" width="65%">Name</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="gallery-data">
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="gallery" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="gallery_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Gallery</h1>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="gallery_name" class="form-control shadow-none" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal for Adding Gallery Image -->
    <div class="modal fade" id="gallery-image" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Gallery Name</h5>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="image-alert"></div>
                    <div class="border-bottom border-3 pb-3 mb-3">
                        <form id="add_image_gal_form">
                            <label class="form-label">Add Image</label>
                            <input type="file" name="image" accept=".jpg, .png, .webp, .jpeg" class="form-control shadow-none mb-3">
                            <button class="btn btn-primary text-white shadow-none">ADD</button>
                            <input type="hidden" name="gallery_id">
                        </form>
                    </div>
                    <div class="table-responsive-lg" style="height: 350px; overflow-y: scroll;">
                        <table class="table table-hover border text-center">
                            <thead class="table-dark">
                                <tr class="sticky-top">
                                    <th scope="col" width="60%">Image</th>
                                    <th scope="col">Thumb</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody id="gallery-image-data">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Editing Gallery -->
    <div class="modal fade" id="edit-gallery" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="edit_gallery_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Gallery</h1>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="gallery_name" class="form-control shadow-none" required>
                            <input type="hidden" name="gallery_id">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


    <?php include 'inc/script.php'; ?>
    <script>
        let gallery_form = document.getElementById("gallery_form");

        gallery_form.addEventListener("submit", function(e) {
            e.preventDefault();
            add_gallery();
        });

        function add_gallery() {
            let data = new FormData();
            data.append("gallery_name", gallery_form.elements["gallery_name"].value);
            data.append("add_gallery", ""); // ระบุว่าต้องการเพิ่ม gallery

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/gallery.php", true);

            xhr.onload = function() {
                var myModal = document.getElementById("gallery");
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();

                if (this.responseText == 1) {
                    alert("success", "Gallery item added successfully!");
                    gallery_form.reset();
                    get_gallery();
                } else {
                    alert("error", "An unexpected error occurred.");
                }
            };
            xhr.send(data);
        }

        function get_gallery() {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/gallery.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function() {
                document.getElementById("gallery-data").innerHTML = this.responseText;
            };

            xhr.send("get_gallery");
        }

        let edit_gallery_form = document.getElementById("edit_gallery_form");

        edit_gallery_form.addEventListener("submit", function(e) {
            e.preventDefault();
            update_gallery();
        });

        function edit_gallery(id, name) {
            edit_gallery_form.elements["gallery_name"].value = name;
            edit_gallery_form.elements["gallery_id"].value = id;
        }

        function update_gallery() {
            let data = new FormData();
            data.append("gallery_id", edit_gallery_form.elements["gallery_id"].value);
            data.append("gallery_name", edit_gallery_form.elements["gallery_name"].value);
            data.append("edit_gallery", ""); // ระบุว่าต้องการแก้ไข gallery

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/gallery.php", true);

            xhr.onload = function() {
                var myModal = document.getElementById("edit-gallery");
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();

                if (this.responseText == 1) {
                    alert("success", "Gallery item updated successfully!");
                    edit_gallery_form.reset();
                    get_gallery();
                } else {
                    alert("error", "An unexpected error occurred.");
                }
            };
            xhr.send(data);
        }


        function rem_gallery(gallery_id) {
            if (confirm("Are you sure, you want to delete this gallery?")) {
                let data = new FormData();
                data.append("gallery_id", gallery_id);
                data.append("rem_gallery", "");

                let xhr = new XMLHttpRequest();
                xhr.open("POST", "ajax/gallery.php", true);

                xhr.onload = function() {
                    if (this.responseText == 1) {
                        alert("success", "Feature removed!");
                        get_gallery();
                    } else {
                        alert("error", "Server down!");
                    }
                };
                xhr.send(data);
            }
        }

        let add_image_gal_form = document.getElementById("add_image_gal_form");

        add_image_gal_form.addEventListener("submit", function(e) {
            e.preventDefault();
            add_gallery_image();
        });

        function add_gallery_image() {
            let data = new FormData();
            data.append("image", add_image_gal_form.elements["image"].files[0]);
            data.append("gallery_id", add_image_gal_form.elements["gallery_id"].value);
            data.append("add_gallery_image", "");

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/gallery.php", true);

            xhr.onload = function() {
                if (this.responseText == "inv_img") {
                    alert("error", "Only JPG and PNG images are allowed!", "image-alert");
                } else if (this.responseText == "inv_size") {
                    alert("error", "Image should be less than 2MB!", "image-alert");
                } else if (this.responseText == "upd_failed") {
                    alert("error", "Image upload failed. Server Down!", "image-alert");
                } else {
                    alert("success", "New Image added!", "image-alert");
                    gallery_images(
                        add_image_gal_form.elements["gallery_id"].value,
                        document.querySelector("#gallery-image .modal-title").innerText
                    );
                    add_image_gal_form.reset();
                }
            };
            xhr.send(data);
        }

        function gallery_images(id, gname) {
            document.querySelector("#gallery-image .modal-title").innerText = gname;
            add_image_gal_form.elements["gallery_id"].value = id;
            add_image_gal_form.elements["image"].value = "";

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/gallery.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function() {
                document.getElementById("gallery-image-data").innerHTML = this.responseText;
            };
            xhr.send("get_gallery_images=" + id);
        }

        function rem_image(img_id, gallery_id) {
            let data = new FormData();
            data.append("image_id", img_id);
            data.append("gallery_id", gallery_id);
            data.append("rem_image", "");

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/gallery.php", true);

            xhr.onload = function() {
                if (this.responseText == 1) {
                    alert("success", "Image Removed!", "image-alert");
                    gallery_images(
                        gallery_id,
                        document.querySelector("#gallery-image .modal-title").innerText
                    );
                } else {
                    alert("error", "Image removal failed!", "image-alert");
                }
            };
            xhr.send(data);
        }

        function thumb_image(img_id, gallery_id) {
            let data = new FormData();
            data.append("image_id", img_id);
            data.append("gallery_id", gallery_id);
            data.append("thumb_image", "");

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/gallery.php", true);

            xhr.onload = function() {
                if (this.responseText == 1) {
                    alert("success", "Image Thumbnail Changed!", "image-alert");
                    gallery_images(
                        gallery_id,
                        document.querySelector("#gallery-image .modal-title").innerText
                    );
                } else {
                    alert("error", "Thumbnail update failed!", "image-alert");
                }
            };
            xhr.send(data);
        }


        window.onload = function() {
            get_gallery();
        };
    </script>
</body>

</html>