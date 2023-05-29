<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
// Database connection parameters
function connection()
{
    $hostname = 'localhost'; // Hostname or IP address of the database server
    $username = 'root'; // Username for database authentication
    $password = 'passwordone'; // Password for database authentication
    $database = 'caps2_hotel_db'; // Name of the database

    // Create a database connection
    $conn = new mysqli($hostname, $username, $password, $database);

    // Check if the connection was successful
    if ($conn->connect_error) {
        die('Connection failed: ' . $conn->connect_error);
    }

    return $conn; // Return the connection object
}
?>
