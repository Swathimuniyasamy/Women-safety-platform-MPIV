<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include(__DIR__ . "/db.php"); // Ensure correct path

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Check if fields are empty
    if (empty($username) || empty($password)) {
        echo "<script>alert('Please fill in all fields.'); window.location.href='../portal/user.html';</script>";
        exit();
    }

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT id, username, email, password FROM users WHERE username = ? OR email = ?");
    if ($stmt === false) {
        die("Prepare failed: " . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $row['password'])) {
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            echo "<script>alert('Login successful!'); window.location.href='../php/portal.php';</script>";
            exit();
        } else {
            echo "<script>alert('Incorrect password. Please try again.'); window.location.href='../portal/user.html';</script>";
            exit();
        }
    } else {
        echo "<script>alert('No user found with this username or email.'); window.location.href='../portal/user.html';</script>";
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SafeHaven - User Login</title>
    <link rel="stylesheet" href="/css/user.css">
    <link rel="icon" href="/images/logo.jpeg" type="image/png">
</head>
<body style="background-image: url('../image/login.jpg'); background-size: center;">
    <div class="login-container" style="display: grid;">
        <h2>User Login</h2>
        <?php
        if (!empty($login_error)) {
            echo "<div class='error-message'>$login_error</div>";
        }
        ?>
        <form action="login.php" method="post">
            <label for="username">Username / Email:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <div class="checkbox">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Remember Me</label>
            </div>

            <button type="submit">Login</button>
            <p><a href="forgot_password.html">Forgot Password?</a></p>
            <p>Don't have an account? <a href="../portal/usersignup.html">Sign Up</a></p>
        </form>
    </div>
</body>
</html>
