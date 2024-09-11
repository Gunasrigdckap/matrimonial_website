<?php
session_start();
require __DIR__ . '/../models/DB.php';
require __DIR__ . '/../models/loginmodel.php';

class LoginController {
    private $loginModel;

    public function __construct($conn) {
        $this->loginModel = new LoginModel($conn);
    }

    public function loginUser() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = $_POST['email'];
            $password = $_POST['password'];

            if (!empty($email) && !empty($password)) {
                $user = $this->loginModel->authenticateUser($email, $password);
               print_r($user);
                if ($user) {
                    // Successful login
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['email'] = $user['user_email'];
                    header("Location: /index.php"); // Redirect to dashboard or any protected page
                    exit();
                } else {
                    // Invalid email or password
                    header("Location: ../login.php?error=login_failed");
                    exit();
                }
            } else {
                // Missing email or password
                header("Location: ../login.php?error=empty_fields");
                exit();
            }
        }
    }
}

// Initialize the controller and call the login function
$dbConnection = new dbConnection($config);
$conn = $dbConnection->getConnection();
$controller = new LoginController($conn);
$controller->loginUser();
?>
