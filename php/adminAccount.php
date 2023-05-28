<?php
// include 'db.php'; // or require 'db.php';
header("Access-Control-Allow-Origin: *");

$host = 'localhost';
$db   = 'capstone_tester'; // replace with your database name
$user = 'root'; // replace with your username
$pass = 'passwordone'; // replace with your password
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);

$username = $_GET['username'];
$password = $_GET['password'];

$sql = "SELECT * FROM admin_account WHERE username = :username AND password = :password";
$stmt = $pdo->prepare($sql);
$stmt->execute(['username' => $username, 'password' => $password]);

$data3 = $stmt->fetch();

if ($data3) {
    // User exists, return success
    $response = ['success' => true];
} else {
    // User does not exist, return failure
    $response = ['success' => false];
}

// Convert data into JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
