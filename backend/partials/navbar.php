<?php
$fullName = $_SESSION['full_name'] ?? 'Guest';
$roleName = $_SESSION['role_name'] ?? 'Gueslt';
?>

<!-- ========== MAIN HEADER ========== -->
<header class="main-header shadow-sm">
    <div class="d-flex align-items-center justify-content-between px-4 py-2 bg-white border-bottom">
        <div class="d-flex align-items-center gap-2">
            <button class="btn btn-sm btn-outline-secondary toggle-sidebar" id="sidebarToggle">
                <i class="fa fa-bars"></i>
            </button>
            <h5 class="fw-bold mb-0 text-secondary">Sistem Haji & Umroh</h5>
        </div>

        <div class="dropdown">
            <a href="#" class="d-flex align-items-center text-decoration-none" data-bs-toggle="dropdown">
                <img src="../../tp-ad/assets/img/person.svg"
                    alt="Profile"
                    class="rounded-circle me-2"
                    width="40" height="40">
                <div class="d-flex flex-column align-items-start">
                    <span class="fw-semibold text-dark"><?= htmlspecialchars($fullName); ?></span>
                    <small class="text-muted"><?= htmlspecialchars(ucfirst($roleName)); ?></small>
                </div>
                <i class="fa fa-caret-down ms-2 text-muted"></i>
            </a>

            <ul class="dropdown-menu dropdown-menu-end shadow-sm mt-2">
                <li class="text-center px-3 py-2 border-bottom">
                    <img src="../../tp-ad/assets/img/person.svg"
                        alt="Profile"
                        class="rounded-circle mb-2"
                        width="70" height="70">
                    <h6 class="fw-bold mb-0"><?= htmlspecialchars($fullName); ?></h6>
                    <small class="text-muted"><?= htmlspecialchars(ucfirst($roleName)); ?></small>
                </li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li>
                    <a href="../../actions/auth/logout.php" class="dropdown-item text-danger fw-semibold">
                        <i class="fa fa-sign-out-alt me-2"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </div>
</header>

<div class="main-panel">
    <div class="content-wrapper px-4 py-4">