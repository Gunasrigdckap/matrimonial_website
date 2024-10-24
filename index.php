<?php
// session_start();
require __DIR__ . '/models/DB.php';
require __DIR__ . '/controllers/userController.php';
require __DIR__ .'/controllers/userProfileController.php';

$userid = isset($_SESSION["register_id"]) ? $_SESSION["register_id"] : null;


// Delete profile logic
if (isset($_POST['delete_profile'])) {
    $profileController = new  UserProfileController($conn); 
    
    if ($profileController->deleteProfile($userid)) {
        session_destroy(); // Clear session
        header("Location: /login.php?message=Profile deleted successfully."); 
        exit();
    } else {
        echo "Error deleting profile.";
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Registered Users</title>
    <link rel="stylesheet" href="/assets/css/index.css">
    <script src="/assets/js/register_login_validation.js"></script>
    <script src="/assets/js/validationUtils.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="/assets/js/popupFunctionality.js"></script>
    
</head>

<body>

    <!-- Navbar -->
    <?php require __DIR__ . '/views/partials/header/header.php'; ?>

    <!-- Main Section -->
    <div class="main-container">
        <div class="slogan_container">
            <h1 class="matrimonial_slogan">Discover love, embrace the journey,<br> Together, we'll build your future.</h1>
        </div>
    </div>

    <!-- Users and Filters Section -->
    <div class="users-container-main">
        <?php if ($userid): ?>
            <div class="filter-container">
                <h2>Filter Users</h2>
                <form id="filter-form" method="POST" action="index.php" onsubmit="return applyFilters(event)">
                    <!-- Gender Filter -->
                    <div class="filter-group">
                        <h3>Gender</h3>
                        <label><input type="radio" name="gender" value="male"> Male</label><br>
                        <label><input type="radio" name="gender" value="female"> Female</label>
                        <!-- <label><input type="radio" name="gender" value="other"> Other</label> -->
                    </div>

                <!-- Age Filter -->
                <div class="filter-group">
                    <h3>Age Range</h3>
                    <div id="age-range-container">
                        <input type="range" id="min-age" name="age_min" min="18" max="60" value="18" oninput="updateRange()">
                        <input type="range" id="max-age" name="age_max" min="18" max="60" value="60" oninput="updateRange()">
                    </div>
                    <div id="age-range-display">
                        <span id="min-age-display">18</span> - <span id="max-age-display">60</span> years
                    </div>
                </div>



                    <!-- Religion Filter -->
                    <div class="filter-group">
                        <h3>Religion</h3>
                        <select name="religion" id="religion">
                            <option value="">Any</option>
                            <option value="hindu">Hindu</option>
                            <option value="muslim">Muslim</option>
                            <option value="christian">Christian</option>
                            <option value="sikh">Sikh</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <!-- Caste Filter -->
                    <div class="filter-group">
                        <h3>Caste</h3>
                        <select name="caste" id="caste">
                            <option value="">Any</option>
                            <option value="general">General</option>
                            <option value="obc">OBC</option>
                            <option value="sc">SC</option>
                            <option value="st">ST</option>
                            <option value="bc">BC</option>
                        </select>
                    </div>

                    <!-- Occupation Filter -->
                    <div class="filter-group">
                        <h3>Occupation</h3>
                        <select name="occupation" id="occupation">
                                <option value="">Any</option>
                                <option value="doctor">Doctor</option>
                                <option value="engineer">Engineer</option>
                                <option value="teacher">Teacher</option>
                                <option value="lawyer">Lawyer</option>
                                <option value="architect">Architect</option>
                                <option value="business">Business</option>
                                <option value="accountant">Accountant</option>
                                <option value="nurse">Nurse</option>
                                <option value="civil_servant">Civil Servant</option>
                                <option value="other">Other</option>
                        </select>
                    </div>
                  <!-- Income Filter -->
                    <div class="filter-group">
                        <h3>Annual Income (in INR)</h3>
                        <select name="income" id="income">
                            <option value="">Any</option>
                            <option value="0-100000">Below ₹1 Lakh</option>
                            <option value="100000-200000">₹1 Lakh - ₹2 Lakhs</option>
                            <option value="200000-300000">₹2 Lakhs - ₹3 Lakhs</option>
                            <option value="300000-400000">₹3 Lakhs - ₹4 Lakhs</option>
                            <option value="400000-500000">₹4 Lakhs - ₹5 Lakhs</option>
                            <option value="500000-1000000">₹5 Lakhs - ₹10 Lakhs</option>
                            <option value="1000000-2000000">₹10 Lakhs - ₹20 Lakhs</option>
                            <option value="2000000+">Above ₹20 Lakhs</option>
                        </select>
                    </div>

                    <div class="filter-group">
                        <h3>Country</h3>
                        <select name="country" id="country" onchange="fetchStates(this.value)">
                            <option value="">Any</option>
                            <option value="india">India</option>
                            <option value="usa">USA</option>
                            <!-- <option value="general">General</option>
                            <option value="obc">OBC</option>
                            <option value="sc">SC</option>
                            <option value="st">ST</option>
                            <option value="bc">BC</option> -->
                        </select>
                    </div>

                    <div class="filter-group">
                        <h3>State</h3>
                        <!-- <select name="state" id="state"> -->
                        <select id="state" name="state" onchange="fetchCities(this.value)" disabled >
                            <!-- <option value="">Any</option> -->
                            <!-- <option value="general">General</option>
                            <option value="obc">OBC</option>
                            <option value="sc">SC</option>
                            <option value="st">ST</option>
                            <option value="bc">BC</option> -->
                        </select>
                    </div>

                    <div class="filter-group">
                        <h3>City</h3>
                        <select name="city" id="city" disabled> 
                            <!-- <option value="">Any</option> -->
                            <!-- <option value="general">General</option>
                            <option value="obc">OBC</option>
                            <option value="sc">SC</option>
                            <option value="st">ST</option>
                            <option value="bc">BC</option> -->
                        </select>
                    </div>
                    
                    <!-- Favorites Filter -->
                  
                    <div class="filter-group">
                        <label for="filter-favorites">
                            <input type="checkbox" id="filter-favorites" name="filterFavorites" value="1"> Show Only Favorites
                        </label>
                    </div>




                    <!-- Buttons -->
                    <div class="filter-buttons">
                        <button type="submit" class="btn-primary">Apply Filters</button>
                        <button type="submit" name="reset" id="reset-filters">Reset <i class="fa-solid fa-arrow-rotate-right"></i></button>
                    </div>
                </form>
            </div>
            <div class="user-section">
                <!-- User Cards Grid -->
                <div id="user-container" class="user-grid">
                    <!-- User cards will be dynamically inserted here -->
                </div>


                <!-- User Details Overlay -->
            <div id="user-details-overlay" class="overlay">
                <div class="overlay-content">
                    <span id="close-overlay" class="close">&times;</span>
                    <div id="overlay-user-details">
                        <!-- User details will be loaded here via AJAX -->
                    </div>
                </div>
            </div>



                <!-- Pagination controls -->
                 <div class="pagination1">
                <div class="pagination-controls">
                    <button id="prev-page" class="btn-pagination">Previous</button>
                    <div class="pagination-numbers">
                        <span id="pagination-buttons"></span>
                    </div>
                    <button id="next-page" class="btn-pagination">Next</button>
                </div>
                </div>
            </div>

                <?php else: ?>
                    <div class="not-logged-in">
                        <p>please login to view user profiles.</p>
                        <a href="/login.php" class="btn-login">Login Now</a>
                    </div>
                <?php endif; ?>
            </div>



    <!-- Footer -->
    <!-- <footer>
        <div class="footer-container">
            <p>&copy; WedBliss. All rights reserved.</p>
        </div>
    </footer> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/assets/js/popupFunctionality.js"></script>

    <!-- AJAX and JavaScript for filters and pagination -->
    <script>
        let currentPage = 1;

        document.addEventListener('DOMContentLoaded', function() {
            loadUsers(currentPage);
        });

        function loadUsers(page) {
            const formData = new FormData(document.getElementById('filter-form'));
            formData.append('current_page', page);

            fetch('filter.php', {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: formData,
                })
                .then(response => response.text())
                .then(data => {
                    document.getElementById('user-container').innerHTML = data;
                    document.getElementById('pagination-buttons').textContent = currentPage;

                    // let usersExist = document.querySelectorAll('.user-card').length > 0;

            // Hide or show pagination based on whether users exist
            // if (!usersExist) {
            //     document.querySelector('.pagination1').style.display = 'none';
            // } else {
            //     document.querySelector('.pagination1').style.display = 'block';
            // }
                })
                .catch(error => console.error('Error loading users:', error));
        }

        document.getElementById('prev-page').addEventListener('click', function() {
            if (currentPage > 1) {
                currentPage--;
                loadUsers(currentPage);
            }
        });

        document.getElementById('next-page').addEventListener('click', function() {
            currentPage++;
            loadUsers(currentPage);
        });

        function applyFilters(event) {
            event.preventDefault();
            currentPage = 1;
            loadUsers(currentPage);
        }

    document.getElementById('reset-filters').addEventListener('click', function(event) {
    event.preventDefault(); // Prevent default form submission

    let form = document.getElementById('filter-form');
    
    // Manually reset all input fields
    let inputs = form.querySelectorAll('input, select');
    inputs.forEach(input => {
        if (input.type === 'checkbox' || input.type === 'radio') {
            input.checked = false;
        } else if (input.type === 'range') {
            if (input.id === 'min-age') {
                input.value = input.min; 
            } else if (input.id === 'max-age') {
                input.value = input.max; 
            }
        } else {
            input.value = ''; // Reset other input types
        }
    });

    // Update displayed age range values
    document.getElementById('min-age-display').textContent = document.getElementById('min-age').value;
    document.getElementById('max-age-display').textContent = document.getElementById('max-age').value;

    // Reset current page and load users with no filters
    currentPage = 1;
    loadUsers(currentPage);
});


    </script>

</body>

</html>