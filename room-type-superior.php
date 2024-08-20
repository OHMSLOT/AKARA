<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require('inc/links.php') ?>
    <style>
        .image {
            display: block;
            width: 100%;
            object-fit: cover;
            height: 320px;
        }
    </style>
</head>

<body>
    <?php require('inc/header.php') ?>

    <div class="container my-5 px-4">
        <h1 class="fw-semibold c-font fs-48">Superior</h1>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-9 mb-4">
                <img style="height: 100%;" class="image-fluid image" src="src/LINE_ALBUM_Superior room Thai Akara_240716_1.jpg" alt="">
            </div>
            <div class="col-lg-3 mb-4">
                <div class="card">
                    <div class="card-body">
                        <form>
                            <div class="mb-3">
                                <label class="form-label">Email address</label>
                                <input type="text" class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Person</label>
                                <input type="number" class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Check-in</label>
                                <input type="date" class="form-control" id="exampleInputEmail1">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Check-in</label>
                                <input type="date" class="form-control" id="exampleInputEmail1">
                            </div>
        
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require('inc/modal-login.php') ?>
    <?php require('inc/modal-register.php') ?>
    <?php require('inc/footer.php') ?>
</body>
<?php require('inc/script.php') ?>

</html>