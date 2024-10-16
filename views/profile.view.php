<?php
session_start();
require __DIR__ . '/../controllers/userProfileController.php';
require __DIR__ . '/../models/DB.php';

// Fetch current user profile data
$register_id = $_SESSION['register_id']; // Get logged-in user ID
$profileController = new UserProfileController($conn);
$userProfile = $profileController->getCurrentUserProfile($register_id);

// Define default values for fields if the data is not available
$default_height = isset($userProfile['height']) ? $userProfile['height'] : '';
$default_weight = isset($userProfile['weight']) ? $userProfile['weight'] : '';
$default_religion = isset($userProfile['religion']) ? $userProfile['religion'] : '';
$default_caste = isset($userProfile['caste']) ? $userProfile['caste'] : '';
$default_mother_tongue = isset($userProfile['mother_tongue']) ? $userProfile['mother_tongue'] : '';
$default_marital_status = isset($userProfile['marital_status']) ? $userProfile['marital_status'] : '';
$default_education = isset($userProfile['education']) ? $userProfile['education'] : '';
$default_occupation = isset($userProfile['occupation']) ? $userProfile['occupation'] : '';
$default_income = isset($userProfile['income']) ? $userProfile['income'] : '';
$default_city = isset($userProfile['city']) ? $userProfile['city'] : '';
$default_state = isset($userProfile['state']) ? $userProfile['state'] : '';
$default_country = isset($userProfile['country']) ? $userProfile['country'] : '';
$default_address = isset($userProfile['address']) ? $userProfile['address'] : '';
$default_hobbies = isset($userProfile['hobbies']) ? $userProfile['hobbies'] : '';
$default_about_me = isset($userProfile['about_me']) ? $userProfile['about_me'] : '';
// $storedImagePath = isset($userProfile['profile_photo_path']) ? $userProfile['profile_photo_path'] : '';
$default_profile_photo = isset($userProfile['profile_photo']) ? $userProfile['profile_photo'] : '';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/profile.css">
    <link rel="stylesheet" href="/assets/css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <title>User Profile</title>
    <script src="/assets/js/register_login_validation.js"></script>
    <script src="/assets/js/validationUtils.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<?php require __DIR__ . '/partials/header/header.php'; ?>

<div class="Skip-container">
    <h1 class="skip">
        <a href="/index.php">Skip</a>
    </h1>
</div>

<form name="profileForm" action="/controllers/profileController.php" method="POST" enctype="multipart/form-data" onsubmit="return validateProfileForm()">
    <div>
        <label for="height">Height (in cm):</label>
        <select id="height" name="height">
            <option value="">Select Height</option>
            <option value="150" <?php if($default_height == "150") echo "selected"; ?>>150 cm</option>
            <option value="160" <?php if($default_height == "160") echo "selected"; ?>>160 cm</option>
            <option value="170" <?php if($default_height == "170") echo "selected"; ?>>170 cm</option>
            <option value="180" <?php if($default_height == "180") echo "selected"; ?>>180 cm</option>
        </select>
        <span class="error_messages" id="height_error"></span>
    </div>

    <div>
        <label for="weight">Weight (in kg):</label>
        <select id="weight" name="weight">
            <option value="">Select Weight</option>
            <option value="50" <?php if($default_weight == "50") echo "selected"; ?>>50 kg</option>
            <option value="60" <?php if($default_weight == "60") echo "selected"; ?>>60 kg</option>
            <option value="70" <?php if($default_weight == "70") echo "selected"; ?>>70 kg</option>
            <option value="80" <?php if($default_weight == "80") echo "selected"; ?>>80 kg</option>
        </select>
        <span class="error_messages" id="weight_error"></span>
    </div>

    <div>
        <label for="religion">Religion:</label>
        <select id="religion" name="religion">
            <option value="">Select Religion</option>
            <option value="hindu" <?php if($default_religion == "hindu") echo "selected"; ?>>Hindu</option>
            <option value="muslim" <?php if($default_religion == "muslim") echo "selected"; ?>>Muslim</option>
            <option value="christian" <?php if($default_religion == "christian") echo "selected"; ?>>Christian</option>
            <option value="other" <?php if($default_religion == "other") echo "selected"; ?>>Other</option>
        </select>
        <span class="error_messages" id="religion_error"></span>
    </div>

    <div>
        <label for="caste">Caste:</label>
        <select id="caste" name="caste">
            <option value="">Select Caste</option>
            <option value="general" <?php if($default_caste == "general") echo "selected"; ?>>General</option>
            <option value="obc" <?php if($default_caste == "obc") echo "selected"; ?>>OBC</option>
            <option value="sc" <?php if($default_caste == "sc") echo "selected"; ?>>SC</option>
            <option value="st" <?php if($default_caste == "st") echo "selected"; ?>>ST</option>
            <option value="bc" <?php if($default_caste == "bc") echo "selected"; ?>>BC</option>
        </select>
        <span class="error_messages" id="caste_error"></span>
    </div>

    <div>
        <label for="mother_tongue">Mother Tongue:</label>
        <select id="mother_tongue" name="mother_tongue">
            <option value="">Select Mother Tongue</option>
            <option value="tamil" <?php if($default_mother_tongue == "tamil") echo "selected"; ?>>Tamil</option>
            <option value="telugu" <?php if($default_mother_tongue == "telugu") echo "selected"; ?>>Telugu</option>
            <option value="hindi" <?php if($default_mother_tongue == "hindi") echo "selected"; ?>>Hindi</option>
            <option value="english" <?php if($default_mother_tongue == "english") echo "selected"; ?>>English</option>
        </select>
        <span class="error_messages" id="mother_tongue_error"></span>
    </div>

    <div>
        <label for="marital_status">Marital Status:</label>
        <select id="marital_status" name="marital_status">
            <option value="">Select Status</option>
            <option value="single" <?php if($default_marital_status == "single") echo "selected"; ?>>Single</option>
            <option value="married" <?php if($default_marital_status == "married") echo "selected"; ?>>Married</option>
            <option value="divorced" <?php if($default_marital_status == "divorced") echo "selected"; ?>>Divorced</option>
            <option value="widowed" <?php if($default_marital_status == "widowed") echo "selected"; ?>>Widowed</option>
        </select>
        <span class="error_messages" id="marital_status_error"></span>
    </div>

    <div>
        <label for="education">Education:</label>
        <select id="education" name="education">
            <option value="">Select Education</option>
            <option value="none" <?php if($default_education == "none") echo "selected"; ?>>None</option>
            <option value="high_school" <?php if($default_education == "high_school") echo "selected"; ?>>High School</option>
            <option value="bachelor" <?php if($default_education == "bachelor") echo "selected"; ?>>Bachelor's Degree</option>
            <option value="master" <?php if($default_education == "master") echo "selected"; ?>>Master's Degree</option>
            <option value="phd" <?php if($default_education == "phd") echo "selected"; ?>>PhD</option>
            <option value="sslc" <?php if($default_education == "sslc") echo "selected"; ?>>SSLC</option>
        </select>
        <span class="error_messages" id="education_error"></span>
    </div>

    <div>
    <label for="occupation">Occupation:</label>
    <select name="occupation" id="occupation">
        <option value="">Any</option>
        <option value="doctor" <?php if($default_occupation == "doctor") echo "selected"; ?>>Doctor</option>
        <option value="engineer" <?php if($default_occupation == "engineer") echo "selected"; ?>>Engineer</option>
        <option value="teacher" <?php if($default_occupation == "teacher") echo "selected"; ?>>Teacher</option>
        <option value="lawyer" <?php if($default_occupation == "lawyer") echo "selected"; ?>>Lawyer</option>
        <option value="architect" <?php if($default_occupation == "architect") echo "selected"; ?>>Architect</option>
        <option value="business" <?php if($default_occupation == "business") echo "selected"; ?>>Business</option>
        <option value="accountant" <?php if($default_occupation == "accountant") echo "selected"; ?>>Accountant</option>
        <option value="nurse" <?php if($default_occupation == "nurse") echo "selected"; ?>>Nurse</option>
        <option value="civil_servant" <?php if($default_occupation == "civil_servant") echo "selected"; ?>>Civil Servant</option>
        <option value="other" <?php if($default_occupation == "other") echo "selected"; ?>>Other</option>
    </select>
    <span class="error_messages" id="occupation_error"></span>
</div>

  
<div>
    <label for="income">Annual Income (in INR):</label>
    <select id="income" name="income">
        <option value="">Select Income Range</option>
        <option value="0-100000" <?php if($default_income == "below-1-lakh") echo "selected"; ?>>Below ₹1 Lakh</option>
        <option value="100000-200000" <?php if($default_income == "1-2-lakhs") echo "selected"; ?>>₹1 Lakh - ₹2 Lakhs</option>
        <option value="200000-300000" <?php if($default_income == "2-3-lakhs") echo "selected"; ?>>₹2 Lakhs - ₹3 Lakhs</option>
        <option value="300000-400000" <?php if($default_income == "3-4-lakhs") echo "selected"; ?>>₹3 Lakhs - ₹4 Lakhs</option>
        <option value="400000-500000" <?php if($default_income == "4-5-lakhs") echo "selected"; ?>>₹4 Lakhs - ₹5 Lakhs</option>
        <option value="500000-1000000" <?php if($default_income == "5-10-lakhs") echo "selected"; ?>>₹5 Lakhs - ₹10 Lakhs</option>
        <option value="1000000-2000000" <?php if($default_income == "10-20-lakhs") echo "selected"; ?>>₹10 Lakhs - ₹20 Lakhs</option>
        <option value="2000000+" <?php if($default_income == "above-20-lakhs") echo "selected"; ?>>Above ₹20 Lakhs</option>
    </select>
    <span class="error_messages" id="income_error"></span>
</div>



    <div>
    <label for="country">Country:</label>
    <select id="country" name="country" onchange="fetchStates(this.value)">
        <option value="">Select Country</option>
        <option value="india" <?php if($default_country == "india") echo "selected"; ?>>India</option>
        <option value="usa" <?php if($default_country == "usa") echo "selected"; ?>>USA</option>
        <!-- Add more countries as needed -->
    </select>
    <span class="error_messages" id="country_error"></span>
</div>

<div>
    <label for="state">State:</label>
    <select id="state" name="state" onchange="fetchCities(this.value)" disabled>
        <option value="">Select State</option>
        <!-- Dynamic state options will be loaded here -->
        <option value="<?php echo htmlspecialchars($default_state); ?>" selected><?php echo htmlspecialchars($default_state); ?></option>
    </select>
    <span class="error_messages" id="state_error"></span>
</div>

<div>
    <label for="city">City:</label>
    <select id="city" name="city" disabled>
        <option value="">Select City</option>
        <!-- Dynamic city options will be loaded here -->
        <option value="<?php echo htmlspecialchars($default_city); ?>" selected><?php echo htmlspecialchars($default_city); ?></option>
    </select>
    <span class="error_messages" id="city_error"></span>
</div>


    <!-- <div>
    <label for="country">Country:</label>
    <select id="country" name="country">
        <option value="">Select Country</option>
        <option value="india" <?php if($default_country == "india") echo "selected"; ?>>India</option>
        <option value="usa" <?php if($default_country == "usa") echo "selected"; ?>>USA</option>
        <option value="uk" <?php if($default_country == "uk") echo "selected"; ?>>UK</option>
        <option value="canada" <?php if($default_country == "canada") echo "selected"; ?>>Canada</option>
        <option value="australia" <?php if($default_country == "australia") echo "selected"; ?>>Australia</option>
      
    </select>
    <span class="error_messages" id="country_error"></span>
    </div>

 
    <div>
    <label for="state">State:</label>
    <select id="state" name="state">
        <option value="">Select State</option>
        <option value="tamil_nadu" <?php if($default_state == "tamil_nadu") echo "selected"; ?>>Tamil Nadu</option>
        <option value="karnataka" <?php if($default_state == "karnataka") echo "selected"; ?>>Karnataka</option>
        <option value="maharashtra" <?php if($default_state == "maharashtra") echo "selected"; ?>>Maharashtra</option>
        <option value="delhi" <?php if($default_state == "delhi") echo "selected"; ?>>Delhi</option>
        <option value="uttar_pradesh" <?php if($default_state == "uttar_pradesh") echo "selected"; ?>>Uttar Pradesh</option>
    
    </select>
    <span class="error_messages" id="state_error"></span>
    </div>

    <div>
    <label for="city">City:</label>
    <select id="city" name="city">
        <option value="">Select City</option>
        <option value="chennai" <?php if($default_city == "chennai") echo "selected"; ?>>Chennai</option>
        <option value="trichy" <?php if($default_city == "trichy") echo "selected"; ?>>Trichy</option>
        <option value="bangalore" <?php if($default_city == "bangalore") echo "selected"; ?>>Bangalore</option>
        <option value="mumbai" <?php if($default_city == "mumbai") echo "selected"; ?>>Mumbai</option>
        <option value="delhi" <?php if($default_city == "delhi") echo "selected"; ?>>Delhi</option>
      
    </select>
    <span class="error_messages" id="city_error"></span>
    </div> -->

    <div>
        <label for="address">Address:</label>
        <textarea id="address" name="address"><?php echo $default_address; ?></textarea>
        <span class="error_messages" id="address_error"></span>
    </div>

    <div>
        <label for="hobbies">Hobbies:</label>
        <textarea id="hobbies" name="hobbies"><?php echo $default_hobbies; ?></textarea>
        <span class="error_messages" id="hobbies_error"></span>
    </div>

    <div>
        <label for="about_me">About Me:</label>
        <textarea id="about_me" name="about_me"><?php echo $default_about_me; ?></textarea>
        <span class="error_messages" id="about_me_error"></span>
    </div>

        <div>
        <label for="profile_photo">Profile Photo:</label>
        <input type="file" id="profile_photo" name="profile_photo" accept="image/*" onchange="previewImage(event)" value="<?php echo $storedImagePath; ?>">
        <span class="error_messages" id="profile_photo_error"></span>
        </div>

        <!-- Preview the selected image -->
        <div id="imagePreview">
         <img id="profileImage" src="<?php echo !empty($default_profile_photo) ? $default_profile_photo : ''; ?>" 
        alt="Selected Profile Photo" style="<?php echo !empty($default_profile_photo) ? '' : 'display:none;'; ?>" />
        </div>

     <?php if ($default_address): ?>
     <button id="updateProfileBtn" type="submit" class="profile_button" value="update" name="action">Update Profile</button>

     <?php else: ?>
     <button type="submit" value="save" class="profile_button" name="action">Save Profile</button>

     <?php endif; ?>

  
</form>

</body>
</html>
