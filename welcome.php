<?php
// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    // If not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}

// Retrieve user details from the session
$firstName = $_SESSION['firstName'];
$lastName = $_SESSION['lastName'];
$role = $_SESSION['role'];  // Assuming 'role' is stored during signup
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Baven</title>
    <style>
        body {
            font-family: 'Quicksand', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .welcome-container {
            width: 100%;
            max-width: 600px;
            margin: 100px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            color: #483ae1;
        }

        h3 {
            color: #46c6a6;
        }

        p {
            font-size: 18px;
            color: #333;
        }

        a {
            text-decoration: none;
            color: #46c6a6;
            font-size: 16px;
        }

        .logout-btn {
            background-color: #46c6a6;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }

        .logout-btn:hover {
            background-color: #399983;
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <h1>Welcome, <?php echo $firstName . " " . $lastName; ?>!</h1>
        <h3>Your role: <?php echo $role; ?></h3>
        <p>You are successfully logged in to the Baven system.</p>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</body>
</html>
