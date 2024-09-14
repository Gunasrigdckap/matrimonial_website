<?php


require __DIR__ . '/../models/usermodel.php'; 

class UserController
{
    private $userDetails;

    public function __construct($db)
    {
        $this->userDetails = new UserDetails($db); 
    }

    public function displayUsers()
    {
        $currentRegisterId = $_SESSION['register_id'];

        $users = $this->userDetails->getAllUsersExceptCurrent($currentRegisterId);
           
        return $users;
    }
}
?>
