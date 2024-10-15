<?php

session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../models/DB.php';
require_once '../controllers/FavouritesController.php';

// Ensure the user is logged in
if (isset($_SESSION['register_id'])) {
    $currentUserId = $_SESSION['register_id'];
    $profileId = $_POST['profile_id']; 


    // Initialize the controller
    $favouritesController = new FavouritesController($conn);

    // Toggle favourite status and return the result
    $result = $favouritesController->toggleFavourite($currentUserId, $profileId);
    echo $result; // Either 'added' or 'removed'
} else {
    echo 'error'; 
}
