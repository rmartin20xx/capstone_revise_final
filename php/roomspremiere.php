<?php
header("Access-Control-Allow-Origin: *");
// header("Cache-Control: no-cache, no-store, must-revalidate");
// header("Pragma: no-cache");
// header("Expires: 0");

$host = 'localhost';
$db   = 'capstone_tester'; // replace with your database name
$user = 'root'; // replace with your username
$pass = '1234'; // replace with your password
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);

$sql = 'SELECT * FROM hotelpremiere'; // replace 'yourTable' with your actual table name

$stmt = $pdo->query($sql);

$data6 = [];
while ($row = $stmt->fetch()) {
    $data6[] = $row;
}

// Convert data into JSON
header('Content-Type: application/json');
echo json_encode($data6);
