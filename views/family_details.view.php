<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/family_details.css">
    <title>Family Details</title>
    <script src="/assets/js/register_login_validation.js"></script>
    <script src="/assets/js/validationUtils.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .progress-container { width: 100%; background-color: #f3f3f3; border-radius: 5px; margin-bottom: 20px; }
        .progress-bar { height: 25px; background-color: #4caf50; width: 100%; border-radius: 5px; text-align: center; line-height: 25px; color: white; }
    </style>
</head>
<!-- <div class="progress-container">
    <div class="progress-bar">100%</div>
</div> -->
<body>
    <form name="familyDetailsForm" action="/controllers/familyDetailsController.php" method="POST" onsubmit="return validateFamilyDetailsForm()">
        <div>
            <label for="father_name">Father's Name:</label>
            <input type="text" id="father_name" name="father_name">
            <span class="error_messages" id="father_name_error"></span>
        </div>

        <div>
            <label for="father_occupation">Father's Occupation:</label>
            <select id="father_occupation" name="father_occupation">
                <option value="">Select Occupation</option>
                <option value="Engineer">Engineer</option>
                <option value="Doctor">Doctor</option>
                <option value="Teacher">Teacher</option>
                <option value="Businessman">Businessman</option>
                <option value="Farmer">Farmer</option>
                <option value="Retired">Retired</option>
                <!-- Add more options if needed -->
            </select>
            <span class="error_messages" id="father_occupation_error"></span>
        </div>

        <div>
            <label for="mother_name">Mother's Name:</label>
            <input type="text" id="mother_name" name="mother_name">
            <span class="error_messages" id="mother_name_error"></span>
        </div>

        <div>
            <label for="mother_occupation">Mother's Occupation:</label>
            <select id="mother_occupation" name="mother_occupation">
                <option value="">Select Occupation</option>
                <option value="Homemaker">Homemaker</option>
                <option value="Teacher">Teacher</option>
                <option value="Doctor">Doctor</option>
                <option value="Businesswoman">Businesswoman</option>
                <option value="Engineer">Engineer</option>
                <option value="Retired">Retired</option>
                <!-- Add more options if needed -->
            </select>
            <span class="error_messages" id="mother_occupation_error"></span>
        </div>

        <div>
            <label for="siblings">Number of Siblings:</label>
            <input type="number" id="siblings" name="siblings">
            <span class="error_messages" id="siblings_error"></span>
        </div>

        <div>
            <label for="family_type">Family Type:</label>
            <select id="family_type" name="family_type">
                <option value="Nuclear">Nuclear</option>
                <option value="Joint">Joint</option>
            </select>
            <span class="error_messages" id="family_type_error"></span>
        </div>

        <div>
            <label for="family_status">Family Status:</label>
            <select id="family_status" name="family_status">
                <option value="Middle Class">Middle Class</option>
                <option value="Upper Middle Class">Upper Middle Class</option>
                <option value="Rich">Rich</option>
            </select>
            <span class="error_messages" id="family_status_error"></span>
        </div>

        <button type="submit" value="Save" class="family_button">Save Family Details</button>
    </form>
</body>
</html>
