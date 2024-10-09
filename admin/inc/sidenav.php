<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="dashboard.php">
                    <div class="sb-nav-link-icon"><i class="bi bi-speedometer2"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Interface</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="bi bi-layout-text-window-reverse"></i></div>
                    Layouts
                    <div class="sb-sidenav-collapse-arrow"><i class="bi bi-chevron-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="gallery.php">Gallery</a>
                        <a class="nav-link" href="carousel.php">Welcome</a>
                        <a class="nav-link" href="event.php">Events</a>
                        <a class="nav-link" href="hotel_facilities.php">Hotel Facilities</a>
                        <a class="nav-link" href="settings.php">Setting</a>
                    </nav>
                </div>

                <!-- ROOMS -->
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="bi bi-house"></i></div>
                    Rooms
                    <div class="sb-sidenav-collapse-arrow"><i class="bi bi-chevron-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="rooms.php">Rooms</a>
                        <a class="nav-link" href="features_facilities.php">Features & Facilities</a>
                    </nav>
                </div>
                <div class="sb-sidenav-menu-heading">USER</div>
                <a class="nav-link" href="user.php">
                    <div class="sb-nav-link-icon"><i class="bi bi-person-fill"></i></div>
                    Users
                </a>
                <a class="nav-link" href="user_queries.php">
                    <div class="sb-nav-link-icon"><i class="bi bi-chat-square-dots"></i></div>
                    User Queries
                </a>

                <!-- BOOKINGS -->
                <div class="sb-sidenav-menu-heading">BOOKING</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePagesBooking" aria-expanded="false" aria-controls="collapsePagesBooking">
                    <div class="sb-nav-link-icon"><i class="bi bi-house"></i></div>
                    BOOKING
                    <div class="sb-sidenav-collapse-arrow"><i class="bi bi-chevron-down"></i></div>
                </a>
                <div class="collapse" id="collapsePagesBooking" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="booking_management.php">New Booking</a>
                        <a class="nav-link" href="refund_booking.php">Refund Booking</a>
                        <a class="nav-link" href="records_booking.php">Records Booking</a>
                    </nav>
                </div>
            </div>
        </div>
        <!-- <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            Start Bootstrap
        </div> -->
    </nav>
</div>