<?php

// require __DIR__ . '/../models/DB.php';
require_once(__DIR__ . '/../models/FavouritesModel.php');


class FavouritesController {
    private $model;

    public function __construct($dbConnection) {
        $this->model = new FavouritesModel($dbConnection);
    }

    public function toggleFavourite($currentUserId, $profileId) {
        // Check if the profile ID exists before proceeding
        if (!$this->model->profileExists($profileId)) {
            return json_encode(['status' => 'error', 'message' => 'Profile does not exist']);
        }
        
    
        // Check if the profile is already favourited
    if ($this->model->isFavourited($currentUserId, $profileId)) {
        // Remove from favourites
        $this->model->removeFavourite($currentUserId, $profileId);
        return json_encode(['status' => 'removed']); // Return response as JSON
    } else {
        // Add to favourites
       // In toggleFavourite
$result = $this->model->addFavourite($currentUserId, $profileId);
if ($result === false) {
    return json_encode(['status' => 'error', 'message' => 'Failed to add favourite']);
}
return json_encode(['status' => 'added']);

    }
    }
    
}
