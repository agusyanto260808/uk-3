<?php
// Pastikan role terset
$role = $_SESSION['full_name'] ?? '';

// Dapatkan nama halaman saat ini dari URL
$current_page = basename($_SERVER['PHP_SELF']);
$current_dir = basename(dirname($_SERVER['PHP_SELF']));
?>

<div class="sidebar" data-background-color="dark">
    <div class="sidebar-logo">
        <div class="logo-header" data-background-color="dark">
            <!-- <a href="../dashboard/index.php" class="logo">
                <img src="../../tp-ad/assets/img/kaiadmin/logo_light.svg"
                    alt="navbar brand"
                    class="navbar-brand"
                    height="20" /> -->
            </a>
            <div class="nav-toggle">
                <button class="btn btn-toggle toggle-sidebar">
                    <i class="gg-menu-right"></i>
                </button>
                <button class="btn btn-toggle sidenav-toggler">
                    <i class="gg-menu-left"></i>
                </button>
            </div>
            <button class="topbar-toggler more">
                <i class="gg-more-vertical-alt"></i>
            </button>
        </div>
    </div>

    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">

                <!-- Dashboard -->
                <li class="nav-item <?php echo ($current_dir == 'dashbord') ? 'active' : ''; ?>">
                    <a href="../dashbord/index.php">
                        <i class="fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Data Jamaah -->
                <?php if ($role === 'agus' || $role === 'budi') { ?>
                    <li class="nav-item <?php echo ($current_dir == 'data jamaah') ? 'active' : ''; ?>">
                        <a href="../data jamaah/index.php">
                            <i class="fas fa-users"></i>
                            <p>Data Jamaah</p>
                        </a>
                    </li>
                <?php } ?>

                <!-- Data Paket -->
                <?php if ($role === 'agus' || $role === 'budi') { ?>
                    <li class="nav-item <?php echo ($current_dir == 'data paket') ? 'active' : ''; ?>">
                        <a href="../data paket/index.php">
                            <i class="fas fa-box"></i>
                            <p>Data Paket</p>
                        </a>
                    </li>
                <?php } ?>

                <!-- Data Pembayaran -->
                <?php if ($role === 'agus' || $role === 'budi') { ?>
                    <li class="nav-item <?php echo ($current_dir == 'data pembayaran') ? 'active' : ''; ?>">
                        <a href="../data pembayaran/index.php">
                            <i class="fas fa-credit-card"></i>
                            <p>Data Pembayaran</p>
                        </a>
                    </li>
                <?php } ?>

                <!-- Pendaftaran (❌ hanya budi) -->
                <?php if ($role === 'budi') { ?>
                    <li class="nav-item <?php echo ($current_dir == 'pendaftaran') ? 'active' : ''; ?>">
                        <a href="../pendaftaran/index.php">
                            <i class="fas fa-file-signature"></i>
                            <p>Pendaftaran</p>
                        </a>
                    </li>
                <?php } ?>

                <!-- Data Keberangkatan -->
                <?php if ($role === 'agus' || $role === 'budi') { ?>
                    <li class="nav-item <?php echo ($current_dir == 'data berangkat') ? 'active' : ''; ?>">
                        <a href="../data berangkat/index.php">
                            <i class="fas fa-plane-departure"></i>
                            <p>Data Keberangkatan</p>
                        </a>
                    </li>
                <?php } ?>

                <!-- User Activity (📜 hanya Admin) -->
                <?php if ($role === 'agus') { ?>
                    <li class="nav-item <?php echo ($current_dir == 'user_activity') ? 'active' : ''; ?>">
                        <a href="../user_activity/index.php">
                            <i class="fas fa-user-clock"></i>
                            <p>Aktivitas Pengguna</p>
                        </a>
                    </li>
                <?php } ?>

                <!-- Users (👤 hanya Admin) -->
                <?php if ($role === 'agus') { ?>
                    <li class="nav-item <?php echo ($current_dir == 'user') ? 'active' : ''; ?>">
                        <a href="../user/index.php">
                            <i class="fas fa-user"></i>
                            <p>Users</p>
                        </a>
                    </li>
                <?php } ?>

            </ul>
        </div>
    </div>
</div>