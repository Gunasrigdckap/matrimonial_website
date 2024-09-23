<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/profile.css">
    <title>User Profile</title>
    <script src="/assets/js/register_login_validation.js"></script>
    <script src="/assets/js/validationUtils.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   
</head>
<body>

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
                <option value="150">150 cm</option>
                <option value="160">160 cm</option>
                <option value="170">170 cm</option>
                <option value="180">180 cm</option>
                
            </select>
            <span class="error_messages" id="height_error"></span>
        </div>

        <div>
            <label for="weight">Weight (in kg):</label>
            <select id="weight" name="weight">
                <option value="">Select Weight</option>
                <option value="50">50 kg</option>
                <option value="60">60 kg</option>
                <option value="70">70 kg</option>
                <option value="80">80 kg</option>
                
            </select>
            <span class="error_messages" id="weight_error"></span>
        </div>

        <div>
            <label for="religion">Religion:</label>
            <select id="religion" name="religion">
                <option value="">Select Religion</option>
                <option value="hindu">Hindu</option>
                <option value="muslim">Muslim</option>
                <option value="christian">Christian</option>
                <option value="other">Other</option>
            </select>
            <span class="error_messages" id="religion_error"></span>
        </div>

        <div>
            <label for="caste">Caste:</label>
            <select id="caste" name="caste">
                <option value="">Select Caste</option>
                <option value="general">General</option>
                <option value="obc">OBC</option>
                <option value="sc">SC</option>
                <option value="st">ST</option>
                <option value="bc">BC</option>
            </select>
            <span class="error_messages" id="caste_error"></span>
        </div>

        <div>
            <label for="mother_tongue">Mother Tongue:</label>
            <select id="mother_tongue" name="mother_tongue">
                <option value="">Select Mother Tongue</option>
                <option value="tamil">Tamil</option>
                <option value="telugu">Telugu</option>
                <option value="hindi">Hindi</option>
                <option value="english">English</option>
            </select>
            <span class="error_messages" id="mother_tongue_error"></span>
        </div>

        <div>
            <label for="marital_status">Marital Status:</label>
            <select id="marital_status" name="marital_status">
                <option value="">Select Status</option>
                <option value="single">Single</option>
                <option value="married">Married</option>
                <option value="divorced">Divorced</option>
                <option value="widowed">Widowed</option>
            </select>
            <span class="error_messages" id="marital_status_error"></span>
        </div>

        <div>
            <label for="education">Education:</label>
            <select id="education" name="education">
                <option value="">Select Education</option>
                <option value="bachelor">Bachelor's</option>
                <option value="master">Master's</option>
                <option value="phd">Ph.D.</option>
                <option value="diploma">Diploma</option>
                <option value="sslc">SSLC</option>
                <option value="other">Other</option>
            </select>
            <span class="error_messages" id="education_error"></span>
        </div>

        <div>
            <label for="occupation">Occupation:</label>
            <select id="occupation" name="occupation">
                <option value="">Select Occupation</option>
                <option value="engineer">Engineer</option>
                <option value="doctor">Doctor</option>
                <option value="teacher">Teacher</option>
                <option value="business">Business</option>
                <option value="student">Student</option>
                <option value="other">Other</option>
            </select>
            <span class="error_messages" id="occupation_error"></span>
        </div>

        <div>
            <label for="income">Income (in INR):</label>
            <select id="income" name="income">
                <option value="">Select Income</option>
                <option value="500000">Less than 5 Lakhs</option>
                <option value="1000000">5-10 Lakhs</option>
                <option value="1500000">10-15 Lakhs</option>
                <option value="2000000">15-20 Lakhs</option>
                <option value="2500000">20-25 Lakhs</option>
                <option value="3000000">25-30 Lakhs</option>
            </select>
            <span class="error_messages" id="income_error"></span>
        </div>

        <div>
            <label for="city">City:</label>
            <select id="city" name="city">
                <option value="">Select City</option>
                <option value="chennai">Chennai</option>
                <option value="mumbai">Mumbai</option>
                <option value="bangalore">Bangalore</option>
                <option value="delhi">Delhi</option>
                <option value="kochi">Kochi</option>
                <option value="hyderabad">Hyderabad</option>
                

                
            </select>
            <span class="error_messages" id="city_error"></span>
        </div>

        <div>
            <label for="state">State:</label>
            <select id="state" name="state">
                <option value="">Select State</option>
                <option value="tamilnadu">Tamil Nadu</option>
                <option value="maharashtra">Maharashtra</option>
                <option value="karnataka">Karnataka</option>
                <option value="delhi">Delhi</option>
               <option value="kerala">Kerala</option>
                <option value="japan">Japan</option>
                <option value="china">China</option>


            </select>
            <span class="error_messages" id="state_error"></span>
        </div>

        <div>
            <label for="country">Country:</label>
            <select id="country" name="country">
                <option value="">Select Country</option>
                <option value="india">India</option>
                <option value="usa">USA</option>
                <option value="uk">UK</option>
                <option value="australia">Australia</option>
                <option value="canada">Canada</option>
                <option value="new zealand">New Zealand</option>
                <option value="other">Other</option>
            </select>
            <span class="error_messages" id="country_error"></span>
        </div>

        <div>
            <label for="address">Address:</label>
            <textarea id="address" name="address"></textarea>
            <span class="error_messages" id="address_error"></span>
        </div>
        
        <div>
            <label for="hobbies">Hobbies:</label>
            <textarea id="hobbies" name="hobbies"></textarea>
            <span class="error_messages" id="hobbies_error"></span>
        </div>

        <div>
            <label for="about_me">About Me:</label>
            <textarea id="about_me" name="about_me"></textarea>
            <span class="error_messages" id="about_me_error"></span>
        </div>

        <div>
            <label for="profile_photo">Profile Photo:</label>
            <input type="file" id="profile_photo" name="profile_photo">
            <span class="error_messages" id="profile_photo_error"></span>
        </div>

        <button type="submit" value="Save" class="profile_button">Save Profile</button>
    </form>
</body>
</html>

