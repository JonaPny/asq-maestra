<?php
// Get current page for active menu highlighting
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!-- Sidebar -->
<div class="col-md-2 sidebar">
    <div class="sidebar-header text-center py-3">
        <div class="admin-icon">
            <i class="bi bi-person-circle fs-1 text-white"></i>
        </div>
        <h5 class="text-white mt-2">Admin</h5>
    </div>

    <div class="sidebar-menu">
        <h6 class="menu-header">Main Menu</h6>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?php echo ($current_page == 'dashboard.php') ? 'active' : ''; ?>" href="dashboard.php">
                    CUSTOMER APPOINTMENT CALENDAR
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($current_page == 'appointments.php') ? 'active' : ''; ?>" href="appointments.php">
                    CUSTOMER BOOKINGS
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($current_page == 'queue.php') ? 'active' : ''; ?>" href="queue.php">
                    QUEUE MANAGER
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?php echo ($current_page == 'services.php') ? 'active' : ''; ?>" href="services.php">
                    SERVICES MANAGER
                </a>
            </li>
        </ul>

        <div class="logout-container">
            <a href="logout.php" class="btn btn-logout">LOG OUT</a>
        </div>
    </div>
</div>
