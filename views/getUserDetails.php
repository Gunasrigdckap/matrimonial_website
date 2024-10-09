<?php
require __DIR__ . '/../models/DB.php';
require __DIR__ . '/../controllers/userController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];
    $userModel = new UserController($conn);

    // Fetch full details of the user
    $userDetails = $userModel->getUserDetailsById($userId);

    if ($userDetails) {
        // Display the profile image
        echo '<div class="user-profile">';
        if (!empty($userDetails['profile_photo'])) {
            echo '<div class="profile-image">';
            echo '<img src="' . $userDetails['profile_photo'] . '" alt="Profile Image" width="150" height="150">';
            echo '</div>';
        } else {
            echo '<div class="profile-image">';
            echo '<img src="/default-profile.png" alt="Default Profile Image" width="150" height="150">';
            echo '</div>';
        }

        // Display other user details
        echo '<h2>' . $userDetails['first_name'] . ' ' . $userDetails['last_name'] . '</h2>';
        echo '<p>Age: ' . $userDetails['age'] . '</p>';
        echo '<p>Religion: ' . $userDetails['religion'] . '</p>';
        echo '<p>Caste: ' . $userDetails['caste'] . '</p>';
        echo '<p>Mother Tongue: ' . $userDetails['mother_tongue'] . '</p>';
        echo '<p>Height: ' . $userDetails['height'] . ' cm</p>';
        echo '<p>Weight: ' . $userDetails['weight'] . ' kg</p>';
        echo '<p>Education: ' . $userDetails['education'] . '</p>';
        echo '<p>Occupation: ' . $userDetails['occupation'] . '</p>';
        echo '<p>Income: ' . $userDetails['income'] . '</p>';
        echo '<p>Hobbies: ' . $userDetails['hobbies'] . '</p>';
        echo '<p>About Me: ' . $userDetails['about_me'] . '</p>';
        echo '<p>City: ' . $userDetails['city'] . '</p>';
        echo '<p>State: ' . $userDetails['state'] . '</p>';
        echo '<p>Country: ' . $userDetails['country'] . '</p>';
        echo '<p>Marital Status: ' . $userDetails['marital_status'] . '</p>';
        echo '</div>';
      
    } else {
        echo 'User details not found.';
    }
}
