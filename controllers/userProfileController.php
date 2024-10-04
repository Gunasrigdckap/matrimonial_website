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

    public function getProfileCompletionPercentage($userProfile) {
        $completion = 0; 

        // Check Register fields (if all provided)
        if (!empty($userProfile['name']) && 
            !empty($userProfile['user_email']) && 
            !empty($userProfile['phone_number']) && 
            !empty($userProfile['age'])) {
            $completion += 30;  
        }
        // Check Personal Info fields (if all provided)
        if (!empty($userProfile['about_me']) && 
            !empty($userProfile['hobbies']) && 
            !empty($userProfile['height']) && 
            !empty($userProfile['weight'])) {
            $completion += 30;  
        }

        // Check Family Info fields (if all provided)
        if (!empty($userProfile['father_name']) && 
            !empty($userProfile['mother_name']) && 
            !empty($userProfile['father_occupation']) && 
            !empty($userProfile['mother_occupation'])) {
            $completion += 40;  
        }

        return $completion;  
    }

    
}
