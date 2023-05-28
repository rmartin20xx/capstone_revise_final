<?php
include 'conn/dbconn.php'; // Include the database connection file

// Function to fetch room types
function getRoomTypes() {
    $con = connection(); // Call the connection function to establish a database connection

    $query = "SELECT `room_type_id`, `room_type`, `room_type_desc`, `price`, `max_person`, `image` FROM `room_type`";
    $result = $con->query($query);

    // Check if the query was successful
    if ($result) {
        // Check if there are any rows returned
        if ($result->num_rows > 0) {
            // Output table header
            echo "<table>
                    <tr>
                        <th>Room Type ID</th>
                        <th>Room Type</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Max Person</th>
                        <th>Image</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>";

            // Output each row of the result
            while ($row = $result->fetch_assoc()) {
                $imagePath = 'storage/img/' . $row['image']; // Modify the image path based on your folder structure
                echo "<tr>
                        <td>".$row['room_type_id']."</td>
                        <td>".$row['room_type']."</td>
                        <td>".$row['room_type_desc']."</td>
                        <td>".number_format($row['price'], 2)."</td>
                        <td>".$row['max_person']."</td>
                        <td><img src='".$imagePath."' alt='Room Image' width='100'></td>
                        <td><a href='edit_room_type.php?room_type_id=".$row['room_type_id']."'>Edit</a></td>
                        <td><a href='delete_room_type.php?room_type_id=".$row['room_type_id']."' onclick='return confirm(\"Are you sure you want to delete this room type?\")'>Delete</a></td>
                    </tr>";
            }

            echo "</table>";
        } else {
            echo "No room types found.";
        }
    } else {
        echo "Error: ".$con->error;
    }

    // Close the database connection
    $con->close();
}

// Call the function to fetch and display room types
getRoomTypes();
?>
