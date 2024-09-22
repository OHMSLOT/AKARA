<?php
require('inc/essentials.php');
adminLogin();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Hotel Facilities</title>
    <?php include 'inc/links.php'; ?>
</head>

<body class="bg-light">
    <?php include 'inc/header.php'; ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">Hotel Facilities</h3>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">

                        <div class="text-end mb-3">
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#hotel-facilities">
                                <i class="bi bi-plus-square"></i>
                                Add
                            </button>
                        </div>

                        <div class="table-responsive-md" style="height: 650px; overflow-y: scroll;">
                            <table class="table table-hover border">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Image</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Time open</th>
                                        <th scope="col">Time close</th>
                                        <th scope="col" width="30%">Description</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="hotel_facilities-data">
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="hotel-facilities" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="hotel_facilities_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Facilities</h1>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Picture</label>
                            <input type="file" name="hotel_facilities_picture" class="form-control shadow-none">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="hotel_facilities_name" class="form-control shadow-none">
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label class="form-label">Time open</label>
                                <input type="time" name="hotel_facilities_time_s" class="form-control shadow-none">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Time close</label>
                                <input type="time" name="hotel_facilities_time_e" class="form-control shadow-none">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="hotel_facilities_desc" class="form-control shadow-none" rows="5"></textarea>
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

    <!-- Edit Facility Info Modal -->
    <div class="modal fade" id="edit-facility-info" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="edit_facility_info_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Facility Info</h1>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="facility_id">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="facility_name" class="form-control shadow-none">
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label class="form-label">Time open</label>
                                <input type="time" name="facility_time_s" class="form-control shadow-none">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Time close</label>
                                <input type="time" name="facility_time_e" class="form-control shadow-none">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="facility_desc" class="form-control shadow-none" rows="5"></textarea>
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

    <!-- Edit Facility Image Modal -->
    <div class="modal fade" id="edit-facility-image" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="edit_facility_image_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Facility Image</h1>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3 text-center">
                            <img id="current_facility_image" src="" alt="Current Image" class="img-thumbnail" width="350px">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">New Image</label>
                            <input type="file" name="facility_image" class="form-control shadow-none">
                            <input type="hidden" name="facility_id">
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
        let hotel_facilities_form = document.getElementById("hotel_facilities_form");

        hotel_facilities_form.addEventListener("submit", function(e) {
            e.preventDefault();
            add_facility();
        });

        function add_facility() {
            let data = new FormData();
            data.append("picture", hotel_facilities_form.elements["hotel_facilities_picture"].files[0]);
            data.append("name", hotel_facilities_form.elements["hotel_facilities_name"].value);
            data.append("time_s", hotel_facilities_form.elements["hotel_facilities_time_s"].value);
            data.append("time_e", hotel_facilities_form.elements["hotel_facilities_time_e"].value);
            data.append("desc", hotel_facilities_form.elements["hotel_facilities_desc"].value);
            data.append("add_facility", "");

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/hotel_facilities.php", true);

            xhr.onload = function() {
                var myModal = document.getElementById("hotel-facilities");
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();

                if (this.responseText == "inv_img") {
                    alert("error", "Only JPG and PNG image are allowed!");
                } else if (this.responseText == "inv_size") {
                    alert("error", "Image should be less than 2MB!");
                } else if (this.responseText == "upd_failed") {
                    alert("error", "Image upload failed. Server Down!");
                } else {
                    alert("success", "New facilities added!");
                    hotel_facilities_form.reset();
                    get_facility();
                }
            };
            xhr.send(data);
        }

        function get_facility() {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/hotel_facilities.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function() {
                document.getElementById("hotel_facilities-data").innerHTML = this.responseText;
            };

            xhr.send("get_facility");
        }

        function edit_facility_info(id, name, time_s, time_e, desc) {
            let myModal = new bootstrap.Modal(document.getElementById('edit-facility-info'));
            document.getElementById('edit_facility_info_form').elements['facility_id'].value = id;
            document.getElementById('edit_facility_info_form').elements['facility_name'].value = name;
            document.getElementById('edit_facility_info_form').elements['facility_time_s'].value = time_s;
            document.getElementById('edit_facility_info_form').elements['facility_time_e'].value = time_e;
            document.getElementById('edit_facility_info_form').elements['facility_desc'].value = desc;
            myModal.show();
        }

        function edit_facility_image(id, currentImagePath) {
            let myModal = new bootstrap.Modal(document.getElementById('edit-facility-image'));
            document.getElementById('current_facility_image').src = currentImagePath;
            document.getElementById('edit_facility_image_form').elements['facility_id'].value = id;
            myModal.show();
        }

        let edit_facility_info_form = document.getElementById("edit_facility_info_form");
        let edit_facility_image_form = document.getElementById("edit_facility_image_form");

        edit_facility_info_form.addEventListener("submit", function(e) {
            e.preventDefault();
            update_facility_info();
        });

        edit_facility_image_form.addEventListener("submit", function(e) {
            e.preventDefault();
            update_facility_image();
        });

        function update_facility_info() {
            let data = new FormData();
            data.append("id", edit_facility_info_form.elements["facility_id"].value);
            data.append("name", edit_facility_info_form.elements["facility_name"].value);
            data.append("time_s", edit_facility_info_form.elements["facility_time_s"].value);
            data.append("time_e", edit_facility_info_form.elements["facility_time_e"].value);
            data.append("desc", edit_facility_info_form.elements["facility_desc"].value);
            data.append("update_facility_info", "");

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/hotel_facilities.php", true);

            xhr.onload = function() {
                var myModal = document.getElementById("edit-facility-info");
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();

                if (this.responseText == 1) {
                    alert("success", "Facility information updated!");
                    edit_facility_info_form.reset();
                    get_facility();
                } else {
                    alert("error", "Server down!");
                }
            };
            xhr.send(data);
        }

        function update_facility_image() {
            let data = new FormData();
            data.append("id", edit_facility_image_form.elements["facility_id"].value);
            data.append("image", edit_facility_image_form.elements["facility_image"].files[0]);
            data.append("update_facility_image", "");

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/hotel_facilities.php", true);

            xhr.onload = function() {
                var myModal = document.getElementById("edit-facility-image");
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();

                if (this.responseText == "inv_img") {
                    alert("error", "Only JPG and PNG image are allowed!");
                } else if (this.responseText == "inv_size") {
                    alert("error", "Image should be less than 2MB!");
                } else if (this.responseText == "upd_failed") {
                    alert("error", "Image upload failed. Server Down!");
                } else {
                    alert("success", "Facility image updated!");
                    edit_facility_image_form.reset();
                    get_facility();
                }
            };
            xhr.send(data);
        }


        function rem_facility(val) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/hotel_facilities.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function() {
                if (this.responseText == 1) {
                    alert("success", "Events removed!");
                    get_facility();
                } else {
                    alert("error", "Server down!");
                }
            };

            xhr.send("rem_facility=" + val);
        }

        window.onload = function() {
            get_facility();
        };
    </script>
</body>

</html>