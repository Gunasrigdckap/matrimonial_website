<?php
class UserDetails {
    
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Method to get users based on filters and excluding current user
    public function getUsersByFilters($filters, $currentRegisterId) {
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
                r.register_id != :current_register_id
        ";
        
        // Dynamically add filters to the SQL query
        $conditions = [];
        if (!empty($filters['gender'])) {
            $conditions[] = "r.gender = :gender";
        }
        if (!empty($filters['age_min'])) {
            $conditions[] = "TIMESTAMPDIFF(YEAR, r.date_of_birth, CURDATE()) >= :age_min";
        }
        if (!empty($filters['age_max'])) {
            $conditions[] = "TIMESTAMPDIFF(YEAR, r.date_of_birth, CURDATE()) <= :age_max";
        }
        if (!empty($filters['religion'])) {
            $conditions[] = "p.religion = :religion";
        }
        if (!empty($filters['caste'])) {
            $conditions[] = "p.caste = :caste";
        }

        // Append conditions to SQL query
        if (!empty($conditions)) {
            $sql .= " AND " . implode(" AND ", $conditions);
        }

        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':current_register_id', $currentRegisterId, PDO::PARAM_INT);

            // Bind filter values if they are set
            if (!empty($filters['gender'])) {
                $stmt->bindParam(':gender', $filters['gender']);
            }
            if (!empty($filters['age_min'])) {
                $stmt->bindParam(':age_min', $filters['age_min'], PDO::PARAM_INT);
            }
            if (!empty($filters['age_max'])) {
                $stmt->bindParam(':age_max', $filters['age_max'], PDO::PARAM_INT);
            }
            if (!empty($filters['religion'])) {
                $stmt->bindParam(':religion', $filters['religion']);
            }
            if (!empty($filters['caste'])) {
                $stmt->bindParam(':caste', $filters['caste']);
            }

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
