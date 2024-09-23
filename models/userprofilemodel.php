<?php
class UserProfileDetails {
    
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

   public function getUserProfile($register_id) {
    // Query to fetch user data, including cases where profiles/family details may not exist
    $sql = "
        SELECT 
            CONCAT(r.first_name, ' ', r.last_name) AS name,
            r.user_email, 
            r.phone_number,
            TIMESTAMPDIFF(YEAR, r.date_of_birth, CURDATE()) AS age,
            p.height, p.weight, p.religion, p.caste, p.mother_tongue, p.marital_status, p.education, p.occupation, p.income, p.address, p.city, p.state, p.country, p.hobbies, p.about_me, p.profile_photo,
            f.father_name, f.mother_name, f.father_occupation, f.mother_occupation, f.siblings, f.family_type, f.family_status
        FROM 
            tbl_register r
        LEFT JOIN 
            tbl_users_profiles p ON r.register_id = p.register_id
        LEFT JOIN 
            tbl_family_details f ON r.register_id = f.register_id
        WHERE 
            r.register_id = :register_id
    ";

    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':register_id', $register_id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function deleteUserProfile($register_id) {
    $sql = "DELETE FROM tbl_register WHERE register_id = :register_id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindParam(':register_id', $register_id, PDO::PARAM_INT);
    return $stmt->execute();
}

}
?>



