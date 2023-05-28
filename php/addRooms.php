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
$pdo = new PDO($dsn, $user, $pass);

$data = json_decode(file_get_contents('php://input'), true);

if ($data['room_number'] && $data['room_price'] && $data['room_ammen']) {
    $sql = "INSERT INTO hotel (room_number, room_price, room_ammen, photo) VALUES (?, ?, ?, ?)";
    $stmt= $pdo->prepare($sql);
    $stmt->execute([$data['room_number'], $data['room_price'], $data['room_ammen'], $data['photo']]);
}
?>
