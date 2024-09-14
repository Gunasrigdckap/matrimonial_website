<?php
class ProfileModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function insertProfile($profileData) {
        $stmt = $this->db->prepare("INSERT INTO tbl_users_profiles (register_id, height, weight, religion, caste, mother_tongue, marital_status, education, occupation, income, address, city, state, country, hobbies, about_me, profile_created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
        return $stmt->execute([
            $profileData['register_id'],
            $profileData['height'],
            $profileData['weight'],
            $profileData['religion'],
            $profileData['caste'],
            $profileData['mother_tongue'],
            $profileData['marital_status'],
            $profileData['education'],
            $profileData['occupation'],
            $profileData['income'],
            $profileData['address'],
            $profileData['city'],
            $profileData['state'],
            $profileData['country'],
            $profileData['hobbies'],
            $profileData['about_me']
        ]);
    }
}
?>
