
<?php
session_start(); // Start the session

// Destroy all session variables
$_SESSION = []; // Clear session array
session_destroy(); // Destroy the session

// Delete the session cookie if it exists
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Redirect to the login page or home page
header("Location: index.php"); // Redirect to your login or home page
exit();
?>
