<?php
include 'conn/dbconn.php'; // Include the database connection file

// Function to add a new room type
function addRoomType($roomType, $roomTypeDesc, $price, $maxPerson, $image) {
    $con = connection(); // Call the connection function to establish a database connection

    // Prepare the INSERT statement
    $query = "INSERT INTO room_type (room_type, room_type_desc, price, max_person, image) VALUES (?, ?, ?, ?, ?)";
    $stmt = $con->prepare($query);

    // Bind the parameters to the statement
    $stmt->bind_param("ssids", $roomType, $roomTypeDesc, $price, $maxPerson, $image);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Room type added successfully.";
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
        // Call the function to add the room type
        addRoomType($roomType, $roomTypeDesc, $price, $maxPerson, $image);
    } else {
        echo "Error uploading image.";
    }
}
?>

<!-- HTML form for adding a room type with image upload -->
<form method="post" action="" enctype="multipart/form-data">
    <label for="room_type">Room Type:</label>
    <input type="text" name="room_type" required><br>

    <label for="room_type_desc">Description:</label>
    <textarea name="room_type_desc" required></textarea><br>

    <label for="price">Price:</label>
    <input type="number" name="price" required><br>

    <label for="max_person">Max Person:</label>
    <input type="number" name="max_person" required><br>

    <label for="image">Image:</label>
    <input type="file" name="image" required><br>

    <input type="submit" value="Add Room Type">
</form>
