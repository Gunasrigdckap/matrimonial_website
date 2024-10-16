<?php
session_start();

require __DIR__ . '/../models/DB.php';
require __DIR__ . '/../controllers/userController.php';


// Handle AJAX request for pagination and filtering
if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {


    $currentUserId = isset($_SESSION["register_id"]) ? $_SESSION["register_id"] : null;


    // Collect filter criteria from the request
    $filters = [
        'gender' => $_POST['gender'] ?? null,
        'age_min' => $_POST['age_min'] ?? null,
        'age_max' => $_POST['age_max'] ?? null,
        'religion' => $_POST['religion'] ?? null,
        'caste' => $_POST['caste'] ?? null,
        'occupation' => $_POST['occupation'] ?? null,
        'income' => $_POST['income'] ?? null,
        'filterFavorites' => $_POST['filterFavorites'] ?? null,
    ];

    // Pagination variables
    $currentPage = isset($_POST['current_page']) ? (int)$_POST['current_page'] : 1;
    $itemsPerPage = 6;
    $offset = ($currentPage - 1) * $itemsPerPage;

// Fetch filtered users for the current page, excluding the current user
$profileModel = new UserController($conn);
$usersData = $profileModel->displayUsers($filters, $offset, $itemsPerPage, $currentUserId);


// Render the user cards
if (!empty($usersData)) {
    foreach ($usersData as $userData) {
        echo '<div class="user-card">';
        
        // Current User ID from the session
        $currentUserId = $_SESSION['register_id'];
        
        // Profile Register User ID from the user data
        $profileRegisterUserId = $userData['register_id'];

        // Profile User ID from the user data
        $profileUserId = $userData['profile_id'];
        
         // Heart icon for favoriting profiles
         $heartClass = $userData['is_favourited'] ? 'fa-solid' : 'fa-regular'; // Determine heart icon class
         echo '<p class="user-fav-icon">
             <i class="' . $heartClass . ' fa-heart" 
                data-user-id="' . $currentUserId . '" 
                data-profile-id="' . $profileUserId . '" 
                onclick="toggleFavourite(this)"></i>
         </p>';
  
        // Profile photo
        echo '<div class="profile-photo"><img src="' . htmlspecialchars($userData['profile_photo']) . '" alt="User Image"></div>';
        
        // User details
        echo '<div class="user-details">';
        echo '<h2 id="user-card-name">' . htmlspecialchars($userData['name']) . '</h2>';
        echo '<p>Age: ' . htmlspecialchars($userData['age']) . '<br>';
        echo 'Religion: ' . htmlspecialchars($userData['religion']) . '<br>';
        echo 'Mother Tongue: ' . htmlspecialchars($userData['mother_tongue']) . '</p><br>';
        echo '<h5 class="view-profile-text" onclick="initUserDetailsOverlay()" data-user-id="' . $profileRegisterUserId . '">View Full Profile</h5>';
        echo '</div></div>';
    }
} else {
    echo '<p>No users found matching the filter criteria.</p>';
}

exit;
}