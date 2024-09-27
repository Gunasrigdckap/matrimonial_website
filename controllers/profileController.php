<?php
session_start();
require __DIR__ . '/../models/DB.php';
require_once '../models/profilemodel.php';

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

$db = new dbConnection($config);
$conn = $db->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $registerId = $_SESSION['register_id'];

    if (isset($registerId)) {
        // Check which button was pressed
        if (isset($_POST['action'])) {
            $action = $_POST['action']; 

            // Handle profile photo upload
            $profilePhotoPath = null;
            if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === UPLOAD_ERR_OK) {
                $photoTmpPath = $_FILES['profile_photo']['tmp_name'];
                $photoName = $_FILES['profile_photo']['name'];
                $uploadDir = __DIR__ . '/../uploads/profile_photos/';  // Directory to store profile photos

                // Create the directory if it doesn't exist
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
                
                $profilePhotoPath = $uploadDir . basename($photoName);

                // Move uploaded file to the desired directory
                if (move_uploaded_file($photoTmpPath, $profilePhotoPath)) {
                    // Store only relative path to avoid exposing server directory structure
                    $profilePhotoPath = '/uploads/profile_photos/' . basename($photoName);
                } else {
                    echo "Error uploading the profile photo.";
                    exit;
                }
            }

            // Prepare profile data
            $profileData = [
                'register_id' => $registerId,
                'height' => $_POST['height'],
                'weight' => $_POST['weight'],
                'religion' => $_POST['religion'],
                'caste' => $_POST['caste'],
                'mother_tongue' => $_POST['mother_tongue'],
                'marital_status' => $_POST['marital_status'],
                'education' => $_POST['education'],
                'occupation' => $_POST['occupation'],
                'income' => $_POST['income'],
                'address' => $_POST['address'],
                'city' => $_POST['city'],
                'state' => $_POST['state'],
                'country' => $_POST['country'],
                'hobbies' => $_POST['hobbies'],
                'about_me' => $_POST['about_me'],
                'profile_photo' => $profilePhotoPath  
            ];

            $profileModel = new ProfileModel($conn);

            if ($action === 'update') {
                // Update profile if it exists
                if ($profileModel->updateProfile($profileData)) {
                    header("Location:/views/current-user-profile-listing.view.php ");
                } else {
                    echo "Error occurred during profile update!";
                }
            } elseif ($action === 'save') {
                // Insert profile if it does not exist
                if ($profileModel->insertProfile($profileData)) {
                    header("Location: /family_details.php");
                } else {
                    echo "Error occurred during profile insertion!";
                }
            }
        }
    } else {
        echo "Register ID not available!";
        header("Location: /register.php");
    }
} else {
    header('Location: /login.php');
}
?>
