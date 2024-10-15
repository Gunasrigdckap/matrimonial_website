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
        if (isset($_POST['action'])) {
            $action = $_POST['action'];

            $profilePhotoPath = null;
            if (isset($_FILES['profile_photo']) && $_FILES['profile_photo']['error'] === UPLOAD_ERR_OK) {
                $photoTmpPath = $_FILES['profile_photo']['tmp_name'];
                $photoName = preg_replace("/[^a-zA-Z0-9\.\-_]/", "", $_FILES['profile_photo']['name']); 

                $uploadDir = __DIR__ . '/../uploads/profile_photos/';
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $allowedFileTypes = ['image/jpeg', 'image/png', 'image/gif'];
                $fileType = mime_content_type($photoTmpPath);

                if (in_array($fileType, $allowedFileTypes)) {
                    $profilePhotoPath = $uploadDir . basename($photoName);
                    if (move_uploaded_file($photoTmpPath, $profilePhotoPath)) {
                        $profilePhotoPath = '/uploads/profile_photos/' . basename($photoName);
                    } else {
                        echo "Error uploading the profile photo.";
                        exit;
                    }
                } else {
                    echo "Invalid file type!";
                    exit;
                }
            }

            // Sanitize inputs
            $profileData = [
                'register_id' => htmlspecialchars($registerId),
                'height' => htmlspecialchars($_POST['height']),
                'weight' => htmlspecialchars($_POST['weight']),
                'religion' => htmlspecialchars($_POST['religion']),
                'caste' => htmlspecialchars($_POST['caste']),
                'mother_tongue' => htmlspecialchars($_POST['mother_tongue']),
                'marital_status' => htmlspecialchars($_POST['marital_status']),
                'education' => htmlspecialchars($_POST['education']),
                'occupation' => htmlspecialchars($_POST['occupation']),
                'income' => htmlspecialchars($_POST['income']),
                'address' => htmlspecialchars($_POST['address']),
                'city' => htmlspecialchars($_POST['city']),
                'state' => htmlspecialchars($_POST['state']),
                'country' => htmlspecialchars($_POST['country']),
                'hobbies' => htmlspecialchars($_POST['hobbies']),
                'about_me' => htmlspecialchars($_POST['about_me']),
                'profile_photo' => $profilePhotoPath
            ];

            $profileModel = new ProfileModel($conn);

            if ($action === 'update') {
                if ($profileModel->updateProfile($profileData)) {
                    header("Location: /views/current-user-profile-listing.view.php");
                    exit();
                } else {
                    echo "Error occurred during profile update!";
                }
            } elseif ($action === 'save') {
                if ($profileModel->insertProfile($profileData)) {
                    header("Location: /family_details.php");
                    exit();
                } else {
                    echo "Error occurred during profile insertion!";
                }
            }
        }
    } else {
        echo "Register ID not available!";
        header("Location: /register.php");
        exit();
    }
} else {
    header('Location: /login.php');
    exit();
}
?>
