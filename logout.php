<?php
// Start the session
session_start();

// Check if a session is active
if (isset($_SESSION['register_id'])) {
    // Unset all of the session variables
    $_SESSION = array();

    // Destroy the session
    if (session_id() !== '' || isset($_COOKIE[session_name()])) {
        setcookie(session_name(), '', time() - 42000, '/');
        session_destroy();
    }
}

// Redirect to the homepage or login page
header('Location: /index.php');
exit();
?>




