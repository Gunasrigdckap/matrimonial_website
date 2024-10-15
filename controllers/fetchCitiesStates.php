<?php
require __DIR__ . '/../models/DB.php'; 

header('Content-Type: application/json');


if (isset($_GET['country'])) {
    $country = $_GET['country'];

    $states = [];
    if ($country == 'india') {
        $states = ['Tamil Nadu', 'Kerala', 'Karnataka', 'Maharashtra'];
    } elseif ($country == 'usa') {
        $states = ['California', 'Texas', 'New York', 'Florida'];
    }

    // Send states as response
    echo json_encode($states);
} 
elseif (isset($_GET['state'])) {
    $state = $_GET['state'];

    $cities = [];
    if ($state == 'Tamil Nadu') {
        $cities = ['Chennai', 'Coimbatore', 'Madurai'];
    } elseif ($state == 'California') {
        $cities = ['Los Angeles', 'San Francisco', 'San Diego'];
    }

    // Send cities as response
    echo json_encode($cities);
} 
else {
    // If no valid parameters are passed
    echo json_encode(['error' => 'Invalid parameter']);
}
?>
