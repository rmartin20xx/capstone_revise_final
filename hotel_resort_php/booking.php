<?php
// Retrieve the data passed from the previous page
if (isset($_GET['room_type_id']) && isset($_GET['room_type']) && isset($_GET['price'])) {
    $roomTypeId = $_GET['room_type_id'];
    $roomType = $_GET['room_type'];
    $price = $_GET['price'];

    // Format the price with 2 decimal places
    $formattedPrice = number_format($price, 2);

    // Display the selected room type and formatted price in the card
    echo "<p><strong>Room Type:</strong> $roomType</p>";
    echo "<p><strong>Price:</strong> $formattedPrice</p>";

    // Here you can add the necessary code to process the booking, such as saving the booking details to the database or integrating with a payment gateway.
    // Remember to sanitize and validate the data before performing any database operations or handling user input.
} else {
    // If the required data is not provided, display an error message or redirect the user back to the previous page.
    echo "Invalid booking details. Please go back and try again.";
}
?>
