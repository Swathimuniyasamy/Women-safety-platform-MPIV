<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection settings
    $servername = "localhost"; // Change if using a remote server
    $username = "root"; // Default XAMPP username
    $password = ""; // Default XAMPP password (empty)
    $dbname = "safehaven"; // Change this to your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form data with validation
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $message = trim($_POST['message']);

    if (empty($name) || empty($email) || empty($message)) {
        header("Location: contact.html?success=false&error=emptyfields");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: contact.html?success=false&error=invalidemail");
        exit();
    }

    // Escape special characters to prevent SQL Injection
    $name = $conn->real_escape_string($name);
    $email = $conn->real_escape_string($email);
    $message = $conn->real_escape_string($message);

    // Insert into database
    $sql = "INSERT INTO contact_messages (name, email, message) VALUES ('$name', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        // Redirect with success message
        header("Location: contact.html?success=true");
        exit();
    } else {
        // Redirect with error message
        header("Location: contact.html?success=false&error=dberror");
        exit();
    }

    // Close connection
    $conn->close();
} else {
    // Redirect if accessed directly
    header("Location: ../html/contact.html");
    exit();
}
?>
