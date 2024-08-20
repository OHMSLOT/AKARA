<?php
require('inc/essentials.php');
adminLogin();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Events</title>
    <?php include 'inc/links.php'; ?>
</head>

<body class="bg-light">
    <?php include 'inc/header.php'; ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">UPCOMING EVENTS</h3>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">

                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Event</h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#event-s">
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
                                        <th scope="col">Time start</th>
                                        <th scope="col">Time end</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="event-data">
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Events Modal -->
    <div class="modal fade" id="event-s" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="event_s_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Events</h1>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Picture</label>
                            <input type="file" name="event_picture" class="form-control shadow-none">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="event_name" class="form-control shadow-none">
                        </div>
                        <div class="row mb-3">
                            <div class="col-6">
                                <label class="form-label">Time start</label>
                                <input type="time" name="event_time_s" class="form-control shadow-none">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Time end</label>
                                <input type="time" name="event_time_e" class="form-control shadow-none">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Date</label>
                            <input type="date" name="event_date" class="form-control shadow-none">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="event_desc" class="form-control shadow-none" rows="5"></textarea>
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
        let event_s_form = document.getElementById("event_s_form");

        event_s_form.addEventListener("submit", function(e) {
            e.preventDefault();
            add_event();
        });

        function add_event() {
            let data = new FormData();
            data.append("picture", event_s_form.elements["event_picture"].files[0]);
            data.append("name", event_s_form.elements["event_name"].value);
            data.append("time_s", event_s_form.elements["event_time_s"].value);
            data.append("time_e", event_s_form.elements["event_time_e"].value);
            data.append("date", event_s_form.elements["event_date"].value);
            data.append("desc", event_s_form.elements["event_desc"].value);
            data.append("add_event", "");

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/events_crud.php", true);

            xhr.onload = function() {
                var myModal = document.getElementById("event-s");
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
                    event_s_form.reset();
                    get_event();
                }
            };
            xhr.send(data);
        }

        function get_event() {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/events_crud.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function() {
                document.getElementById("event-data").innerHTML = this.responseText;
            };

            xhr.send("get_event");
        }

        function rem_event(val) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/events_crud.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function() {
                if (this.responseText == 1) {
                    alert("success", "Events removed!");
                    get_event();
                } else {
                    alert("error", "Server down!");
                }
            };

            xhr.send("rem_event=" + val);
        }

        window.onload = function() {
            get_event();
        };
    </script>
</body>

</html>