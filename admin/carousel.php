<?php
require('inc/essentials.php');
adminLogin();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Welcome</title>
    <?php include 'inc/links.php'; ?>
</head>

<body class="bg-light">
    <?php include 'inc/header.php'; ?>
    <div id="layoutSidenav">
        <!-- side navbar -->
        <?php include_once "inc/sidenav.php"; ?>
        <!-- main content -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid" id="main-content">
                    <div class="row">
                        <div class="col-lg-12 ms-auto p-4 overflow-hidden">
                            <h3 class="mb-4">CAROUSEL</h3>

                            <!-- Carousel section -->
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-body">
                                    <div class="d-flex align-items-center justify-content-between mb-3">
                                        <h5 class="card-title m-0">Images</h5>
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#carousel-s">
                                            <i class="bi bi-pencil-square me-1"></i> Add
                                        </button>
                                    </div>
                                    <div class="row" id="carousel-data">

                                    </div>
                                </div>
                            </div>

                            <!-- modal -->
                            <div class="modal fade" id="carousel-s" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <form id="carousel_s_form">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Add Image</h5>
                                            </div>
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold" for="carousel_picture_inp">Picture</label>
                                                    <input type="file" name="carousel_picture" id="carousel_picture_inp" class="form-control shadow-none" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" onclick="carousel_picture.value = ''" class="btn btn-secondary shadow-none" data-bs-dismiss="modal">CANCEL</button>
                                                <button type="submit" class="btn btn-primary shadow-none text-light">SAVE</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>


    <?php include 'inc/script.php'; ?>
    <script src="scripts/carousel.js"></script>

</body>

</html>