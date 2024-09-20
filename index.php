<?php
session_start();
require __DIR__ . '/models/DB.php';
require __DIR__ . '/controllers/userController.php';
$config = require(__DIR__ . '/config.php');

// Initialize database and controller
$db = new dbConnection($config); 
$conn = $db->getConnection(); 

$userid = isset($_SESSION["register_id"]) ? $_SESSION["register_id"] : null;

// Fetch user data based on filter inputs
$filters = [
    'gender' => $_POST['gender'] ?? null,
    'age_min' => $_POST['age_min'] ?? null,
    'age_max' => $_POST['age_max'] ?? null,
    'religion' => $_POST['religion'] ?? null,
    'caste' => $_POST['caste'] ?? null,
];

// If the reset button is clicked, clear the filters
if (isset($_POST['reset'])) {
    $filters = []; // Clear all filters when reset is clicked
}

// Fetch filtered users data
$profileModel = new UserController($conn);
$usersData = $profileModel->displayUsers($filters);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Registered Users</title>
    <link rel="stylesheet" href="/assets/css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="container">
            <a href="#" class="logo"><span class="logo-text">WedBliss</span></a>
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
                                <a href="/current-user-profile-listing.php" class="dropdown-item">Profile</a>
                                <a href="/logout.php" class="dropdown-item">Logout</a>
                            </div>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Section -->
    <div class="main-container">
        <div class="slogan_container">
            <h1 class="matrimonial_slogan">Discover love, embrace the journey,<br> Together, we'll build your future.</h1>
        </div>
    </div>

    <!-- Users and Filters Section -->
    <div class="users-container-main">
        <?php if ($userid): // Show the filter only if the user is registered/logged in ?>
        <div class="filter-container">
            <h2>Filter Users</h2>
            <form id="filter-form" method="POST" action="index.php">
                <!-- Gender Filter -->
                <div class="filter-group">
                    <h3>Gender</h3>
                    <label><input type="radio" name="gender" value="male"> Male</label><br>
                    <label><input type="radio" name="gender" value="female"> Female</label><br>
                    <label><input type="radio" name="gender" value="other"> Other</label>
                </div>

                <!-- Age Filter -->
                <div class="filter-group">
                    <h3>Age</h3>
                    <label for="age-min">Min Age: </label>
                    <input type="number" id="age-min" name="age_min" min="18" max="100" value="18"><br>
                    <label for="age-max">Max Age: </label>
                    <input type="number" id="age-max" name="age_max" min="18" max="100" value="60">
                </div>

                <!-- Religion Filter -->
                <div class="filter-group">
                    <h3>Religion</h3>
                    <select name="religion" id="religion">
                        <option value="">Any</option>
                        <option value="hindu">Hindu</option>
                        <option value="muslim">Muslim</option>
                        <option value="christian">Christian</option>
                        <option value="sikh">Sikh</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <!-- Caste Filter -->
                <div class="filter-group">
                    <h3>Caste</h3>
                    <select name="caste" id="caste">
                        <option value="">Any</option>
                        <option value="brahmin">Brahmin</option>
                        <option value="rajput">Rajput</option>
                        <option value="vaishya">Vaishya</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <button type="submit" class="btn-primary">Apply Filters</button>
                <button type="submit" name = "reset" id="reset-btn">Reset <i class="fa-solid fa-arrow-rotate-right"></i></button>

            </form>
        </div>
        <?php endif; ?>

        <!-- Display Users -->
        <div class="users-container">
            <?php if (!empty($usersData)): ?>
                <?php foreach ($usersData as $user): ?>
                    <div class="user-card">
                        <div class="image-container">
                            <img src="<?php echo htmlspecialchars($user['profile_photo']); ?>" alt="Profile Photo" class="profile-photo">
                        </div>
                        <div class="user-details">
                            <h2><?php echo htmlspecialchars($user['name']); ?></h2>
                            <p><strong>Age:</strong> <?php echo htmlspecialchars($user['age']); ?></p>
                            <p><strong>Religion:</strong> <?php echo htmlspecialchars($user['religion']); ?></p>
                            <p><strong>Mother Tongue:</strong> <?php echo htmlspecialchars($user['mother_tongue']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No users found</p>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
</body>
</html>
