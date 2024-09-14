<?php
class Register
{
    private $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function insertUser($firstName, $lastName, $password, $email, $profileFor, $phoneNumber, $gender, $dateOfBirth) {
        $query = "INSERT INTO tbl_register (first_name, last_name, user_password, user_email, profile_for, phone_number, gender, date_of_birth)
                  VALUES (:firstName, :lastName, :password, :email, :profileFor, :phoneNumber, :gender, :dateOfBirth)";
        
        $stmt = $this->conn->prepare($query);
        
        // Bind the parameters
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':profileFor', $profileFor);
        $stmt->bindParam(':phoneNumber', $phoneNumber);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':dateOfBirth', $dateOfBirth);
    
        // Execute the query
        if ($stmt->execute()) {
            // Return the last inserted ID
            return $this->conn->lastInsertId();
        } else {
            return false;
        }
    }
}
