<?php
session_start();
include "classes/Register.php"; 

$conn = new mysqli('localhost', 'root', '', 'database_system'); 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$errorMessage = '';
$successMessage = '';

if (isset($_GET['register']) && $_GET['register'] == 'success') {
    $successMessage = 'Registration successful! You can now log in.';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';

    // Check if passwords match
    if ($password !== $confirm_password) {
        $errorMessage = 'Passwords do not match.';
    } else {
        // Instantiate the Register class with the database connection
        $register = new Register($conn);
        try {
            // Call the register function
            $register->register($username, $password);
            exit();
        } catch (Exception $e) {
            $errorMessage = $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Registration</title>
    <style>
       body {
           width: 100%;
           height: 100vh;
           margin: 0;
           font-family: Arial, sans-serif;
           display: flex;
           align-items: center;
           justify-content: center;
           background: #8B4513; 
       }

       .card {
           padding: 20px;
           box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
           width: 400px;
           background: #F5F5DC; 
       }

       .btn-primary{
           width: 100%;
           background-color: #8B4513; 
           border-color: #8B4513;
           color: #FFFFFF; 
       }

       .btn-primary:hover {
           background-color: #A0522D; 
           border-color: #A0522D;
       }

       .textinfo {
           color: #8B4513; 
           text-align: center;
       }

       .form-group {
           margin-bottom: 15px;
       }

       .alert {
           margin-top: 10px;
           color: red;
           text-align: center;
       }

       .success {
           margin-top: 10px;
           color: green;
           text-align: center;
       }
    </style>
</head>
<body>
    <div class="card">
        <h4 class="textinfo"><b>Register</b></h4>
        <form method="POST" action="">
            <div class="form-group">
                <label for="username">Username</label>  
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm Password</label>
                <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
            <?php if ($errorMessage): ?>
                <div class="alert"><?= $errorMessage; ?></div>
            <?php endif; ?>
        </form>
        <?php if ($successMessage): ?>
            <div class="success"><?= $successMessage; ?></div>
        <?php endif; ?>
    </div>
</body>
</html>
