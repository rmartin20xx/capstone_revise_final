<?php
include 'conn/dbconn.php'; // Include the database connection file

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
            echo "<table>
                    <tr>
                    <th>Room No</th>
                    <th>Room Type</th>
                    <th>Booking Status</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Edit</th>
                    <th>Delete</th>
                    </tr>";

            // Output each row of the result
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['room_no'] . "</td>";
                echo "<td>" . $row['room_type'] . "</td>";
                echo "<td>";
                if ($row['status'] == 0) {
                    echo '<a href="">Book Room</a>';
                } else {
                    echo '<a href="#">Booked</a>';
                }
                echo "</td>";
                echo "<td>";
                if ($row['status'] == 1 && $row['check_in_status'] == 0) {
                    echo '<button>Check In</button>';
                } elseif ($row['status'] == 0) {
                    echo '-';
                } else {
                    echo '<a href="#">Checked In</a>';
                }
                echo "</td>";
                echo "<td>";
                if ($row['status'] == 1 && $row['check_in_status'] == 1) {
                    echo '<button>Check Out</button>';
                } elseif ($row['status'] == 0) {
                    echo '-';
                }
                echo "</td>";
                echo "<td><a href='edit_room.php?room_id=" . $row['room_id'] . "'>Edit</a></td>";
                echo "<td><a href='delete_room.php?room_id=" . $row['room_id'] . "' onclick='return confirm(\"Are you sure you want to delete this room?\")'>Delete</a></td>";

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
<!DOCTYPE html>
<html>
<head>
    <title>Rooms</title>
</head>
<body>
<h1>Rooms</h1>

<!-- Call the function to fetch and display rooms -->
<?php getRooms(); ?>
</body>
</html>
