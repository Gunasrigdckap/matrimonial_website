<?php
require __DIR__ . '/../models/DB.php';
require __DIR__ . '/../models/registermodel.php';

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

class RegisterController {
    private $registerModel;

    public function __construct($db) {
        $this->registerModel = new Register($db); // Pass the DB connection to the model
    }

    public function registerUser() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get data from POST request
            $firstName = $_POST['first_name'];
            $lastName = $_POST['last_name'];
            $password = password_hash($_POST['user_password'], PASSWORD_DEFAULT); // Encrypt the password
            $email = $_POST['user_email'];
            $profileFor = $_POST['profile_for'];
            $phoneNumber = $_POST['phone_number'];
            $gender = isset($_POST['gender']) ? $_POST['gender'] : null;  // Capture gender or set to null
            $dateOfBirth = $_POST['date_of_birth'];

            // Insert the user data via the model
            $newRegisterId = $this->registerModel->insertUser($firstName, $lastName, $password, $email, $profileFor, $phoneNumber, $gender, $dateOfBirth);
            
            if ($newRegisterId) {
                // Start the session and store the register_id
                session_start();
                $_SESSION['register_id'] = $newRegisterId;  // Store register_id in the session

                // Redirect to the profile page
                header("Location: /profile.php");
                exit();  // This ensures the script stops after the redirect
            } else {
                echo "Error occurred during registration!";
            }
        }
    }
}

// Initialize and run controller logic
$db = new dbConnection($config);
$registerController = new RegisterController($db->getConnection()); // Pass the DB connection
$registerController->registerUser();
