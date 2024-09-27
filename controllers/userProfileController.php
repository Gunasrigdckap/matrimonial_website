<?php
require __DIR__ . '/../models/userprofilemodel.php'; 


class UserProfileController {
    private $userDetails;

    public function __construct($db) {
        $this->userDetails = new UserProfileDetails($db); 
    }

    public function getCurrentUserProfile($register_id) {
        return $this->userDetails->getUserProfile($register_id);
    }
    public function deleteProfile($register_id) {
        return $this->userDetails->deleteUserProfile($register_id);
    }
    
}
