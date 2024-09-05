<?php
require_once("./models/DB.php");
require_once("./register.php");
$database = new dbConnection($config);
$conn = $database-> getConnection();



?>