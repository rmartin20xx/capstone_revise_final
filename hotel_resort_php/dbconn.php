<?php
// Database connection parameters
function connection()
{
    $hostname = 'localhost';
    $username = 'root';
    $password = 'passwordone';
    $database = 'caps2_hotel_db';

    // Create a database connection
    $con = new mysqli($hostname, $username, $password, $database);

    // Check if the connection was successful
    if ($con->connect_error) {
        die('Connection failed: ' . $con->connect_error);
    }

    return $con; // Return the connection object
}
?>
