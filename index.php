<?php


session_start();
require __DIR__ . '/models/DB.php';
require __DIR__ . '/controllers/userController.php';
$config = require(__DIR__ . '/config.php');

$db = new dbConnection($config); 
$conn = $db->getConnection(); 

$userid=$_SESSION["register_id"];
// Fetch user data
$profileModel = new UserController($conn);
$usersData = $profileModel->displayUsers();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Registered Users</title>
    <link rel="stylesheet" href="/assets/css/index.css">
    <!-- Include SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <a href="#" class="logo">
                <span class="logo-text">WedBliss</span>
            </a>
            <div class="menu">
                <input type="text" id="search-navbar" class="search-input" placeholder="Search...">
                <ul class="nav-links">
                    <li><a href="#" class="nav-link active">Home</a></li>
                    <li><a href="#" class="nav-link">About</a></li>
                    <?php if (!$userid): ?>
                        <li><a href="/register.php" class="nav-link">Register</a></li>
                        <li><a href="/login.php" class="nav-link">Login</a></li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a href="#" class="nav-link-profile-icon">
                                <img src="/uploads/profile_icon.jpg" alt="Profile Icon" style="width: 24px; height: 24px;">
                            </a>
                            <div class="dropdown-menu">
                                <a href="/profile.php" class="dropdown-item">Profile</a>
                                <a href="/logout.php" class="dropdown-item">Logout</a>
                            </div>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="slogan_container">
        <h1 class="matrimonial_slogan">Discover love, embrace the journey,<br>
            Together, we'll build your future.</h1>
    </div>

    <div class="users-container">
        <?php if (!empty($usersData)): ?>
            <?php foreach ($usersData as $user): ?>
                <div class="user-card">
                    <h2><?php echo htmlspecialchars($user['name']); ?></h2>
                    <p><strong>Age:</strong> <?php echo htmlspecialchars($user['age']); ?></p>
                    <p><strong>Religion:</strong> <?php echo htmlspecialchars($user['religion']); ?></p>
                    <p><strong>Mother Tongue:</strong> <?php echo htmlspecialchars($user['mother_tongue']); ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p></p>
        <?php endif; ?>
    </div>

    <!-- Include SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
</body>
</html>
