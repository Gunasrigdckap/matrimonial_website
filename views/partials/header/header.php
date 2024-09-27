
<?php

session_start();
$userid = isset($_SESSION["register_id"]) ? $_SESSION["register_id"] : null;
?>
<nav class="navbar">
        <div class="container">
            <a href="/index.php" class="logo"><span class="logo-text">WedBliss</span></a>
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
                                <a href="/current-user-profile-listing.php" class="dropdown-item"> View Profile</a>
                                <!-- <a href="" class="dropdown-item"> Delete Profile</a> -->
                            <form method="POST" action="index.php">
                                <button type="submit" name="delete_profile" id="delete-profile"class="dropdown-item" 
                                onclick="return confirm('Are you sure you want to delete your profile? This action cannot be undone.');">
                                    Delete Profile
                                </button>
                           </form>
                                <a href="/logout.php" class="dropdown-item">Logout</a>
                            </div>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>
