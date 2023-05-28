<?php
include 'conn/dbconn.php'; // Include the database connection file

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize the input data
    $roomType = $_POST['room_type'];
    $roomNo = $_POST['room_no'];

    // Additional validation and sanitization can be added as per your requirements

    // Validate the room number
    if (empty($roomNo)) {
        echo "Room number is required.";
    } elseif (!preg_match('/^[a-zA-Z0-9]+$/', $roomNo)) {
        echo "Invalid room number.";
    } else {
        // Check if the selected room_type_id exists in the room_type table
        $con = connection(); // Call the connection function to establish a database connection
        $checkQuery = "SELECT `room_type_id` FROM `room_type` WHERE `room_type_id`='$roomType'";
        $checkResult = $con->query($checkQuery);

        if ($checkResult && $checkResult->num_rows > 0) {
            // Check if the room number already exists
            $checkRoomQuery = "SELECT `room_no` FROM `room` WHERE `room_no`='$roomNo'";
            $checkRoomResult = $con->query($checkRoomQuery);

            if ($checkRoomResult && $checkRoomResult->num_rows > 0) {
                echo "Room number already exists.";
            } else {
                // Insert the new room into the database
                $insertQuery = "INSERT INTO `room` (`room_type_id`, `room_no`, `status`, `check_in_status`, `check_out_status`, `deleteStatus`) VALUES ('$roomType', '$roomNo', 'available', 'not checked-in', 'not checked-out', 'active')";
                if ($con->query($insertQuery) === TRUE) {
                    echo "Room added successfully.";
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
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Reservation Form</title>
</head>
<body>
    <h2>Add a New Room</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <?php
        // Retrieve room types from the database
        $con = connection(); // Call the connection function to establish a database connection
        $query = "SELECT `room_type_id`, `room_type` FROM `room_type`";
        $result = $con->query($query);

        // Check if the query was successful
        if ($result) {
            // Check if there are any room types returned
            if ($result->num_rows > 0) {
                // Room type dropdown select
                echo "<label for='room_type'>Room Type:</label>";
                echo "<select name='room_type' id='room_type'>";
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
        ?>

        <br>

        <label for='room_no'>Room Number:</label>
        <input type='text' name='room_no' id='room_no'>

        <br>

        <input type='submit' value='Add Room'>
    </form>
</body>
</html>
