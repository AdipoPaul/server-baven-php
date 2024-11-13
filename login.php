<?php
// Start a session
session_start();

// Database configuration
$host = 'localhost'; // Database host
$db = 'baven'; // Database name
$user = 'root'; // Database username
$pass = ''; // Database password

// Create a connection to the database
$conn = new mysqli($host, $user, $pass, $db);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Fetch the user with the provided email
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // User found, check password
        $row = $result->fetch_assoc();
        $hashedPassword = $row['password'];

        if (password_verify($password, $hashedPassword)) {
            // Password is correct, start the session
            $_SESSION['email'] = $row['email'];
            $_SESSION['firstName'] = $row['firstName'];
            $_SESSION['lastName'] = $row['lastName'];

            // Redirect to a welcome or dashboard page
            header("Location: welcome.php");
            exit();
        } else {
            // Invalid password
            echo "<script>alert('Invalid email or password.');</script>";
        }
    } else {
        // No user found with that email
        echo "<script>alert('Invalid email or password.');</script>";
    }

    // Close the connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Baven | login</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap');

        body {
            background: linear-gradient(to right, #899cf1,#483ae1);
            font-family: "Poppins";
          }

          .signup-box {
            width: 375px;
            height: auto;
            margin: 30px auto;
            background-color: rgb(245, 245, 245);
            border-radius: 10px;
          }

          .login-box {
            width: 370px;
            height: auto;
            margin: 20px auto;
            border-radius: 10px;
            background-color: rgb(245, 245, 245);
          }
      
          .edit-box {
            width: 370px;
            height: auto;
            margin: 20px auto;
            border-radius: 10px;
            background-color: rgb(245, 245, 245);
          }

          h1 {
            text-align: center;
            padding-top: 15px;
          }

          h4 {
            text-align: center;
          }

          form {
            width: 300px;
            margin-left: 30px;
          }

          form label {
            display: flex;
            margin-top: 20px;
            font-size: 18px;
          }

          form input {
            width: 100%;
            padding: 10px;
            border: none;
            border: 1px solid gray;
            border-radius: 6px;
            outline: none;
          }
          button[type="submit"] {
            width: 320px;
            height: 35px;
            margin-top: 20px;
            border: none;
            background-color: #46c6a6;
            color: white;
            font-size: 18px;
            margin-bottom: 10px;
          }
          .form-group input[type="submit"] {
            background-color: #46c6a6;
            color: #000000;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            margin-top: 10px;
            margin-bottom: 10px;
          }
          p {
            text-align: center;
            padding-top: 15px;
            font-size: 15px;
          }
          .para-2 {
            text-align: center;
            color: white;
            font-size: 15px;
            margin-top: -10px;
          }
          .para-2 a {
            color: #46d8b3;
          }          
    </style>
  </head>
  <body>
    <div class="login-box">
      <h1>Login</h1>
      <h4>Find out what's new today!</h4>
      <form action="login.php" method="POST">
        <label>Email</label>
        <input type="email" name="email" placeholder="Enter your email" required>
        <label>Password</label>
        <input type="password" name="password" placeholder="Enter your password" required>
        <button type="submit">Login</button>
      </form>
    </div>
    <p class="para-2">
      Don't have an account? <a href="signup">Sign Up Here</a>
    </p>
  </body>
</html>
