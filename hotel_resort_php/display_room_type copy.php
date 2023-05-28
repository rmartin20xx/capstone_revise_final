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
            // Output each row of the result
            while ($row = $result->fetch_assoc()) {
                $imagePath = 'storage/img/' . $row['image']; // Modify the image path based on your folder structure
                ?>
                <hr>
                <div class="card">
                    <img src="<?php echo $imagePath; ?>" alt="Room Image" class="card-image">
                    <div class="card-content">
                        <h3 class="card-title"><?php echo $row['room_type']; ?></h3>
                        <p class="card-description"><?php echo $row['room_type_desc']; ?></p>
                        <p class="card-price">$<?php echo number_format($row['price'], 2); ?></p>
                        <p class="card-max-person">Max Person: <?php echo $row['max_person']; ?></p>
                        <a href="booking.php?room_type_id=<?php echo $row['room_type_id']; ?>&amp;room_type=<?php echo urlencode($row['room_type']); ?>&amp;price=<?php echo urlencode($row['price']); ?>" class="btn-reserve">Reserve</a>

                    </div>
                </div>
                <hr>
                <?php
            }
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
