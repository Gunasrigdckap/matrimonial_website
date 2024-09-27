<?php
class FamilyDetailsModel {
    private $conn;

    public function __construct($dbConnection) {
        $this->conn = $dbConnection;
    }

    // Method to insert family details into the database
    public function insertFamilyDetails($familyDetails) {
        $query = "INSERT INTO tbl_family_details (register_id, father_name, father_occupation, mother_name, mother_occupation, siblings, family_type, family_status, family_details_created_at)
                  VALUES (:register_id, :father_name, :father_occupation, :mother_name, :mother_occupation, :siblings, :family_type, :family_status, NOW())";

        $stmt = $this->conn->prepare($query);
        return $stmt->execute($familyDetails);
    }

    // Method to update existing family details in the database
    public function updateFamilyDetails($familyDetails) {
        $query = "UPDATE tbl_family_details 
                  SET father_name = :father_name,
                      father_occupation = :father_occupation,
                      mother_name = :mother_name,
                      mother_occupation = :mother_occupation,
                      siblings = :siblings,
                      family_type = :family_type,
                      family_status = :family_status,
                      family_details_updated_at = NOW()
                  WHERE register_id = :register_id";

        $stmt = $this->conn->prepare($query);
        return $stmt->execute($familyDetails);
    }
}
