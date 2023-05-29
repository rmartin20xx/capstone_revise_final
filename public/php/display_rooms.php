<?php
// include 'dbconn.php'; // Include the database connection file

// Function to fetch and display rooms
function getRooms()
{
    $con = connection(); // Call the connection function to establish a database connection

    $query = "SELECT * FROM room NATURAL JOIN room_type WHERE deleteStatus = 0";
    $result = $con->query($query);

    // Check if the query was successful
    if ($result) {
        // Check if there are any rows returned
        if ($result->num_rows > 0) {
            // Output table header
            echo "<table class='room-table'>
                    <tr>
                    <th>Room No</th>
                    <th>Room Type</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    </tr>";

            // Output each row of the result
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['room_no'] . "</td>";
                echo "<td>" . $row['room_type'] . "</td>";
                echo "<td><a href='edit_room.php?room_id=" . $row['room_id'] . "' class='edit-link'>Edit</a></td>";
                echo "<td><a href='delete_room.php?room_id=" . $row['room_id'] . "' onclick='return confirm(\"Are you sure you want to delete this room?\")' class='delete-link'>Delete</a></td>";

                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No rooms found.";
        }
    } else {
        echo "Error: " . $con->error;
    }

    // Close the database connection
    $con->close();
}

?>

<!-- HTML markup -->

<body>
<!-- Call the function to fetch and display rooms -->
<?php getRooms(); ?>
</body>
</html>
