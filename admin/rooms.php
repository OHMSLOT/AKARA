<?php
require('inc/essentials.php');
require('inc/db_config.php');
adminLogin();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Rooms</title>
    <?php include 'inc/links.php'; ?>
</head>

<body class="bg-light">

    <?php include 'inc/header.php'; ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
                <h3 class="mb-4">Rooms</h3>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">

                        <div class="text-end mb-3">
                            <button type="button" class="btn btn-dark shadow-none btn-sm" data-bs-toggle="modal" data-bs-target="#add-room">
                                <i class="bi bi-plus-square"></i>
                                Add
                            </button>
                        </div>

                        <div class="table-responsive-lg" style="height: 450px; overflow-y: scroll;">
                            <table class="table table-hover border text-center">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Area</th>
                                        <th scope="col">Guests</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="room-data">
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add room Modal -->
    <div class="modal fade" id="add-room" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="add_room_form" autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Add Room</h1>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="room_name" class="form-control shadow-none">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Area</label>
                                <input type="number" min="1" name="room_area" class="form-control shadow-none">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Price</label>
                                <input type="number" min="1" name="room_price" class="form-control shadow-none">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Quantity</label>
                                <input type="number" min="1" name="room_quantity" class="form-control shadow-none">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Adult (Max.)</label>
                                <input type="number" min="1" name="room_adult" class="form-control shadow-none">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Children (Max.)</label>
                                <input type="number" min="1" name="room_children" class="form-control shadow-none">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Features</label>
                                <div class="row">
                                    <?php
                                    $res = selectAll('features');
                                    while ($opt = mysqli_fetch_assoc($res)) {
                                        echo "
                                                <div class='col-md-3 mb-1'>
                                                    <label>
                                                        <input type='checkbox' name='features' value='$opt[id]' class='form-check-input shadow-none'>
                                                        $opt[name]
                                                    </label>
                                                </div>
                                            ";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Facilities</label>
                                <div class="row">
                                    <?php
                                    $res = selectAll('facilities');
                                    while ($opt = mysqli_fetch_assoc($res)) {
                                        echo "
                                                <div class='col-md-3 mb-1'>
                                                    <label>
                                                        <input type='checkbox' name='facilities' value='$opt[id]' class='form-check-input shadow-none'>
                                                        $opt[name]
                                                    </label>
                                                </div>
                                            ";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Description</label>
                                <textarea name="room_desc" rows="5" class="form-control shadow-none" required></textarea>
                            </div>
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

    <!-- Edit room Modal -->
    <div class="modal fade" id="edit-room" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="edit_room_form" autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Edit Room</h1>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Name</label>
                                <input type="text" name="room_name" class="form-control shadow-none">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Area</label>
                                <input type="number" min="1" name="room_area" class="form-control shadow-none">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Price</label>
                                <input type="number" min="1" name="room_price" class="form-control shadow-none">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Quantity</label>
                                <input type="number" min="1" name="room_quantity" class="form-control shadow-none">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Adult (Max.)</label>
                                <input type="number" min="1" name="room_adult" class="form-control shadow-none">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Children (Max.)</label>
                                <input type="number" min="1" name="room_children" class="form-control shadow-none">
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Features</label>
                                <div class="row">
                                    <?php
                                    $res = selectAll('features');
                                    while ($opt = mysqli_fetch_assoc($res)) {
                                        echo "
                                                <div class='col-md-3 mb-1'>
                                                    <label>
                                                        <input type='checkbox' name='features' value='$opt[id]' class='form-check-input shadow-none'>
                                                        $opt[name]
                                                    </label>
                                                </div>
                                            ";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Facilities</label>
                                <div class="row">
                                    <?php
                                    $res = selectAll('facilities');
                                    while ($opt = mysqli_fetch_assoc($res)) {
                                        echo "
                                                <div class='col-md-3 mb-1'>
                                                    <label>
                                                        <input type='checkbox' name='facilities' value='$opt[id]' class='form-check-input shadow-none'>
                                                        $opt[name]
                                                    </label>
                                                </div>
                                            ";
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-bold">Description</label>
                                <textarea name="room_desc" rows="5" class="form-control shadow-none" required></textarea>
                            </div>
                            <input type="hidden" name="room_id">
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
        let add_room_form = document.getElementById('add_room_form');

        add_room_form.addEventListener('submit', function(e) {
            e.preventDefault();
            add_room();
        })

        function add_room() {
            let data = new FormData();
            data.append('add_room', '');
            data.append('name', add_room_form.elements['room_name'].value);
            data.append('area', add_room_form.elements['room_area'].value);
            data.append('price', add_room_form.elements['room_price'].value);
            data.append('quantity', add_room_form.elements['room_quantity'].value);
            data.append('adult', add_room_form.elements['room_adult'].value);
            data.append('children', add_room_form.elements['room_children'].value);
            data.append('desc', add_room_form.elements['room_desc'].value);
            
            let features = [];
            add_room_form.elements['features'].forEach(el =>{
                if(el.checked){
                    features.push(el.value);
                }
            });

            let facilities = [];
            add_room_form.elements['facilities'].forEach(el =>{
                if(el.checked){
                    facilities.push(el.value);
                }
            });

            data.append('features',JSON.stringify(features));
            data.append('facilities',JSON.stringify(facilities));

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms.php", true);

            xhr.onload = function() {
                var myModal = document.getElementById("add-room");
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();

                if (this.responseText == 1) {
                    alert("success", "New room added!");
                    add_room_form.reset();
                    get_all_rooms();
                } else {
                    alert("error", "Server down!");
                }
            };
            xhr.send(data);
        }

        function get_all_rooms(){
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");


            xhr.onload = function() {
                document.getElementById('room-data').innerHTML = this.responseText;
            };
            xhr.send('get_all_rooms');
        }

        function toggle_status(id,val){
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");


            xhr.onload = function() {
                if(this.responseText==1){
                    alert('success','Status toggled!')
                    get_all_rooms();
                }
                else{
                    alert('error','Server down!')
                }
            };
            xhr.send('toggle_status='+id+'&value='+val);
        }

        let edit_room_form = document.getElementById('edit_room_form');


        function edit_details(id){
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            xhr.onload = function() {
                let data = JSON.parse(this.responseText);

                edit_room_form.elements['room_name'].value = data.roomdata.name; 
                edit_room_form.elements['room_area'].value = data.roomdata.area; 
                edit_room_form.elements['room_price'].value = data.roomdata.price; 
                edit_room_form.elements['room_quantity'].value = data.roomdata.quantity; 
                edit_room_form.elements['room_adult'].value = data.roomdata.adult; 
                edit_room_form.elements['room_children'].value = data.roomdata.children; 
                edit_room_form.elements['room_desc'].value = data.roomdata.description; 
                edit_room_form.elements['room_id'].value = data.roomdata.id; 
                
                edit_room_form.elements['features'].forEach(el =>{
                    if(data.features.includes(Number(el.value))){
                        el.checked = true;      
                    }
                });

                edit_room_form.elements['facilities'].forEach(el =>{
                if(data.facilities.includes(Number(el.value))){
                    el.checked = true;      
                }
                });
            }
            xhr.send('get_room='+id);
        }

        edit_room_form.addEventListener('submit', function(e) {
            e.preventDefault();
            submit_edit_room();
        })

        function submit_edit_room() {
            let data = new FormData();
            data.append('edit_room', '');
            data.append('room_id',edit_room_form.elements['room_id'].value);
            data.append('name', edit_room_form.elements['room_name'].value);
            data.append('area', edit_room_form.elements['room_area'].value);
            data.append('price', edit_room_form.elements['room_price'].value);
            data.append('quantity', edit_room_form.elements['room_quantity'].value);
            data.append('adult', edit_room_form.elements['room_adult'].value);
            data.append('children', edit_room_form.elements['room_children'].value);
            data.append('desc', edit_room_form.elements['room_desc'].value);
            
            let features = [];
            edit_room_form.elements['features'].forEach(el =>{
                if(el.checked){
                    features.push(el.value);
                }
            });

            let facilities = [];
            edit_room_form.elements['facilities'].forEach(el =>{
                if(el.checked){
                    facilities.push(el.value);
                }
            });

            data.append('features',JSON.stringify(features));
            data.append('facilities',JSON.stringify(facilities));

            let xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/rooms.php", true);

            xhr.onload = function() {
                var myModal = document.getElementById("edit-room");
                var modal = bootstrap.Modal.getInstance(myModal);
                modal.hide();

                if (this.responseText == 1) {
                    alert("success", "Edit room success!");
                    edit_room_form.reset();
                    get_all_rooms();
                } else {
                    alert("error", "Server down!");
                }
            };
            xhr.send(data);
        }

        window.onload = function(){
            get_all_rooms();
        }
    </script>

</body>

</html>