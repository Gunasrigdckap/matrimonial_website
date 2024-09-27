

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/register.css">
    <link rel="stylesheet" href="/assets/css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <title>Register</title>
    <script src="/assets/js/register_login_validation.js"></script>
    <script src="/assets/js/validationUtils.js"></script>

        <!-- Include SweetAlert -->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <style>
        .progress-container { width: 80%; background-color: #f3f3f3; border-radius: 5px; margin-bottom: 20px; }
        .progress-bar { height: 25px; background-color: #4caf50; width: 0%; border-radius: 5px; text-align: center; line-height: 25px; color: white; color: black; }
    </style>
</head>
<body>
    
<!-- <div class="progress-container">
    <div class="progress-bar">0%</div>
</div> -->

<?php require __DIR__ . '/partials/header/header.php'; ?>
    <form name="registerForm" action="/controllers/registerController.php" method="POST" onsubmit="return validateRegisterForm()">
        <div>
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name">
            <span class="error_messages" id="firstname_error"></span>
        </div>

        <div>
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name">
            <span class="error_messages" id="lastname_error"></span>

        </div>


        <div>
            <label for="user_email">Email:</label>
            <input type="email" id="user_email" name="user_email">
            <span class="error_messages" id="user_email_error"></span>
        </div>
        
        <div>
            <label for="user_password">Password:</label>
            <!-- <input type="password" id="user_password" name="user_password"> -->
            <input type="password" id="user_password" name="user_password" onfocus="showTooltip()" onblur="hideTooltip()" oninput="validatePassword()">
            <span class="error_messages" id="user_password_error"></span>
            <div class="password-tooltip" id="password_tooltip">
                <ul>
                    <li id="uppercase">At least one uppercase letter</li>
                    <li id="special_char">At least one special character (!@#$%^&*)</li>
                    <li id="number">At least one number</li>
                    <li id="min_length">Minimum 8 characters</li>
                </ul>
            </div>

        </div>

        <div>
            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password">
            <span class="error_messages" id="confirm_password_error"></span>
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
            <span class="error_messages" id="profile_for_error"></span>
        </div>

        <div>
            <label for="phone_number">Phone Number:</label>
            <input type="number" id="phone_number" name="phone_number">
            <span class="error_messages" id="phone_number_error"></span>
        </div>

        <div>
            <label>Gender:</label>
            <input type="radio" id="male" name="gender" value="male">
            <label for="male">Male</label>
            <input type="radio" id="female" name="gender" value="female">
            <label for="female">Female</label>
            <span class="error_messages" id="gender_error"></span>
        </div>

        <div>
            <label for="date_of_birth">Date of Birth:</label>
            <input type="date" id="date_of_birth" name="date_of_birth">
            <span class="error_messages" id="date_of_birth_error"></span>
        </div>

        <button type="submit" value="Register" class="register_button ">Register</button>
        
    </form>
</body>
</html>
