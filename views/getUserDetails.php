<?php
require __DIR__ . '/../models/DB.php';
require __DIR__ . '/../controllers/userController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];
    $action = $_POST['action'] ?? null;

    $userModel = new UserController($conn);

    // Fetch full details of the user
    $userDetails = $userModel->getUserDetailsById($userId,$action);

    if ($userDetails) {
        echo '<div class="user-profile" data-user-id="' . $userDetails['register_id'] . '">';


        // Display profile image
        echo '<div class="profile-image">';
        if (!empty($userDetails['profile_photo'])) {
            echo '<img src="' . $userDetails['profile_photo'] . '" alt="Profile Image">';
            echo '<h2>' . $userDetails['name'] . '</h2>';
        } else {
            echo '<img src="/default-profile.png" alt="Default Profile Image">';
        }
        echo '</div>'; 

        // Display user details
        echo '<div class="user-details" id="user-details-view">';
        // echo '<h2>' . $userDetails['name'] . '</h2>';
        echo '<p class="age-religion">' . $userDetails['age'] . ' Years | ' . $userDetails['religion'] . ', ' . $userDetails['caste'] . '</p>';
      
        
        echo '<div class="user-detail-container">';
        echo '<div class="user-detail-column">';

        echo '<div class="user-detail-item"><strong>Height:</strong> ' . $userDetails['height'] . ' cm | ';
        echo '<strong>Weight:</strong> ' . $userDetails['weight'] . ' kg | ';
        echo '<strong>Education:</strong> ' . $userDetails['education'];
        echo '</div>'; 
        

        echo '<div class="occupation-location"><strong>Occupation:</strong> ' . $userDetails['occupation'] . '</div>';

        echo '<div class="user-detail-item"><strong>Marital Status:</strong> ' . $userDetails['marital_status'] . '</div>';

        echo '<div class="user-detail-column">';
        echo '<div class="user-detail-item"><strong>Income:</strong> ' . $userDetails['income'] . '</div>';
        echo '<strong>Hobbies:</strong> ' . $userDetails['hobbies'] . '</div>';
        echo '<div class="user-detail-item"><strong>City:</strong> ' . $userDetails['city'] . '</div>';
        echo '<div class="user-detail-item"><strong>State:</strong> ' . $userDetails['state'] . '</div>';
        echo '<div class="user-detail-item"><strong>Country:</strong> ' . $userDetails['country'] . '</div>';
        echo '</div>'; 

        echo '</div>'; 

      

        echo '<div class="user-detail-item"><strong>About Me:</strong> ' . $userDetails['about_me'] . '</div>';
        
        echo '</div>'; 
         echo '</div>'; 

       

        echo '<div class="button-container">';
        echo '<button class="previous-next-buttons" onclick="pre(this)" data-user-id="' . htmlspecialchars($userDetails['register_id']) . '"><i class="fa-solid fa-backward"></i></button>';
        echo '<button class="previous-next-buttons" onclick="next(this)" data-user-id="' . htmlspecialchars($userDetails['register_id']) . '"><i class="fa-solid fa-forward"></i></button>';
        echo '</div>';

    } 
    else {
        echo 'User details not found.';
    }
}
?>

