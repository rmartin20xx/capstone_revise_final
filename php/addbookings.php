<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');

$host = 'localhost'; //your MySQL host (localhost is common)
$db = 'capstone_tester'; //your database name
$user = 'root'; //your database username
$pass = '1234'; //your database password
$charset = 'utf8mb4'; //your database charset

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);

$data2 = json_decode(file_get_contents('php://input'), true);

if ($data2['name'] && $data2['room_number'] && $data2['number_of_days']) {
    $sql = "INSERT INTO booking (name, room_number, number_of_days) VALUES ( ?, ?, ?)";
    $stmt= $pdo->prepare($sql);
    $stmt->execute([$data2['name'], $data2['room_number'], $data2['number_of_days']]);
}
?>
