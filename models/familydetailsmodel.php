<?php
class FamilyDetailsModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function insertFamilyDetails($familyDetails) {
        $stmt = $this->db->prepare("INSERT INTO tbl_family_details (register_id, father_name, father_occupation, mother_name, mother_occupation, siblings, family_type, family_status, family_details_created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())");
        return $stmt->execute([
            $familyDetails['register_id'],
            $familyDetails['father_name'],
            $familyDetails['father_occupation'],
            $familyDetails['mother_name'],
            $familyDetails['mother_occupation'],
            $familyDetails['siblings'],
            $familyDetails['family_type'],
            $familyDetails['family_status']
        ]);
    }
}
?>
