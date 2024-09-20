<?php


require __DIR__ . '/../models/usermodel.php'; 

class UserController
{
    private $userDetails;

    public function __construct($db)
    {
        $this->userDetails = new UserDetails($db); 
    }

    public function displayUsers($filters)
    {
        $currentRegisterId = $_SESSION['register_id'] ?? null;

        // Pass filters and current user ID to model
        $users = $this->userDetails->getUsersByFilters($filters, $currentRegisterId);

        return $users;
    }

}
?>
