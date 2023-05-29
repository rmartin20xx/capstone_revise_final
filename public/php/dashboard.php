<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page
    header('Location: login.php');
    exit();
}

include 'dbconn.php'; // Include the database connection file
?>

<!DOCTYPE html>
<html>

<head>
    <title>Hotel Dashboard</title>
    <link rel="stylesheet" type="text/css" href="css/dashboard.css">
    <link rel="stylesheet" type="text/css" href="css/display_booking.css">
</head>

<body>
<div class="logout">
        <a href="logout.php">Logout</a>
    </div>
    <div class="hero"></div>
    <h1>Hotel Dashboard</h1>
    <div class="container">
        <div class="booking-info">
            <h2>Current Bookings</h2>
            <?php
            include 'display_booking.php';
            ?>
        </div>

        <div class="room-info">
            <div class="room-table">
                <h2>Rooms</h2>
                <?php
                include 'display_rooms.php';
                ?>
            </div>
            <div class="roomtype-table">
                <h2>Room Type</h2>
                <?php
                include 'display_room_type.php';
                ?>
            </div>
        </div>
    </div>



</body>

</html>
