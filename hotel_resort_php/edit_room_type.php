<?php
include 'conn/dbconn.php'; // Include the database connection file

// Check if the room type ID is provided in the URL parameter
if (isset($_GET['room_type_id'])) {
    $roomTypeId = $_GET['room_type_id'];

    // Function to fetch room type details based on the ID
    function getRoomTypeDetails($roomId) {
        $con = connection(); // Call the connection function to establish a database connection

        // Prepare the SELECT statement
        $query = "SELECT `room_type_id`, `room_type`, `room_type_desc`, `price`, `max_person`, `image` FROM `room_type` WHERE `room_type_id` = ?";
        $stmt = $con->prepare($query);

        // Bind the parameter to the statement
        $stmt->bind_param("i", $roomId);

        // Execute the statement
        $stmt->execute();

        // Fetch the result
        $result = $stmt->get_result();

        // Check if a row was found
        if ($result->num_rows > 0) {
            // Fetch the room type details
            $roomType = $result->fetch_assoc();

            // Close the statement and database connection
            $stmt->close();
            $con->close();

            return $roomType;
        }

        // Close the statement and database connection
        $stmt->close();
        $con->close();

        return null; // Return null if no room type found
    }

    // Function to update the room type details
    function updateRoomType($roomId, $roomType, $roomTypeDesc, $price, $maxPerson, $image) {
        $con = connection(); // Call the connection function to establish a database connection

        // Prepare the UPDATE statement
        $query = "UPDATE `room_type` SET `room_type` = ?, `room_type_desc` = ?, `price` = ?, `max_person` = ?, `image` = ? WHERE `room_type_id` = ?";
        $stmt = $con->prepare($query);

        // Bind the parameters to the statement
        $stmt->bind_param("ssidsi", $roomType, $roomTypeDesc, $price, $maxPerson, $image, $roomId);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Room type updated successfully.";
        } else {
            echo "Error: ".$stmt->error;
        }

        // Close the statement and database connection
        $stmt->close();
        $con->close();
    }

    // Check if the form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form data
        $roomType = $_POST["room_type"];
        $roomTypeDesc = $_POST["room_type_desc"];
        $price = $_POST["price"];
        $maxPerson = $_POST["max_person"];
        $image = $_FILES["image"]["name"]; // Get the name of the uploaded image file

        // Specify the directory where you want to save the uploaded image
        $targetDirectory = "storage/img/";
        $targetFile = $targetDirectory . basename($image);

        // Move the uploaded image to the specified directory
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            // Call the function to update the room type
            updateRoomType($roomTypeId, $roomType, $roomTypeDesc, $price, $maxPerson, $image);
        } else {
            echo "Error uploading image.";
        }
    }

    // Fetch the room type details based on the ID
    $roomTypeDetails = getRoomTypeDetails($roomTypeId);

    if ($roomTypeDetails) {
        $roomId = $roomTypeDetails['room_type_id'];
        $roomType = $roomTypeDetails['room_type'];
        $roomTypeDesc = $roomTypeDetails['room_type_desc'];
        $price = $roomTypeDetails['price'];
        $maxPerson = $roomTypeDetails['max_person'];
        $image = $roomTypeDetails['image'];
?>

<!-- HTML form for editing the room type with image upload -->
<form method="post" action="" enctype="multipart/form-data">
    <input type="hidden" name="room_type_id" value="<?php echo $roomId; ?>">

    <label for="room_type">Room Type:</label>
    <input type="text" name="room_type" value="<?php echo $roomType; ?>" required><br>

    <label for="room_type_desc">Description:</label>
    <textarea name="room_type_desc" required><?php echo $roomTypeDesc; ?></textarea><br>

    <label for="price">Price:</label>
    <input type="number" name="price" value="<?php echo $price; ?>" required><br>

    <label for="max_person">Max Person:</label>
    <input type="number" name="max_person" value="<?php echo $maxPerson; ?>" required><br>

    <label for="image">Image:</label>
    <input type="file" name="image"><br>
    <p>Current Image: <img src="storage/img/<?php echo $image; ?>" alt="Current Image" width="100"></p>

    <input type="submit" value="Update Room Type">
</form>

<?php
    } else {
        echo "Room type not found.";
    }
} else {
    echo "No room type ID provided.";
}
?>
