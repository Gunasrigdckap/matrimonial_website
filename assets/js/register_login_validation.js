

// --------------------------------Register Form Validation-------------------


function validateRegisterForm() {
    let form = document.forms["registerForm"];
    let firstName = form["first_name"].value;
    let lastName = form["last_name"].value;
    let password = form["user_password"].value;
    let confirmPassword = form["confirm_password"].value;
    let email = form["user_email"].value;
    let phoneNumber = form["phone_number"].value;
    let gender = document.querySelector('input[name="gender"]:checked'); 
    let dateOfBirth = form['date_of_birth'].value;

    let isValid = true;

    // First name validation
    if (firstName.length < 3) {
        setError('firstname_error', 'First name must be at least 3 characters.');
        isValid = false;
    } else {
        clearError('firstname_error');
    }

    // Last name validation
    if (lastName.length < 3) {
        setError('lastname_error', 'Last name must be at least 3 characters.');
        isValid = false;
    } else {
        clearError('lastname_error');
    }

    // Email validation
    if (!isValidPattern(email, /^[^ ]+@[^ ]+\.[a-z]{2,3}$/)) {
        setError('user_email_error', 'Invalid email address.');
        isValid = false;
    } else {
        clearError('user_email_error');
    }

    // Password validation
    if (!isValidPattern(password, /^(?=.*[A-Z])(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{6,}$/)) {
        setError('user_password_error', 'Password must be strong.');
        isValid = false;
    } else {
        clearError('user_password_error');
    }

    // Confirm Password validation
    if (!doValuesMatch(password, confirmPassword)) {
        setError('confirm_password_error', 'Passwords do not match.');
        isValid = false;
    } else {
        clearError('confirm_password_error');
    }

    // Phone number validation
    if (!isValidPattern(phoneNumber, /^[0-9]{10}$/)) {
        setError('phone_number_error', 'Phone number must be 10 digits.');
        isValid = false;
    } else {
        clearError('phone_number_error');
    }

    // Gender validation
    if (!gender) {  
        setError('gender_error', 'Please select a gender.');
        isValid = false;
    } else {
        clearError('gender_error');
    }

    // Date of birth validation
    let age = calculateAge(dateOfBirth);
    if (isEmpty(dateOfBirth)) {
        setError('date_of_birth_error', 'Please select a date of birth.');
        isValid = false;
    } else if (age < 18) {
        setError('date_of_birth_error', 'You must be at least 18 years old.');
        isValid = false;
    } else {
        clearError('date_of_birth_error');
    }

    return isValid;
}

// Function to calculate age from a date string
function calculateAge(dateString) {
    let birthDate = new Date(dateString);
    let ageDif = Date.now() - birthDate.getTime();
    let ageDate = new Date(ageDif); 
    return Math.abs(ageDate.getUTCFullYear() - 1970);
}


//--------------------------------Login Form Validation---------------------------

function validateLoginForm() {
    let email = document.forms["loginForm"]["email"].value;
    let password = document.forms["loginForm"]["password"].value;

    let isValid = true;

    // Email validation
    if (isEmpty(email)) {
        setError('login_email_error', 'Email is required.');
        isValid = false;
    } else if (!isValidPattern(email, /^[^ ]+@[^ ]+\.[a-z]{2,3}$/)) {
        setError('login_email_error', 'Invalid email format.');
        isValid = false;
    } else {
        clearError('login_email_error');
    }

    // Password validation
    if (isEmpty(password)) {
        setError('login_password_error', 'Password is required.');
        isValid = false;
    } else if (!isValidPattern(password, /^(?=.*[A-Z])(?=.*[!@#$%^&*])[A-Za-z\d!@#$%^&*]{6,}$/)) {
        setError('login_password_error', 'Invalid Password.');
        isValid = false;
    } else {
        clearError('login_password_error');
    }

    return isValid;
}

//-------------------------------------Profile Form Validation--------------
function validateProfileForm() {
    let form = document.forms["profileForm"];
    let height = form["height"].value;
    let weight = form["weight"].value;
    let religion = form["religion"].value;
    let caste = form["caste"].value;
    let motherTongue = form["mother_tongue"].value;
    let maritalStatus = form["marital_status"].value;
    let education = form["education"].value;
    let occupation = form["occupation"].value;
    let income = form["income"].value;
    let city = form["city"].value;
    let state = form["state"].value;
    let country = form["country"].value;
    let address = form["address"].value;
    let hobbies = form["hobbies"].value;
    let aboutMe = form["about_me"].value;
    let profilePhoto = form["profile_photo"].files.length;

    let isValid = true;

    // Height validation
    if (isEmpty(height)) {
        setError('height_error', 'Height is required');
        isValid = false;
    } else {
        clearError('height_error');
    }

    // Weight validation
    if (isEmpty(weight)) {
        setError('weight_error', 'Weight is required');
        isValid = false;
    } else {
        clearError('weight_error');
    }

    // Religion validation
    if (isEmpty(religion)) {
        setError('religion_error', 'Religion is required');
        isValid = false;
    } else {
        clearError('religion_error');
    }

    // Caste validation
    if (isEmpty(caste)) {
        setError('caste_error', 'Caste is required');
        isValid = false;
    } else {
        clearError('caste_error');
    }

    // Mother Tongue validation
    if (isEmpty(motherTongue)) {
        setError('mother_tongue_error', 'Mother Tongue is required');
        isValid = false;
    } else {
        clearError('mother_tongue_error');
    }

    // Marital Status validation
    if (isEmpty(maritalStatus)) {
        setError('marital_status_error', 'Marital Status is required');
        isValid = false;
    } else {
        clearError('marital_status_error');
    }

    // Education validation
    if (isEmpty(education)) {
        setError('education_error', 'Education is required');
        isValid = false;
    } else {
        clearError('education_error');
    }

    // Occupation validation
    if (isEmpty(occupation)) {
        setError('occupation_error', 'Occupation is required');
        isValid = false;
    } else {
        clearError('occupation_error');
    }

    // Income validation
    if (isEmpty(income)) {
        setError('income_error', 'Income is required');
        isValid = false;
    } else {
        clearError('income_error');
    }

    // Address validation
    if (isEmpty(address)) {
        setError('address_error', 'Address is required');
        isValid = false;
    } else {
        clearError('address_error');
    }

    // City validation
    if (isEmpty(city)) {
        setError('city_error', 'City is required');
        isValid = false;
    } else {
        clearError('city_error');
    }

    // State validation
    if (isEmpty(state)) {
        setError('state_error', 'State is required');
        isValid = false;
    } else {
        clearError('state_error');
    }

    // Country validation
    if (isEmpty(country)) {
        setError('country_error', 'Country is required');
        isValid = false;
    } else {
        clearError('country_error');
    }

    // Hobbies validation
    if (isEmpty(hobbies)) {
        setError('hobbies_error', 'Hobbies are required');
        isValid = false;
    } else {
        clearError('hobbies_error');
    }

    // About Me validation
    if (isEmpty(aboutMe)) {
        setError('about_me_error', 'About Me is required');
        isValid = false;
    } else {
        clearError('about_me_error');
    }

        // Profile Photo validation
        if (profilePhoto === 0) {
            setError('profile_photo_error', 'Profile Photo is required');
            isValid = false;
        } else {
            clearError('profile_photo_error');
        }

    return isValid;
}

function isEmpty(value) {
    return value.trim() === '';
}





//-------------------------------validateFamilyDetailsForm---------------------------------


function validateFamilyDetailsForm() {
    let form = document.forms["familyDetailsForm"];
    let fatherName = form["father_name"].value;
    let fatherOccupation = form["father_occupation"].value;
    let motherName = form["mother_name"].value;
    let motherOccupation = form["mother_occupation"].value;
    let siblings = form["siblings"].value;
    let familyType = form["family_type"].value;
    let familyStatus = form["family_status"].value;

    let isValid = true;

    // Father's Name validation
    if (isEmpty(fatherName)) {
        setError('father_name_error', 'Father\'s Name is required');
        isValid = false;
    } else {
        clearError('father_name_error');
    }

    // Father's Occupation validation
    if (isEmpty(fatherOccupation)) {
        setError('father_occupation_error', 'Father\'s Occupation is required');
        isValid = false;
    } else {
        clearError('father_occupation_error');
    }

    // Mother's Name validation
    if (isEmpty(motherName)) {
        setError('mother_name_error', 'Mother\'s Name is required');
        isValid = false;
    } else {
        clearError('mother_name_error');
    }

    // Mother's Occupation validation
    if (isEmpty(motherOccupation)) {
        setError('mother_occupation_error', 'Mother\'s Occupation is required');
        isValid = false;
    } else {
        clearError('mother_occupation_error');
    }

    // Siblings validation
    if (isEmpty(siblings) || siblings < 0) {
        setError('siblings_error', 'Number of Siblings is required and must be a non-negative number');
        isValid = false;
    } else {
        clearError('siblings_error');
    }

    // Family Type validation
    if (isEmpty(familyType)) {
        setError('family_type_error', 'Family Type is required');
        isValid = false;
    } else {
        clearError('family_type_error');
    }

    // Family Status validation
    if (isEmpty(familyStatus)) {
        setError('family_status_error', 'Family Status is required');
        isValid = false;
    } else {
        clearError('family_status_error');
    }

    return isValid;
}


//------------------------------Tooltip Functions--------------------

function showTooltip() {
    let tooltip = document.getElementById("password_tooltip");
    tooltip.style.display = "block";
}

function hideTooltip() {
    let tooltip = document.getElementById("password_tooltip");
    tooltip.style.display = "none";
}

function validatePassword() {
    let password = document.getElementById("user_password").value;
    let uppercase = document.getElementById("uppercase");
    let specialChar = document.getElementById("special_char");
    let number = document.getElementById("number");
    let minLength = document.getElementById("min_length");
    let passwordPattern = /^(?=.*[A-Z])(?=.*[!@#$%^&*])(?=.*\d)[A-Za-z\d!@#$%^&*]{6,}$/;

    // Check for uppercase letter
    if (/[A-Z]/.test(password)) {
        uppercase.classList.add("valid");
    } else {
        uppercase.classList.remove("valid");
    }

    // Check for special character
    if (/[!@#$%^&*]/.test(password)) {
        specialChar.classList.add("valid");
    } else {
        specialChar.classList.remove("valid");
    }

    // Check for number
    if (/\d/.test(password)) {
        number.classList.add("valid");
    } else {
        number.classList.remove("valid");
    }

    // Check for minimum length
    if (password.length >= 8) {
        minLength.classList.add("valid");
    } else {
        minLength.classList.remove("valid");
    }

    // Final validation check
    let password_error = document.getElementById("user_password_error");
    if (!password.match(passwordPattern)) {
        password_error.textContent = "Give a strong password.";
    } else {
        password_error.textContent = "";
    }
}

$(document).ready(function() {
    // Function to toggle the active section
    function toggleSectionDisplay(section) {
        // Remove 'active' class from all sections
        $('.profile-section-content').removeClass('active');
        
        // Add 'active' class to the selected section
        $('#' + section).addClass('active');
    }

    // Event listener for buttons
    $('.toggle-btn').on('click', function() {
        // Get the section name from the clicked button's data-section attribute
        var section = $(this).data('section');
        
        // Call the function to toggle the section
        toggleSectionDisplay(section);
    });
});

















