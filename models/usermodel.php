
<?php


class UserDetails
{

    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // Fetching all users with optional filters 
    public function displayUsersDetails($filters, $offset, $itemsPerPage, $currentUserId)
    {
        $sql = "
            SELECT 
                r.register_id,
                CONCAT(r.first_name, ' ', r.last_name) AS name, 
                TIMESTAMPDIFF(YEAR, r.date_of_birth, CURDATE()) AS age, 
                p.religion,
                p.mother_tongue, 
                p.profile_photo
            FROM tbl_register r
            JOIN tbl_users_profiles p ON r.register_id = p.register_id
            WHERE r.register_id != :currentUserId
        ";

        // Apply filters if provided
        if (!empty($filters['gender'])) {
            $sql .= " AND r.gender = :gender";
        }
        if (!empty($filters['age_min'])) {
            $sql .= " AND TIMESTAMPDIFF(YEAR, r.date_of_birth, CURDATE()) >= :age_min";
        }
        if (!empty($filters['age_max'])) {
            $sql .= " AND TIMESTAMPDIFF(YEAR, r.date_of_birth, CURDATE()) <= :age_max";
        }
        if (!empty($filters['religion'])) {
            $sql .= " AND p.religion = :religion";
        }
        if (!empty($filters['caste'])) {
            $sql .= " AND p.caste = :caste";
        }

        // Embed limit and offset directly into the SQL query
        $sql .= " LIMIT $offset, $itemsPerPage";

        $stmt = $this->conn->prepare($sql);

          // Bind parameters
    $stmt->bindParam(':currentUserId', $currentUserId);

        // Bind parameters
        if (!empty($filters['gender'])) {
            $stmt->bindParam(':gender', $filters['gender']);
        }
        if (!empty($filters['age_min'])) {
            $stmt->bindParam(':age_min', $filters['age_min']);
        }
        if (!empty($filters['age_max'])) {
            $stmt->bindParam(':age_max', $filters['age_max']);
        }
        if (!empty($filters['religion'])) {
            $stmt->bindParam(':religion', $filters['religion']);
        }
        if (!empty($filters['caste'])) {
            $stmt->bindParam(':caste', $filters['caste']);
        }

        // Execute the query
        $stmt->execute();
        return $stmt->fetchAll();
    }


    // Get user details by user ID
    public function getUserDetailsById($userId)
    {
        $sql = "
            SELECT 
                r.first_name, 
                r.last_name, 
                r.date_of_birth, 
                TIMESTAMPDIFF(YEAR, r.date_of_birth, CURDATE()) AS age,
                p.religion,
                p.city,
                p.country,
                p.state,
                p.hobbies,
                p.caste, 
                p.marital_status, 
                p.mother_tongue, 
                p.height, 
                p.weight, 
                p.education, 
                p.occupation, 
                p.income, 
                p.profile_photo, 
                p.about_me 
            FROM tbl_register r
            JOIN tbl_users_profiles p ON r.register_id = p.register_id
            WHERE r.register_id = :userId
        ";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);

        // Execute the query
        $stmt->execute();

        // Fetch and return the result as an associative array
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

}
