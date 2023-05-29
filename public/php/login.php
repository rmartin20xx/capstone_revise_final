<?php
session_start();
require_once 'dbconn.php';

// Create a connection
$con = connection();

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect the login credentials from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // SQL query to fetch user information based on the provided username
    $query = "SELECT `user_id`, `username`, `password` FROM `user` WHERE `username` = '$username'";

    // Execute the query
    $result = $con->query($query);

    // Check if the query was successful and if a matching user was found
    if ($result && $result->num_rows > 0) {
        // Fetch the row
        $row = $result->fetch_assoc();

        // Verify the password
        if ($password === $row['password']) {
            // Password is correct, perform successful login action
            $userId = $row['user_id'];

            // Set session variables
            $_SESSION['user_id'] = $userId;
            $_SESSION['username'] = $username;

            // Free the result set
            $result->free();

            // Close the connection
            $con->close();

            // Redirect the user to the dashboard
            header('Location: dashboard.php');
            exit();
        } else {
            // Password is incorrect
            echo 'Invalid password.';
        }
    } else {
        // No user found with the provided username
        echo 'Invalid username.';
    }

    // Free the result set
    $result->free();
} else {
    // Check if the user is already logged in
    if (isset($_SESSION['user_id'])) {
        // User is already logged in, redirect to the dashboard
        header('Location: dashboard.php');
        exit();
    }

    // Form was not submitted or user is not logged in, show the login form
    ?>
    <html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" type="text/css" href="css/login.css">
    </head>
    <body>
    <div class="login-container">
        <form method="POST" action="">
            <h2>Login</h2>
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required><br>

            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required><br>

            <input type="submit" value="Login">
        </form>
    </div>
    </body>
    </html>
    <?php
}

// Close the connection
$con->close();
?>
