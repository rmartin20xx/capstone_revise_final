<?php
include 'conn/dbconn.php'; // Include the database connection file

// Retrieve room types from the database
$con = connection(); // Call the connection function to establish a database connection
$query = "SELECT `room_type_id`, `room_type` FROM `room_type`";
$result = $con->query($query);

// Check if the query was successful
if ($result) {
    // Check if there are any room types returned
    if ($result->num_rows > 0) {
        // Start the reservation form
        echo "<form action='process_reservation.php' method='POST'>";
        
        // Room type dropdown select
        echo "<label for='room_type'>Room Type:</label>";
        echo "<select name='room_type' id='room_type'>";
        while ($row = $result->fetch_assoc()) {
            echo "<option value='".$row['room_type_id']."'>".$row['room_type']."</option>";
        }
        echo "</select>";
        
        // Check-in date input
        echo "<label for='check_in'>Check-in Date:</label>";
        echo "<input type='date' name='check_in' id='check_in'>";
        
        // Check-out date input
        echo "<label for='check_out'>Check-out Date:</label>";
        echo "<input type='date' name='check_out' id='check_out'>";
        
        // Customer details inputs
        echo "<label for='name'>Name:</label>";
        echo "<input type='text' name='name' id='name'>";
        
        echo "<label for='email'>Email:</label>";
        echo "<input type='email' name='email' id='email'>";
        
        echo "<label for='phone'>Phone:</label>";
        echo "<input type='tel' name='phone' id='phone'>";
        
        // Submit button
        echo "<input type='submit' value='Submit'>";
        
        // End the reservation form
        echo "</form>";
    } else {
        echo "No room types found.";
    }
} else {
    echo "Error: ".$con->error;
}

// Close the database connection
$con->close();
?>
