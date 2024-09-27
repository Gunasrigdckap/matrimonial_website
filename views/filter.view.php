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
            echo '<div class="profile-photo"><img src="' . $userData['profile_photo'] . '" alt="User Image"></div>';
            echo '<div class="user-details">';
            echo '<h3>' . $userData['name'] . '</h3>';
            echo '<p>Age: ' . $userData['age'] . '<br>';
            echo 'Religion: ' . $userData['religion'] . '<br>';
            echo 'Mother Tongue: ' . $userData['mother_tongue'] . '</p>';
            echo '</div></div>';
        }
    } else {
        echo '<p>No users found matching the filter criteria.</p>';
    }

    exit;
}
