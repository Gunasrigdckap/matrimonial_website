<?php
session_start();
require __DIR__ . '/../models/DB.php';
require_once '../models/familydetailsmodel.php';

// Instantiate the connection
$db = new dbConnection($config);
$conn = $db->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the register ID from the session
    $registerId = $_SESSION['register_id']; // Assuming you set this during registration

    if (isset($registerId)) {
        // Check which button was pressed
        if (isset($_POST['action'])) {
            $action = $_POST['action']; 

            // Prepare family details data
            $familyDetails = [
                'register_id' => $registerId,
                'father_name' => $_POST['father_name'],
                'father_occupation' => $_POST['father_occupation'],
                'mother_name' => $_POST['mother_name'],
                'mother_occupation' => $_POST['mother_occupation'],
                'siblings' => $_POST['siblings'],
                'family_type' => $_POST['family_type'],
                'family_status' => $_POST['family_status']
            ];

            // Instantiate the FamilyDetailsModel
            $familyModel = new FamilyDetailsModel($conn);

            if ($action === 'update') {
                // Update family details if they exist
                if ($familyModel->updateFamilyDetails($familyDetails)) {
                    header("Location:/views/current-user-profile-listing.view.php");
                } else {
                    echo "Error occurred during family details update!";
                }
            } elseif ($action === 'save') {
                // Insert family details if they do not exist
                if ($familyModel->insertFamilyDetails($familyDetails)) {
                    header("Location: /index.php");
                } else {
                    echo "Error occurred during family details insertion!";
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
