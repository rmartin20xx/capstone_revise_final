<?php
include 'dbconn.php';

// Function to fetch room types
function getRoomTypes() {
    global $conn;

    $query = "SELECT `room_type_id`, `room_type`, `room_type_desc`, `price`, `max_person`, `image` FROM `room_type`";
    $result = $conn->query($query);


    
    // Check if the query was successful
    if ($result) {
        $roomTypes = array();

        // Check if there are any rows returned
        if ($result->num_rows > 0) {
            // Output each row of the result
            while ($row = $result->fetch_assoc()) {
                $roomTypes[] = $row;
            }
        }

        // Return the room types as JSON
        echo json_encode($roomTypes);
    } else {
        echo "Error: " . $conn->error;
    }
}

// Call the function to fetch room types
getRoomTypes();
?>
