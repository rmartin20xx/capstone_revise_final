<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');

$host = 'localhost'; // your MySQL host (localhost is common)
$db = 'capstone_tester'; // your database name
$user = 'root'; // your database username
$pass = '1234'; // your database password
$charset = 'utf8mb4'; // your database charset

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$opt = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);

$data4 = json_decode(file_get_contents('php://input'), true);

if (
    isset($data4['name']) &&
    isset($data4['contactNumber']) &&
    isset($data4['email']) &&
    isset($data4['checkInDate']) &&
    isset($data4['checkOutDate']) &&
    isset($data4['roomNumber'])
) {
    $name = $data4['name'];
    $contactNumber = $data4['contactNumber'];
    $email = $data4['email'];
    $checkInDate = $data4['checkInDate'];
    $checkOutDate = $data4['checkOutDate'];
    $roomNumber = $data4['roomNumber'];

    $sql = "INSERT INTO guest_profile (name, contactNumber, email, checkInDate, checkOutDate, roomNumber) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $contactNumber, $email, $checkInDate, $checkOutDate, $roomNumber]);
}
?>
