<?php
session_start();
require __DIR__ . '/../controllers/userProfileController.php';
require __DIR__ . '/../models/DB.php';

// Fetch current user profile data
$register_id = $_SESSION['register_id']; // Get logged-in user ID
$profileController = new UserProfileController($conn);
$userProfile = $profileController->getCurrentUserProfile($register_id);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="/assets/css/current_user_profile.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/assets/js/register_login_validation.js"></script>
    <link rel="stylesheet" href="/assets/css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<?php require __DIR__ . '/partials/header/header.php'; ?>
<div class="profile-container">
    <div class="profile-section">
        <div>
        <img src="<?php echo !empty($userProfile['profile_photo']) ? htmlspecialchars($userProfile['profile_photo']) : '/uploads/default-image.png'; ?>" alt="Profile Photo" class="user-profile-photo">
        </div>

        <div>
            <h2><?php echo htmlspecialchars($userProfile['name'] ?? 'Not provided'); ?></h2>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($userProfile['user_email']); ?></p>
            <p><strong>Phone:</strong> <?php echo htmlspecialchars($userProfile['phone_number']); ?></p>
            <p><strong>Age:</strong> <?php echo htmlspecialchars($userProfile['age'] ?? 'Not provided'); ?></p>
        </div>
    </div>

    
    <!-- Toggle Buttons -->
    <div class="toggle-buttons">
        <button class="toggle-btn" data-section="personal-info">Personal Info</button>
        <button class="toggle-btn" data-section="family-info">Family Info </button>
    </div>

    <!-- Personal Info Section -->
    <div id="personal-info" class="profile-section-content active">
       <h3>Personal Details</h3> <div><a href="/views/profile.view.php" class="edit-btn"><i class="fa-solid fa-pen-to-square"></i></a></div>
        <p><strong> About Me:</strong> <?php echo htmlspecialchars($userProfile['about_me'] ?? 'Not provided'); ?></p>
        <p><strong>Hobbies:</strong> <?php echo htmlspecialchars($userProfile['hobbies'] ?? 'Not provided'); ?></p>
        <p><strong>Height:</strong> <?php echo htmlspecialchars($userProfile['height'] ?? 'Not provided'); ?> cm</p>
        <p><strong>Weight:</strong> <?php echo htmlspecialchars($userProfile['weight'] ?? 'Not provided'); ?> kg</p>
        <p><strong>Religion:</strong> <?php echo htmlspecialchars($userProfile['religion'] ?? 'Not provided'); ?></p>
        <p><strong>Caste:</strong> <?php echo htmlspecialchars($userProfile['caste'] ?? 'Not provided'); ?></p>
    </div>

   

    <!-- Family Info Section -->
    <div id="family-info" class="profile-section-content">
        <h3>Family Details</h3> <div><a href="/views/family_details.view.php" class="edit-btn"><i class="fa-solid fa-pen-to-square"></i></a></div>
        <p><strong>Father's Name:</strong> <?php echo htmlspecialchars($userProfile['father_name'] ?? 'Not provided'); ?></p>
        <p><strong>Mother's Name:</strong> <?php echo htmlspecialchars($userProfile['mother_name'] ?? 'Not provided'); ?></p>
        <p><strong>Father's Occupation:</strong> <?php echo htmlspecialchars($userProfile['father_occupation'] ?? 'Not provided'); ?></p>
        <p><strong>Mother's Occupation:</strong> <?php echo htmlspecialchars($userProfile['mother_occupation'] ?? 'Not provided'); ?></p>
    </div>
</div>


</body>
</html>
