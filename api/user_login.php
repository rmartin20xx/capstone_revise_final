<?php

header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");


require_once 'dbconn.php';

// Assuming you have received the username and password from the client-side
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Validate input
    if (empty($username) || empty($password)) {
        $response = array(
            'success' => false,
            'message' => 'Please provide both username and password'
        );
        echo json_encode($response);
        exit;
    }
    
    // Sanitize the input to prevent SQL injection
    $username = mysqli_real_escape_string($conn, $username);
    $password = mysqli_real_escape_string($conn, $password);
    
    // Query the database for the user
    $sql = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            
            // Verify password
            if (password_verify($password, $user['password'])) {
                // Authentication successful
                // Perform login logic here
                // ...
                
                // Return success response to the client
                $response = array(
                    'success' => true,
                    'message' => 'Login successful',
                    'user' => $user
                );
                echo json_encode($response);
            } else {
                // Authentication failed (incorrect password)
                $response = array(
                    'success' => false,
                    'message' => 'Incorrect password'
                );
                echo json_encode($response);
            }
        } else {
            // User not found
            $response = array(
                'success' => false,
                'message' => 'User not found'
            );
            echo json_encode($response);
        }
    } else {
        // Query execution failed
        $response = array(
            'success' => false,
            'message' => 'Query execution failed'
        );
        echo json_encode($response);
    }
} else {
    // Invalid request
    $response = array(
        'success' => false,
        'message' => 'Invalid request'
    );
    echo json_encode($response);
}
