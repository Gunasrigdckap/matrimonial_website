<?php


require __DIR__ . '/../models/usermodel.php'; 

class UserController
{
    private $userDetails;

    public function __construct($db)
    {
        $this->userDetails = new UserDetails($db); 
    }

      // Displays the all details to the user
      public function displayUsers($filters, $offset, $itemsPerPage, $currentUserId)
{
    $users = $this->userDetails->displayUsersDetails($filters, $offset, $itemsPerPage, $currentUserId);
    return $users;
}
  // Method to get user details by user ID
  public function getUserDetailsById($userId, $action)
  {
      return $this->userDetails->getUserDetailsById($userId,$action); 
  }

}
?>
