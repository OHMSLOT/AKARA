<!-- Modal -->
<div class="modal fade" id="registerModal" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="register.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h1 class="modal-title fs-2 fw-bold d-flex align-items-center">Register</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <span class="badge rounded-pill text-bg-light mb-3 text-wrap lh-base">
                        Note: Your details must match with your ID (ID card, passport, driving license, etc.) that will be required during check-in.
                    </span>
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 mb-3 ps-0">
                                <label class="form-label">Name</label>
                                <input type="text" name="name" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3 p-0">
                                <label class="form-label">Email</label>
                                <input type="email" name="email" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3 ps-0">
                                <label class="form-label">Phone Number</label>
                                <input type="text" name="phone" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3 p-0">
                                <label class="form-label">Picture</label>
                                <input type="file" name="picture" class="form-control shadow-none">
                            </div>
                            <div class="col-md-12 mb-3 p-0">
                                <label class="form-label">Address</label>
                                <textarea name="address" class="form-control shadow-none" rows="1" required></textarea>
                            </div>
                            <div class="col-md-6 mb-3 ps-0">
                                <label class="form-label">Pincode</label>
                                <input type="text" name="pincode" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3 p-0">
                                <label class="form-label">Date of birth</label>
                                <input type="date" name="dob" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3 ps-0">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3 p-0">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" class="form-control shadow-none" required>
                            </div>
                        </div>
                    </div>
                    <div class="text-center my-2">
                        <button type="submit" class="btn btn-md custom-bg text-white shadow-none">REGISTER</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>