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
    let ageDif = currentDate - birthDate;
    let ageDate = new Date(ageDif);
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
            login_password_error.textContent = 'Give Strong Password';
            isValid = false;
        }
    }

    return isValid;
}
function validateProfileForm() {
    let height = document.forms["profileForm"]["height"].value;
    let weight = document.forms["profileForm"]["weight"].value;
    let religion = document.forms["profileForm"]["religion"].value;
    let caste = document.forms["profileForm"]["caste"].value;
    let motherTongue = document.forms["profileForm"]["mother_tongue"].value;
    let maritalStatus = document.forms["profileForm"]["marital_status"].value;
    let education = document.forms["profileForm"]["education"].value;
    let occupation = document.forms["profileForm"]["occupation"].value;
    let income = document.forms["profileForm"]["income"].value;
    let address = document.forms["profileForm"]["address"].value;
    let city = document.forms["profileForm"]["city"].value;
    let state = document.forms["profileForm"]["state"].value;
    let country = document.forms["profileForm"]["country"].value;
    let hobbies = document.forms["profileForm"]["hobbies"].value;
    let aboutMe = document.forms["profileForm"]["about_me"].value;
    let profilePhoto = document.forms["profileForm"]["profile_photo"].files.length;

    let heightError = document.getElementById('height_error');
    let weightError = document.getElementById('weight_error');
    let religionError = document.getElementById('religion_error');
    let casteError = document.getElementById('caste_error');
    let motherTongueError = document.getElementById('mother_tongue_error');
    let maritalStatusError = document.getElementById('marital_status_error');
    let educationError = document.getElementById('education_error');
    let occupationError = document.getElementById('occupation_error');
    let incomeError = document.getElementById('income_error');
    let addressError = document.getElementById('address_error');
    let cityError = document.getElementById('city_error');
    let stateError = document.getElementById('state_error');
    let countryError = document.getElementById('country_error');
    let hobbiesError = document.getElementById('hobbies_error');
    let aboutMeError = document.getElementById('about_me_error');
    let profilePhotoError = document.getElementById('profile_photo_error');

    let isValid = true;

    // Reset error messages
    heightError.textContent = '';
    weightError.textContent = '';
    religionError.textContent = '';
    casteError.textContent = '';
    motherTongueError.textContent = '';
    maritalStatusError.textContent = '';
    educationError.textContent = '';
    occupationError.textContent = '';
    incomeError.textContent = '';
    addressError.textContent = '';
    cityError.textContent = '';
    stateError.textContent = '';
    countryError.textContent = '';
    hobbiesError.textContent = '';
    aboutMeError.textContent = '';
    profilePhotoError.textContent = '';

    // Height validation
    if (height === '' || height <= 0) {
        heightError.textContent = 'Height is required';
        isValid = false;
    }

    // Weight validation
    if (weight === '' || weight <= 0) {
        weightError.textContent = 'Weight is required';
        isValid = false;
    }

    // Religion validation
    if (religion === '') {
        religionError.textContent = 'Religion is required';
        isValid = false;
    }

    // Caste validation
    if (caste === '') {
        casteError.textContent = 'Caste is required';
        isValid = false;
    }

    // Mother Tongue validation
    if (motherTongue === '') {
        motherTongueError.textContent = 'Mother Tongue is required';
        isValid = false;
    }

    // Marital Status validation
    if (maritalStatus === '') {
        maritalStatusError.textContent = 'Marital Status is required';
        isValid = false;
    }

    // Education validation
    if (education === '') {
        educationError.textContent = 'Education is required';
        isValid = false;
    }

    // Occupation validation
    if (occupation === '') {
        occupationError.textContent = 'Occupation is required';
        isValid = false;
    }

    // Income validation
    if (income === '' || income <= 0) {
        incomeError.textContent = 'Income is required and must be a positive number';
        isValid = false;
    }

    // Address validation
    if (address === '') {
        addressError.textContent = 'Address is required';
        isValid = false;
    }

    // City validation
    if (city === '') {
        cityError.textContent = 'City is required';
        isValid = false;
    }

    // State validation
    if (state === '') {
        stateError.textContent = 'State is required';
        isValid = false;
    }

    // Country validation
    if (country === '') {
        countryError.textContent = 'Country is required';
        isValid = false;
    }

    // Hobbies validation
    if (hobbies === '') {
        hobbiesError.textContent = 'Hobbies are required';
        isValid = false;
    }

    // About Me validation
    if (aboutMe === '') {
        aboutMeError.textContent = 'About Me is required';
        isValid = false;
    }

    // Profile Photo validation
    if (profilePhoto === 0) {
        profilePhotoError.textContent = 'Profile Photo is required';
        isValid = false;
    }

    
    return isValid;
}

function validateFamilyDetailsForm() {
    let fatherName = document.forms["familyDetailsForm"]["father_name"].value;
    let fatherOccupation = document.forms["familyDetailsForm"]["father_occupation"].value;
    let motherName = document.forms["familyDetailsForm"]["mother_name"].value;
    let motherOccupation = document.forms["familyDetailsForm"]["mother_occupation"].value;
    let siblings = document.forms["familyDetailsForm"]["siblings"].value;
    let familyType = document.forms["familyDetailsForm"]["family_type"].value;
    let familyStatus = document.forms["familyDetailsForm"]["family_status"].value;

    let fatherNameError = document.getElementById('father_name_error');
    let fatherOccupationError = document.getElementById('father_occupation_error');
    let motherNameError = document.getElementById('mother_name_error');
    let motherOccupationError = document.getElementById('mother_occupation_error');
    let siblingsError = document.getElementById('siblings_error');
    let familyTypeError = document.getElementById('family_type_error');
    let familyStatusError = document.getElementById('family_status_error');

    let isValid = true;

    // Reset error messages
    fatherNameError.textContent = '';
    fatherOccupationError.textContent = '';
    motherNameError.textContent = '';
    motherOccupationError.textContent = '';
    siblingsError.textContent = '';
    familyTypeError.textContent = '';
    familyStatusError.textContent = '';

    // Validate Father's Name
    if (fatherName === '') {
        fatherNameError.textContent = 'Father\'s Name is required';
        isValid = false;
    }

    // Validate Father's Occupation
    if (fatherOccupation === '') {
        fatherOccupationError.textContent = 'Father\'s Occupation is required';
        isValid = false;
    }

    // Validate Mother's Name
    if (motherName === '') {
        motherNameError.textContent = 'Mother\'s Name is required';
        isValid = false;
    }

    // Validate Mother's Occupation
    if (motherOccupation === '') {
        motherOccupationError.textContent = 'Mother\'s Occupation is required';
        isValid = false;
    }

    // Validate Number of Siblings
    if (siblings === '' || siblings < 0) {
        siblingsError.textContent = 'Number of siblings is required';
        isValid = false;
    }

    // Validate Family Type
    if (familyType === '') {
        familyTypeError.textContent = 'Family Type is required';
        isValid = false;
    }

    // Validate Family Status
    if (familyStatus === '') {
        familyStatusError.textContent = 'Family Status is required';
        isValid = false;
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
