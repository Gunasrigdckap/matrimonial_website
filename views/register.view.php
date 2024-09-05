<?php
// Include the database connection
require_once './models/DB.php';
require_once './config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $username = $_POST['username'];
    $password = password_hash($_POST['user_password'], PASSWORD_DEFAULT); // Encrypt the password
    $email = $_POST['user_email'];
    $profileFor = $_POST['profile_for'];
    $phoneNumber = $_POST['phone_number'];
    $gender = $_POST['gender'];
    $dateOfBirth = $_POST['date_of_birth'];
    
    // Prepare SQL query to insert data
    $sql = "INSERT INTO tbl_register (first_name, last_name, username, user_password, user_email, profile_for, phone_number, gender, date_of_birth, register_user_created_at, register_user_updated_at)
            VALUES (:first_name, :last_name, :username, :user_password, :user_email, :profile_for, :phone_number, :gender, :date_of_birth, NOW(), NOW())";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':first_name', $firstName);
    $stmt->bindParam(':last_name', $lastName);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':user_password', $password);
    $stmt->bindParam(':user_email', $email);
    $stmt->bindParam(':profile_for', $profileFor);
    $stmt->bindParam(':phone_number', $phoneNumber);
    $stmt->bindParam(':gender', $gender);
    $stmt->bindParam(':date_of_birth', $dateOfBirth);

    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assests/css/register.css">

    <title>Register</title>
    <script>
        // JavaScript Form Validation
        function validateForm() {
            let firstName = document.forms["registerForm"]["first_name"].value;
            let lastName = document.forms["registerForm"]["last_name"].value;
            let username = document.forms["registerForm"]["username"].value;
            let password = document.forms["registerForm"]["user_password"].value;
            let email = document.forms["registerForm"]["user_email"].value;
            let phoneNumber = document.forms["registerForm"]["phone_number"].value;

            if (firstName == "" || lastName == "" || username == "" || password == "" || email == "" || phoneNumber == "") {
                alert("All fields must be filled out");
                return false;
            }

            // Email validation
            let emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
            if (!email.match(emailPattern)) {
                alert("Invalid email format");
                return false;
            }

            // Password length validation
            if (password.length < 6) {
                alert("Password must be at least 6 characters");
                return false;
            }

            // Phone number validation (assuming 10 digits)
            let phonePattern = /^[0-9]{10}$/;
            if (!phoneNumber.match(phonePattern)) {
                alert("Phone number must be 10 digits");
                return false;
            }

            return true;
        }
    </script>
</head>
<body>

<form name="registerForm" action="" method="POST" onsubmit="return validateForm()">
    <div>
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name">
    </div>

    <div>
        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name">
    </div>

    <div>
        <label for="username">Username:</label>
        <input type="text" id="username" name="username">
    </div>

    <div>
        <label for="user_password">Password:</label>
        <input type="password" id="user_password" name="user_password">
    </div>

    <div>
        <label for="user_email">Email:</label>
        <input type="email" id="user_email" name="user_email">
    </div>

    <div>
        <label for="profile_for">Profile For:</label>
        <select id="profile_for" name="profile_for">
            <option value="self">Self</option>
            <option value="son">Son</option>
            <option value="daughter">Daughter</option>
            <option value="sibling">Sibling</option>
            <option value="friend">Friend</option>
        </select>
    </div>

    <div>
        <label for="phone_number">Phone Number:</label>
        <input type="text" id="phone_number" name="phone_number">
    </div>

    <div class="gender-group">
        <label>Gender:</label>
        <input type="radio" id="male" name="gender" value="male">
        <label for="male">Male</label>
        <input type="radio" id="female" name="gender" value="female">
        <label for="female">Female</label>
    </div>

    <div>
        <label for="date_of_birth">Date of Birth:</label>
        <input type="date" id="date_of_birth" name="date_of_birth">
    </div>

    <input type="submit" value="Register">
</form>

</body>
</html>
