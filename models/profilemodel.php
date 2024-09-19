<?php
class ProfileModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Insert into tbl_users_profiles (User profile data)
    public function insertProfile($profileData) {
        $query = "
            INSERT INTO tbl_users_profiles 
            (register_id, height, weight, religion, caste, mother_tongue, marital_status, education, occupation, income, address, city, state, country, hobbies, about_me, profile_photo, profile_created_at) 
            VALUES 
            (:register_id, :height, :weight, :religion, :caste, :mother_tongue, :marital_status, :education, :occupation, :income, :address, :city, :state, :country, :hobbies, :about_me, :profile_photo, NOW())
        ";

        $stmt = $this->db->prepare($query);

        // Bind the profile data parameters
        $stmt->bindParam(':register_id', $profileData['register_id']);
        $stmt->bindParam(':height', $profileData['height']);
        $stmt->bindParam(':weight', $profileData['weight']);
        $stmt->bindParam(':religion', $profileData['religion']);
        $stmt->bindParam(':caste', $profileData['caste']);
        $stmt->bindParam(':mother_tongue', $profileData['mother_tongue']);
        $stmt->bindParam(':marital_status', $profileData['marital_status']);
        $stmt->bindParam(':education', $profileData['education']);
        $stmt->bindParam(':occupation', $profileData['occupation']);
        $stmt->bindParam(':income', $profileData['income']);
        $stmt->bindParam(':address', $profileData['address']);
        $stmt->bindParam(':city', $profileData['city']);
        $stmt->bindParam(':state', $profileData['state']);
        $stmt->bindParam(':country', $profileData['country']);
        $stmt->bindParam(':hobbies', $profileData['hobbies']);
        $stmt->bindParam(':about_me', $profileData['about_me']);
        $stmt->bindParam(':profile_photo', $profileData['profile_photo']);

        // Execute the query and return true/false based on success
        return $stmt->execute();
    }
    
}
?>
