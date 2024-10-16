<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/login.css">
    <title>Login</title>
</head>
<body>
    <form name="loginForm" action="/controllers/loginController.php" method="POST" onsubmit="return validateLoginForm()">
        <div>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email">
            <span class="error_messages" id="login_email_error"></span>
        </div>

        <div>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            <span class="error_messages" id="login_password_error"></span>
        </div>

        <input type="submit" value="Login">
    </form>
     <!-- Popup for error messages -->
     <div class="popup" id="errorPopup">
        <div class="popup-content">
            <span class="close" id="closePopup">&times;</span>
            <p id="errorMessage"></p>
        </div>
    </div>
    <script src="/assets/js//register_login_validation.js"></script>
    <script src="/assets/js/validationUtils.js"></script>
    <script src="/assets/js/popupFunctionality.js"></script>
</body>
</html>
