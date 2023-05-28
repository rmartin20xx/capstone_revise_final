<?php
include 'conn/dbconn.php'; // Include the database connection file

// Check if the room_type_id parameter is provided in the URL
if (isset($_GET['room_type_id'])) {
    $roomTypeId = $_GET['room_type_id'];

    // Function to delete a room type
    function deleteRoomType($roomTypeId) {
        $con = connection(); // Call the connection function to establish a database connection

        // Prepare the DELETE statement
        $query = "DELETE FROM room_type WHERE room_type_id = ?";
        $stmt = $con->prepare($query);

        // Bind the room_type_id parameter to the statement
        $stmt->bind_param("i", $roomTypeId);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Room type deleted successfully.";
        } else {
            echo "Error: ".$stmt->error;
        }

        // Close the statement and database connection
        $stmt->close();
        $con->close();
    }

    // Call the function to delete the room type
    deleteRoomType($roomTypeId);
} else {
    echo "No room type ID provided.";
}
?>
