<?php
// require("./models/DB.php");
// require("./register.php");

// $database = new dbConnection($config);
// $conn = $database->getConnection();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/assets/css/index.css">
</head>
<body>
<nav class="navbar">
    <div class="container">
        <a href="#" class="logo">
            <span class="logo-text">WedBliss</span>
        </a>
        <div class="menu">
            <input type="text" id="search-navbar" class="search-input" placeholder="Search...">
            <ul class="nav-links">
                <li><a href="#" class="nav-link active">Home</a></li>
                <li><a href="#" class="nav-link">About</a></li>
                <li><a href="/register.php" class="nav-link">Register</a></li>
                <li><a href="/login.php" class="nav-link">Login</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="slogan_container">
    <h1 class="matrimonial_slogan">Discover love, embrace the journey,<br>
Together, we'll build your future.</h1>
</div>
<div class="matrimonial-form">
    <form>
        <div class="form-group">
            <label for="gender">I'm looking for a</label>
            <select id="gender" name="gender">
                <option value="Woman">Woman</option>
                <option value="Man">Man</option>
            </select>
        </div>

        <div class="form-group">
            <label for="age">Aged</label>
            <select id="age-from" name="age-from">
                <option value="20">20</option>
                <option value="21">21</option>
                <option value="22">22</option>
                <option value="23">23</option>
                <option value="24">24</option>
                <option value="25">25</option>
            </select>
            <span>to</span>
            <select id="age-to" name="age-to">
                <option value="25">25</option>
                <option value="26">26</option>
                <option value="27">27</option>
                <option value="28">28</option>
                <option value="29">29</option>
                <option value="30">30</option>
            </select>
        </div>

        <div class="form-group">
            <label for="religion">Of religion</label>
            <select id="religion" name="religion">
                <option value="">Select</option>
                <option value="Hindu">Hindu</option>
                <option value="Christian">Christian</option>
                <option value="Muslim">Muslim</option>
                <option value="Jewish">Jewish</option>
            </select>
        </div>

        <div class="form-group">
            <label for="language">And mother tongue</label>
            <select id="language" name="language">
                <option value="">Select</option>
                <option value="Tamil">Tamil</option>
                <option value="Telugu">Telugu</option>
                <option value="English">English</option>
                <option value="Spanish">Spanish</option>
                <option value="Hindi">Hindi</option>
                <option value="Arabic">Arabic</option>
            </select>
        </div>

        <button type="submit" class="btn-primary">Let's Begin</button>
    </form>
</div>

</body>
</html>
