<?php
// Database configuration
$host = 'localhost'; // Database host (usually 'localhost')
$db = 'baven'; // Name of your database
$user = 'root'; // Database username
$pass = ''; // Database password (update it accordingly)

// Create a connection to the database
$conn = new mysqli($host, $user, $pass, $db);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Insert data into the users table
    $sql = "INSERT INTO users (firstName, lastName, role, email, password) 
            VALUES ('$firstName', '$lastName', '$role', '$email', '$hashedPassword')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Sign-up successful!');</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
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
