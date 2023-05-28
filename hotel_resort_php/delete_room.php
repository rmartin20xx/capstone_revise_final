<?php
include 'conn/dbconn.php'; // Include the database connection file

// Check if the room_id parameter is provided in the URL
if (isset($_GET['room_id'])) {
    $roomID = $_GET['room_id'];

    // Delete the room from the database
    $con = connection(); // Call the connection function to establish a database connection
    $deleteQuery = "UPDATE `room` SET `deleteStatus` = 1 WHERE `room_id`='$roomID'";
    if ($con->query($deleteQuery) === TRUE) {
        // Redirect back to display_rooms.php after deleting the room
        header("Location: display_rooms.php");
        exit;
    } else {
        echo "Error: " . $con->error;
    }

    // Close the database connection
    $con->close();
} else {
    echo "Room ID not provided.";
}
?>
