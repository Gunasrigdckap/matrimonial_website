
<?php
session_start();
require __DIR__ . '/../controllers/userProfileController.php';
require __DIR__ . '/../models/DB.php';

// Fetch current user family details

$register_id = $_SESSION['register_id']; // Get logged-in user ID
$familyController = new UserProfileController($conn);
$familyDetails = $familyController->getCurrentUserProfile($register_id);

// Define default values for fields if the data is not available
$default_father_name = isset($familyDetails['father_name']) ? $familyDetails['father_name'] : '';
$default_mother_name = isset($familyDetails['mother_name']) ? $familyDetails['mother_name'] : '';
$default_father_occupation = isset($familyDetails['father_occupation']) ? $familyDetails['father_occupation'] : '';
$default_mother_occupation = isset($familyDetails['mother_occupation']) ? $familyDetails['mother_occupation'] : '';
$default_siblings = isset($familyDetails['siblings']) ? $familyDetails['siblings'] : '';
$default_family_type = isset($familyDetails['family_type']) ? $familyDetails['family_type'] : '';
$default_family_status = isset($familyDetails['family_status']) ? $familyDetails['family_status'] : '';
$default_family_details = isset($familyDetails['family_details']) ? $familyDetails['family_details'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/family_details.css">
    <link rel="stylesheet" href="/assets/css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

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
<?php require __DIR__ . '/partials/header/header.php'; ?>
<div class="Skip-container">
    <h1 class="skip">
        <a href="/index.php">Skip</a>
    </h1>
</div> 
<body>
    <form name="familyDetailsForm" action="/controllers/familyDetailsController.php" method="POST" onsubmit="return validateFamilyDetailsForm()">
    <div>
            <label for="father_name">Father's Name:</label>
            <input type="text" id="father_name" name="father_name" value="<?php echo $default_father_name; ?>">
            <span class="error_messages" id="father_name_error"></span>
        </div>

        <div>
            <label for="father_occupation">Father's Occupation:</label>
            <select id="father_occupation" name="father_occupation">
                <option value="">Select Occupation</option>
                <option value="Engineer" <?php if($default_father_occupation == "Engineer") echo "selected"; ?>>Engineer</option>
                <option value="Doctor" <?php if($default_father_occupation == "Doctor") echo "selected"; ?>>Doctor</option>
                <option value="Teacher" <?php if($default_father_occupation == "Teacher") echo "selected"; ?>>Teacher</option>
                <option value="Businessman" <?php if($default_father_occupation == "Businessman") echo "selected"; ?>>Businessman</option>
                <option value="Farmer" <?php if($default_father_occupation == "Farmer") echo "selected"; ?>>Farmer</option>
                <option value="Retired" <?php if($default_father_occupation == "Retired") echo "selected"; ?>>Retired</option>
                <!-- Add more options if needed -->
            </select>
            <span class="error_messages" id="father_occupation_error"></span>
        </div>

        <div>
            <label for="mother_name">Mother's Name:</label>
            <input type="text" id="mother_name" name="mother_name" value="<?php echo $default_mother_name; ?>">
            <span class="error_messages" id="mother_name_error"></span>
        </div>

        <div>
            <label for="mother_occupation">Mother's Occupation:</label>
            <select id="mother_occupation" name="mother_occupation">
                <option value="">Select Occupation</option>
                <option value="Homemaker" <?php if($default_mother_occupation == "Homemaker") echo "selected"; ?>>Homemaker</option>
                <option value="Teacher" <?php if($default_mother_occupation == "Teacher") echo "selected"; ?>>Teacher</option>
                <option value="Doctor" <?php if($default_mother_occupation == "Doctor") echo "selected"; ?>>Doctor</option>
                <option value="Businesswoman" <?php if($default_mother_occupation == "Businesswoman") echo "selected"; ?>>Businesswoman</option>
                <option value="Engineer" <?php if($default_mother_occupation == "Engineer") echo "selected"; ?>>Engineer</option>
                <option value="Retired" <?php if($default_mother_occupation == "Retired") echo "selected"; ?>>Retired</option>
                <!-- Add more options if needed -->
            </select>
            <span class="error_messages" id="mother_occupation_error"></span>
        </div>

        <div>
            <label for="siblings">Number of Siblings:</label>
            <input type="number" id="siblings" name="siblings" value="<?php echo $default_siblings; ?>">
            <span class="error_messages" id="siblings_error"></span>
        </div>

        <div>
            <label for="family_type">Family Type:</label>
            <select id="family_type" name="family_type">
                <option value="">Select Family Type</option>
                <option value="Nuclear" <?php if($default_family_type == "Nuclear") echo "selected"; ?>>Nuclear</option>
                <option value="Joint" <?php if($default_family_type == "Joint") echo "selected"; ?>>Joint</option>
            </select>
            <span class="error_messages" id="family_type_error"></span>
        </div>

        <div>
            <label for="family_status">Family Status:</label>
            <select id="family_status" name="family_status">
                <option value="">Select Family Status</option>
                <option value="Middle Class" <?php if($default_family_status == "Middle Class") echo "selected"; ?>>Middle Class</option>
                <option value="Upper Middle Class" <?php if($default_family_status == "Upper Middle Class") echo "selected"; ?>>Upper Middle Class</option>
                <option value="Rich" <?php if($default_family_status == "Rich") echo "selected"; ?>>Rich</option>
            </select>
            <span class="error_messages" id="family_status_error"></span>
        </div>

        <?php if ($default_father_name): ?>
              <button id="updateFamilyDetailsBtn" type="submit" class="family_button" value="update" name="action">Update Family Details</button>
        <?php else: ?>
              <button type="submit" value="save" class="family_button" name="action">Save Family Details</button>
        <?php endif; ?>

    </form>
</body>
</html>
