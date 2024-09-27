<?php
class ProfileModel {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    // Method to insert a new profile
    public function insertProfile($profileData) {
        $query = "INSERT INTO tbl_users_profiles (register_id, height, weight, religion, caste, mother_tongue, marital_status, education, occupation, income, address, city, state, country, hobbies, about_me, profile_photo, profile_created_at)
                  VALUES (:register_id, :height, :weight, :religion, :caste, :mother_tongue, :marital_status, :education, :occupation, :income, :address, :city, :state, :country, :hobbies, :about_me, :profile_photo, NOW())";

        $stmt = $this->conn->prepare($query);
        return $stmt->execute($profileData);
    }

    // Method to update an existing profile
    public function updateProfile($profileData) {
        $query = "UPDATE tbl_users_profiles 
                  SET height = :height,
                      weight = :weight,
                      religion = :religion,
                      caste = :caste,
                      mother_tongue = :mother_tongue,
                      marital_status = :marital_status,
                      education = :education,
                      occupation = :occupation,
                      income = :income,
                      address = :address,
                      city = :city,
                      state = :state,
                      country = :country,
                      hobbies = :hobbies,
                      about_me = :about_me,
                      profile_photo = :profile_photo,
                      profile_updated_at = NOW()
                  WHERE register_id = :register_id"; 

        $stmt = $this->conn->prepare($query);
        return $stmt->execute($profileData);
    }
}
?>
