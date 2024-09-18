<?php
class UserDetails {
    
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }
    
    // Method to get all registered user data except the current user
    public function getAllUsersExceptCurrent($currentRegisterId) {
        $sql = "
           SELECT 
            CONCAT(r.first_name, ' ', r.last_name) AS name, 
            TIMESTAMPDIFF(YEAR, r.date_of_birth, CURDATE()) AS age, 
            p.religion, 
            p.mother_tongue,
            p.profile_photo
            FROM 
                tbl_register r 
            JOIN 
                tbl_users_profiles p 
            ON 
                r.register_id = p.register_id
            WHERE 
                r.register_id != :current_register_id;
        ";
    
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':current_register_id', $currentRegisterId, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $result;
        } catch (PDOException $e) {
            echo 'Query failed: ' . $e->getMessage();
            return [];
        }
    }
    
}
?>
