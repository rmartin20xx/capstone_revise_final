<?php
include '../conn/dbconn.php'; // Include the database connection file

// Function to fetch room types
function getRoomTypes() {
    $con = connection(); // Call the connection function to establish a database connection

    $query = "SELECT `room_type_id`, `room_type` FROM `room_type`";
    $result = $con->query($query);

    // Check if the query was successful
    if ($result) {
        // Check if there are any rows returned
        if ($result->num_rows > 0) {
            // Create a dropdown selection
            echo "<select name='room_type'>";
            while ($row = $result->fetch_assoc()) {
                echo "<option value='".$row['room_type_id']."'>".$row['room_type']."</option>";
            }
            echo "</select>";
        } else {
            echo "No room types found.";
        }
    } else {
        echo "Error: ".$con->error;
    }

    // Close the database connection
    $con->close();
}
?>


<!-- HTML markup -->
<!DOCTYPE html>
<html>
<head>
    <title>Add Room</title>
</head>
<body>
    <h1>Add Room</h1>

    <!-- Room form -->
    <form method="POST" action="">
        <label for="room_type">Room Type:</label>
        <?php getRoomTypes(); ?>
        <br><br>

        <label for="room_no">Room Number:</label>
        <input type="text" name="room_no" id="room_no" required><br><br>

        <label for="status">Status:</label>
        <input type="text" name="status" id="status" required><br><br>

        <button type="submit">Add Room</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Display the selected value
        $selectedRoomType = isset($_POST['room_type']) ? $_POST['room_type'] : '';
        echo "Selected Room Type: " . $selectedRoomType;
    }
    ?>
</body>
</html>