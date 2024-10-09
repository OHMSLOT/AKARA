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
    <title>Admin Panel - Users</title>
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
                            <h3 class="mb-4">Users</h3>

                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-body">

                                    <div class="text-end mb-3">
                                        <input type="text" id="search_input" class="form-control shadow-none w-25 ms-auto" placeholder="Search by name or email" onkeyup="search_user(this.value)">
                                    </div>

                                    <div class="table-responsive-lg">
                                        <table class="table table-hover border text-center">
                                            <thead class="table-dark">
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Phone</th>
                                                    <th scope="col" width="30%">Address</th>
                                                    <th scope="col">DOB</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="users-data">
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>


    <?php require('inc/script.php'); ?>

    <script src="scripts/users.js"></script>

</body>

</html>