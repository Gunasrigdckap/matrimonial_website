
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
                p.profile_photo, 
                p.profile_id, 
                f.favourited_profile_id, 
                CASE WHEN f.favourited_profile_id IS NOT NULL THEN 1 ELSE 0 END AS is_favourited 
            FROM tbl_register r 
            JOIN tbl_users_profiles p ON r.register_id = p.register_id 
            LEFT JOIN tbl_favourites f ON f.favourited_profile_id = p.profile_id AND f.register_id = :currentUserId 
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
        if (!empty($filters['occupation'])) {
            $sql .= " AND p.occupation = :occupation";
        }
        if (!empty($filters['income'])) {
            if ($filters['income'] === '2000000+') {
                // For 2000000+, check where the minimum part of the range is 2000000 or greater
                $sql .= " AND CAST(SUBSTRING_INDEX(p.income, '-', 1) AS UNSIGNED) >= 2000000";
            } else {
                // For other income ranges like 200000-300000
                list($income_min, $income_max) = explode('-', $filters['income']);
                $sql .= " AND CAST(SUBSTRING_INDEX(p.income, '-', 1) AS UNSIGNED) >= :income_min";
                $sql .= " AND CAST(SUBSTRING_INDEX(p.income, '-', -1) AS UNSIGNED) <= :income_max";
            }
        }
        
        // Handle "Show Only Favorites" filter
        if (!empty($filters['filterFavorites']) && $filters['filterFavorites'] == '1') {

            $sql .= " AND f.favourited_profile_id IS NOT NULL";
        }
    
        // Embed limit and offset directly into the SQL query
        $sql .= " LIMIT :offset, :itemsPerPage";
    
        $stmt = $this->conn->prepare($sql);
    
        // Bind parameters
        $stmt->bindParam(':currentUserId', $currentUserId, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':itemsPerPage', $itemsPerPage, PDO::PARAM_INT);
    
        if (!empty($filters['gender'])) {
            $stmt->bindParam(':gender', $filters['gender'], PDO::PARAM_STR);
        }
        if (!empty($filters['age_min'])) {
            $stmt->bindParam(':age_min', $filters['age_min'], PDO::PARAM_INT);
        }
        if (!empty($filters['age_max'])) {
            $stmt->bindParam(':age_max', $filters['age_max'], PDO::PARAM_INT);
        }
        if (!empty($filters['religion'])) {
            $stmt->bindParam(':religion', $filters['religion'], PDO::PARAM_STR);
        }
        if (!empty($filters['caste'])) {
            $stmt->bindParam(':caste', $filters['caste'], PDO::PARAM_STR);
        }
        if (!empty($filters['occupation'])) {
            $stmt->bindParam(':occupation', $filters['occupation'], PDO::PARAM_STR);
        }
        if (!empty($filters['income']) && $filters['income'] !== '2000000+') {
            $stmt->bindParam(':income_min', $income_min, PDO::PARAM_INT);
            $stmt->bindParam(':income_max', $income_max, PDO::PARAM_INT);
        }
    
        // Execute the query
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all results as an associative array
    }
    

    // Get user details by user ID
    public function getUserDetailsById($userId)
    {
        $sql = "
            SELECT 
                CONCAT(r.first_name, ' ', r.last_name) AS name, 
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
