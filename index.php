    <?php
    session_start();
    include "classes/Register.php";
    
    $error = '';
    $conn = new mysqli("localhost", "root", "", "database_system"); 
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';
    
        $users = new User($conn); 
        $userData = $users->authenticate($username, $password); 
    
        if ($userData) {
            $_SESSION['user_id'] = $userData['id'];
            $_SESSION['user_name'] = $userData['username'];
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Username or password is incorrect.";
        }
    }
    ?>
    

    

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <title>Login</title>
        <style>
        body {
                margin: 0;
                font-family: Arial, sans-serif;
                background-color: #FAF3E0; /* Light cream background */
            }

            /* Main Layout */
            main {
                display: flex;
                height: 100vh;
            }

            #login-left {
                width: 60%;
                background: #8B4513; /* Saddle brown background */
                display: flex;
                align-items: center;
                justify-content: center;
            }

            #login-left img {
                max-width: 90%;
                height: auto;
            }

            #login-right {
                width: 40%;
                display: flex;
                align-items: center;
                justify-content: center;
                background: #8B4513; /* Match background color with left */
                padding: 30px;
            }

            .card {
                padding: 30px;
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
                width: 100%;
                max-width: 400px;
                background-color: #F5F5DC; /* Beige color for the card */
                border: none;
                border-radius: 8px;
            }

            /* Changed text color to brown for title */
            .text-info_text-center {
                color: #8B4513; /* Brown color for title */
                font-size: 24px;
            }
            .textinfo {
                color: #8B4513; /* Brown color for title */
                font-size: 24px;
            }

            /* Changed button text color to brown */
            .btn-primary {
                width: 100%;
                background-color: #8B4513; /* Saddle brown button */
                border-color: #8B4513;
                color: #FFFFFF; /* Text color remains white for better contrast */
            }
            .btn-primary:hover {
                background-color: #A0522D; /* Darker brown */
                border-color: #A0522D;
            }

            .register-link {
                display: block;
                text-align: center;
                margin-top: 15px;
                color: #8B4513; /* Brown color for register link */
            }
        </style>
    </head>
    <body>
        <main>
            <div id="login-left">
                <img src="house.jpg" alt="Logo" width="100%">
            </div>
            <div id="login-right">
                <div class="card">
                <center> <h4 class="text-info_text-center"><b>Rental Management System</b></h4></center>
                    <form method="POST" action="">
                        <div class="form-group mb-3">
                        <center> <h4 class="textinfo"><b>Login</b></h4></center>
                            <label for="username" class="control-label">Username</label>
                            <input type="text" id="username" name="username" class="form-control" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="password" class="control-label">Password</label>
                            <input type="password" id="password" name="password" class="form-control" required>
                        </div>
                        <center>
                            <button a href="dashboard.php" type="submit" class="btn btn-primary">Login</button>
                        </center>
                        <div class="text-center mt-3">
                            <a href="registration.php" class="btn btn-link">Register?</a>
                        </div>
                    </form>
                    <?php if ($error): ?>
                        <div class="alert"><?= $error; ?></div>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </body>
    </html>
