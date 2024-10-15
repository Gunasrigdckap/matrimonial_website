<?php

class FavouritesModel {
    private $conn;

    // Constructor to initialize the database connection
    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    // Check if the profile is already favourited by the user
    public function isFavourited($currentUserId, $profileId) {
        $query = "SELECT * FROM tbl_favourites WHERE register_id = :userId AND favourited_profile_id = :profileId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':userId', $currentUserId, PDO::PARAM_INT);
        $stmt->bindValue(':profileId', $profileId, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 

        return count($result) > 0; // Return true if the profile is favourited
    }

    // Check if the profile exists in the `tbl_users_profiles` table
    public function profileExists($profileId) {
        $query = "SELECT * FROM tbl_users_profiles WHERE profile_id = :profileId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':profileId', $profileId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);  // Return profile data if found
    }
    

    // Add a profile to the user's favourites list
    public function addFavourite($currentUserId, $profileId) {
        // Step 1: Check if the profile exists
        $checkQuery = "SELECT COUNT(*) FROM tbl_users_profiles WHERE profile_id = :profileId";
        $checkStmt = $this->conn->prepare($checkQuery);
        $checkStmt->bindValue(':profileId', $profileId, PDO::PARAM_INT);
        $checkStmt->execute();
        $profileExists = $checkStmt->fetchColumn();

        if (!$profileExists) {
            error_log("Profile ID $profileId does not exist in tbl_users_profiles.");
            return false; 
        }

        // Step 2: Add to favourites
        $query = "INSERT INTO tbl_favourites (register_id, favourited_profile_id, favourite_created_at) 
                  VALUES (:userId, :profileId, NOW())";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':userId', $currentUserId, PDO::PARAM_INT);
        $stmt->bindValue(':profileId', $profileId, PDO::PARAM_INT);
        
        // Execute the insert statement
        if (!$stmt->execute()) {
            error_log("Failed to add favourite: " . print_r($stmt->errorInfo(), true));
            return json_encode(['status' => 'error', 'message' => 'Failed to add favourite']);
        }

        return true; // Indicate success
    }

    // Remove a profile from the user's favourites list
    public function removeFavourite($currentUserId, $profileId) {
        $query = "DELETE FROM tbl_favourites WHERE register_id = :userId AND favourited_profile_id = :profileId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':userId', $currentUserId, PDO::PARAM_INT);
        $stmt->bindValue(':profileId', $profileId, PDO::PARAM_INT);
        
        // Execute the delete statement
        if (!$stmt->execute()) {
            error_log("Failed to remove favourite: " . print_r($stmt->errorInfo(), true));
            return false; // Indicate failure
        }

        return true; // Indicate success
    }
}
