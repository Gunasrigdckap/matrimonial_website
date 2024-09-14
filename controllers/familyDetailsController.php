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

        // Prepare and execute family details insertion
        $familyModel = new FamilyDetailsModel($conn);
        if ($familyModel->insertFamilyDetails($familyDetails)) {
           header('location:/index.php');
        } else {
            echo "Failed to save family details. Please try again.";
        }
    } else {
    header('Location: /login.php');
}
}
?>
