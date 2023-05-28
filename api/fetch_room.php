<?php
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

include 'dbconn.php'; // Include the database connection file

// Function to fetch room types
function getRoomTypes() {
    $con = connection(); // Call the connection function to establish a database connection

    $query = "SELECT `room_type_id`, `room_type`, `room_type_desc`, `price`, `max_person`, `image` FROM `room_type`";
    $result = $con->query($query);

    // Check if the query was successful
    if ($result) {
        // Check if there are any rows returned
        if ($result->num_rows > 0) {
            $roomTypes = array();
            // Output each row of the result
            while ($row = $result->fetch_assoc()) {
                $imagePath = 'storage/img/' . $row['image']; // Modify the image path based on your folder structure
                $roomTypes[] = array(
                    'roomTypeId' => $row['room_type_id'],
                    'roomType' => $row['room_type'],
                    'roomTypeDesc' => $row['room_type_desc'],
                    'price' => floatval($row['price']),
                    'maxPerson' => $row['max_person'],
                    'imagePath' => $imagePath
                );
            }
            // Return the room types as JSON
            echo json_encode($roomTypes);
        } else {
            echo "No room types found.";
        }
    } else {
        echo "Error: ".$con->error;
    }

    // Close the database connection
    $con->close();
}

// Call the function to fetch room types
getRoomTypes();

?>
