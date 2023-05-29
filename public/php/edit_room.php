<?php
include 'dbconn.php'; // Include the database connection file

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize the input data
    $roomID = $_POST['room_id'];
    $roomType = $_POST['room_type'];
    $roomNo = $_POST['room_no'];

    // Additional validation and sanitization can be added as per your requirements

    // Check if the selected room_type_id exists in the room_type table
    $con = connection(); // Call the connection function to establish a database connection
    $checkQuery = "SELECT `room_type_id` FROM `room_type` WHERE `room_type_id`='$roomType'";
    $checkResult = $con->query($checkQuery);

    if ($checkResult && $checkResult->num_rows > 0) {
        // Check if the room number already exists, excluding the current room being updated
        $checkRoomQuery = "SELECT `room_no` FROM `room` WHERE `room_no`='$roomNo' AND `room_id`!='$roomID'";
        $checkRoomResult = $con->query($checkRoomQuery);

        if ($checkRoomResult && $checkRoomResult->num_rows > 0) {
            echo "Room number already exists.";
        } else {
            // Update the room in the database
            $updateQuery = "UPDATE `room` SET `room_type_id`='$roomType', `room_no`='$roomNo' WHERE `room_id`='$roomID'";
            if ($con->query($updateQuery) === TRUE) {
                echo "Room updated successfully.";
                header("Location: display_rooms.php");
            } else {
                echo "Error: " . $con->error;
            }
        }
    } else {
        echo "Invalid room type.";
    }

    // Close the database connection
    $con->close();
}

// Check if the room_id parameter is provided in the URL
if (isset($_GET['room_id'])) {
    $roomID = $_GET['room_id'];

    // Retrieve the room details from the database
    $con = connection(); // Call the connection function to establish a database connection
    $query = "SELECT * FROM `room` WHERE `room_id`='$roomID'";
    $result = $con->query($query);

    if ($result && $result->num_rows > 0) {
        $room = $result->fetch_assoc();
    } else {
        echo "Room not found.";
        exit;
    }

    // Retrieve room types from the database
    $query = "SELECT `room_type_id`, `room_type` FROM `room_type`";
    $result = $con->query($query);

    // Check if the query was successful
    if ($result) {
        // Check if there are any room types returned
        if ($result->num_rows > 0) {
            // Display the edit form
            ?>
            <!DOCTYPE html>
            <html>
            <head>
                <title>Edit Room</title>
            </head>
            <body>
            <h2>Edit Room</h2>
            <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                <input type="hidden" name="room_id" value="<?php echo $room['room_id']; ?>">

                <?php
                // Room type dropdown select
                echo "<label for='room_type'>Room Type:</label>";
                echo "<select name='room_type' id='room_type'>";
                while ($row = $result->fetch_assoc()) {
                    $selected = ($row['room_type_id'] == $room['room_type_id']) ? "selected" : "";
                    echo "<option value='" . $row['room_type_id'] . "' " . $selected . ">" . $row['room_type'] . "</option>";
                }
                echo "</select>";
                ?>

                <br>

                <label for='room_no'>Room Number:</label>
                <input type='text' name='room_no' id='room_no' value="<?php echo $room['room_no']; ?>" required pattern="[A-Za-z0-9-]+">

                <br>

                <input type='submit' value='Update Room'>
            </form>
            </body>
            </html>
            <?php
        } else {
            echo "No room types found.";
        }
    } else {
        echo "Error: " . $con->error;
    }

    // Close the database connection
    $con->close();
} 
?>
