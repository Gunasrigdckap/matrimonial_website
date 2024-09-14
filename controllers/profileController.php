<?php
session_start();
require __DIR__ . '/../models/DB.php';
require_once '../models/profilemodel.php';


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


// Instantiate the connection
$db = new dbConnection($config);
$conn = $db->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the register ID from the session
    $registerId = $_SESSION['register_id']; // Assuming you set this during registration

    // Check if register ID is available
    if (isset($registerId)) {
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
            'about_me' => $_POST['about_me']
        ];

        // Prepare and execute profile insertion
        $profileModel = new ProfileModel($conn);
        if ($profileModel->insertProfile($profileData)) {

         header("Location: /family_details.php");
        } else {
             echo "Error occurred during profile insertion!";
        }
    } else {
         echo "Register ID not available!";
         header("Location: /register.php");
    }
} else {
    header('Location: /login.php');
}
?>
