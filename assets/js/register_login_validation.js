function validateRegisterForm() {
    let firstName = document.forms["registerForm"]["first_name"].value;
    let lastName = document.forms["registerForm"]["last_name"].value;
    let password = document.forms["registerForm"]["user_password"].value;
    let confirmPassword = document.forms["registerForm"]["confirm_password"].value;
    let email = document.forms["registerForm"]["user_email"].value;
    let phoneNumber = document.forms["registerForm"]["phone_number"].value;
    let gender = document.querySelector('input[name="gender"]:checked'); 
    let dataofbirth = document.forms['registerForm']['date_of_birth'].value;

    let firstname_error = document.getElementById('firstname_error');
    let lastname_error = document.getElementById('lastname_error');
    let user_email_error = document.getElementById('user_email_error');
    let password_error = document.getElementById('user_password_error');
    let confirm_password_error = document.getElementById('confirm_password_error');
    let phone_error = document.getElementById('phone_number_error');
    let gender_error = document.getElementById('gender_error');
    let date_of_birth_error = document.getElementById('date_of_birth_error');

    // Clear previous error messages
    firstname_error.textContent = '';
    lastname_error.textContent = '';
    user_email_error.textContent = '';
    password_error.textContent = '';
    confirm_password_error.textContent = '';
    phone_error.textContent = '';
    gender_error.textContent = '';
    date_of_birth_error.innerHTML = '';

    let isValid = true;

    // First name validation
    if (firstName.length < 3) {
        firstname_error.textContent = 'First name must be at least 3 characters.';
        isValid = false;
    }

    // Last name validation
    if (lastName.length < 3) {
        lastname_error.textContent = 'Last name must be at least 3 characters.';
        isValid = false;
    }

    // Email validation
    let emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    if (!email.match(emailPattern)) {
        user_email_error.textContent = 'Invalid email address.';
        isValid = false;
    }

    // Password validation
    let passwordPattern = /^(?=.*[A-Z])(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{6,}$/;
    if (!password.match(passwordPattern)) {
        password_error.textContent = "Give strong password.";
        isValid = false;
    }

    // Confirm Password validation
    if (password !== confirmPassword) {
        confirm_password_error.textContent = "Passwords do not match.";
        isValid = false;
    }

    // Phone number validation
    let phonePattern = /^[0-9]{10}$/;
    if (!phoneNumber.match(phonePattern)) {
        phone_error.textContent = "Phone number must be 10 digits.";
        isValid = false;
    }

    // Gender validation
    if (!gender) {  
        gender_error.textContent = "Please select a gender.";
        isValid = false;
    }

    // Date of birth validation
    let currentDate = new Date();
    let birthDate = new Date(dataofbirth);
    let ageDifMs = currentDate - birthDate;
    let ageDate = new Date(ageDifMs);
    let age = Math.abs(ageDate.getUTCFullYear() - 1970);

    if (dataofbirth === '') {
        date_of_birth_error.innerHTML = "Please select date of birth.";
        isValid = false;
    } else if (age < 19) {
        date_of_birth_error.innerHTML = "You must be at least 18 years old.";
        isValid = false;
    }

    return isValid;
}
// Validate Login Form
function validateLoginForm() {
    let email = document.forms["loginForm"]["email"].value;
    let password = document.forms["loginForm"]["password"].value;

    // Get error message elements
    let login_email_error = document.getElementById('login_email_error');
    let login_password_error = document.getElementById('login_password_error');

    // Clear previous error messages
    login_email_error.textContent = '';
    login_password_error.textContent = '';

    let isValid = true;

    // Email validation
    if (!email) {
        login_email_error.textContent = 'Email is required.';
        isValid = false;
    } else {
        // Email format validation
        let emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
        if (!email.match(emailPattern)) {
            login_email_error.textContent = 'Invalid email format.';
            isValid = false;
        }
    }

    // Password validation
    if (!password) {
        login_password_error.textContent = 'Password is required.';
        isValid = false;
    } else {
        // Password validation (at least 6 characters, 1 capital letter, 1 special character)
        let passwordPattern = /^(?=.*[A-Z])(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{6,}$/;
        if (!password.match(passwordPattern)) {
            login_password_error.textContent = 'Password must be at least 6 characters, contain an uppercase letter and a special character.';
            isValid = false;
        }
    }

    return isValid;
}

// Show SweetAlert on login failure (placed outside the validation function)
window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    const errorParam = urlParams.get('error');

    if (errorParam === 'login_failed') {
        Swal.fire({
            icon: 'error',
            title: 'Login Failed',
            text: 'Incorrect email or password. Please try again!',
            confirmButtonText: 'OK'
        });
    }
};
