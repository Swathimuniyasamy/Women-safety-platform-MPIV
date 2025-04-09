<?php
// Database connection settings
$host = "localhost"; // Change if your database is hosted remotely
$username = "root";  // Change if you have a different MySQL username
$password = "";      // Leave empty if no password is set
$database = "safehaven"; // Change to your actual database name

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed (" . $conn->connect_errno . "): " . $conn->connect_error);
}
?>
