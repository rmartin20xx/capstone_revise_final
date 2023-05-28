<?php

header("Access-Control-Allow-Origin: http://localhost:3000");
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
    $con = new mysqli($hostname, $username, $password, $database);

    // Check if the connection was successful
    if ($con->connect_error) {
        die('Connection failed: ' . $con->connect_error);
    }

    return $con; // Return the connection object
}

// Alternatively, you can use PDO for the database connection
function pdoConnection()
{
    $host = 'localhost'; // Hostname or IP address of the database server
    $database = 'caps2_hotel_db'; // Name of the database
    $charset = 'utf8mb4'; // Database charset
    $dsn = "mysql:host=$host;dbname=$database;charset=$charset"; // DSN string for PDO
    $username = 'root'; // Username for database authentication
    $password = 'passwordone'; // Password for database authentication

    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        return $pdo; // Return the PDO connection object
    } catch (PDOException $e) {
        die('Connection failed: ' . $e->getMessage());
    }
}
?>
