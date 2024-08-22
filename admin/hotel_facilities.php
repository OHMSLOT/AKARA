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
                                        <th scope="col">Description</th>
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