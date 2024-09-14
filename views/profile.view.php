<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/profile.css">
    <title>User Profile</title>
    <script src="/assets/js/register_login_validation.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <form name="profileForm" action="/controllers/profileController.php" method="POST" enctype="multipart/form-data" onsubmit="return validateProfileForm()">
        <div>
            <label for="height">Height (in cm):</label>
            <input type="number" id="height" name="height" step="0.1">
            <span class="error_messages" id="height_error"></span>
        </div>

        <div>
            <label for="weight">Weight (in kg):</label>
            <input type="number" id="weight" name="weight" step="0.1">
            <span class="error_messages" id="weight_error"></span>
        </div>

        <div>
            <label for="religion">Religion:</label>
            <input type="text" id="religion" name="religion">
            <span class="error_messages" id="religion_error"></span>
        </div>

        <div>
            <label for="caste">Caste:</label>
            <input type="text" id="caste" name="caste">
            <span class="error_messages" id="caste_error"></span>
        </div>

        <div>
            <label for="mother_tongue">Mother Tongue:</label>
            <input type="text" id="mother_tongue" name="mother_tongue">
            <span class="error_messages" id="mother_tongue_error"></span>
        </div>

        <div>
            <label for="marital_status">Marital Status:</label>
            <select id="marital_status" name="marital_status">
                <option value="single">Single</option>
                <option value="married">Married</option>
                <option value="divorced">Divorced</option>
                <option value="widowed">Widowed</option>
            </select>
            <span class="error_messages" id="marital_status_error"></span>
        </div>

        <div>
            <label for="education">Education:</label>
            <input type="text" id="education" name="education">
            <span class="error_messages" id="education_error"></span>
        </div>

        <div>
            <label for="occupation">Occupation:</label>
            <input type="text" id="occupation" name="occupation">
            <span class="error_messages" id="occupation_error"></span>
        </div>

        <div>
            <label for="income">Income (in INR):</label>
            <input type="number" id="income" name="income" step="0.1">
            <span class="error_messages" id="income_error"></span>
        </div>

        <div>
            <label for="address">Address:</label>
            <textarea id="address" name="address"></textarea>
            <span class="error_messages" id="address_error"></span>
        </div>

        <div>
            <label for="city">City:</label>
            <input type="text" id="city" name="city">
            <span class="error_messages" id="city_error"></span>
        </div>

        <div>
            <label for="state">State:</label>
            <input type="text" id="state" name="state">
            <span class="error_messages" id="state_error"></span>
        </div>

        <div>
            <label for="country">Country:</label>
            <input type="text" id="country" name="country">
            <span class="error_messages" id="country_error"></span>
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
