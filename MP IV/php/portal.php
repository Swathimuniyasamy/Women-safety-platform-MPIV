<?php
// Start session if needed
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal</title>
    <link rel="stylesheet" href="../css/portal.css">
    <style>
        body {
            background-image: url('../image/portal.jpg');
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
        }
        .portal-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            gap: 20px;
        }
        .portal-box {
            text-align: center;
            padding: 20px;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .portal-box img {
            width: 150px;
            height: 150px;
            border-radius: 10px;
        }
        .portal-box h3 {
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="portal-container">
    <div class="portal-box">
        <a href="couns_front.php">
            <img src="../image/counselor.jpg" alt="COUNSELOR Portal">
            <h3>COUNSELOR</h3>
        </a>
    </div>
    <div class="portal-box">
        <a href="../portal/ngo.php">
            <img src="../image/ngoportal.jpg" alt="NGO Portal">
            <h3>NGO</h3>
        </a>
    </div>
    <div class="portal-box">
        <a href="../portal/user.php">
            <img src="../image/user.jpg" alt="USER Portal">
            <h3>USER</h3>
        </a>
    </div>
</div>

</body>
</html>
