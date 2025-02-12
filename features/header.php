<?php
include '../helpers/authenticated.php';
$username = $_SESSION['username'] ?? 'Guest';
$profileImage = '../assets/default-profile.avif';
?>

<nav class="navbar navbar-expand-lg navbar-dark px-3">
    <div class="container-fluid">
        <div class="dropdown ms-auto">
            <button class="btn btn-dark dropdown-toggle d-flex align-items-center" type="button" id="userDropdown"
                data-bs-toggle="dropdown" aria-expanded="false">
                <img src="<?= htmlspecialchars($profileImage); ?>" alt="Profile" class="rounded-circle me-2" width="40"
                    height="40">
                <span class="text-white"><?= htmlspecialchars($username); ?></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                <li>
                        <a class="dropdown-item text-danger text-center" href="../actions/logout_action.php">
                            Logout <i class="bi bi-box-arrow-right"></i>
                        </a>
                </li>
            </ul>
        </div>
    </div>
</nav>