<?php
include 'conn/dbconn.php'; // Include the database connection file

// Function to fetch ID card types
function getIDCardTypes() {
    $con = connection(); // Call the connection function to establish a database connection

    $query = "SELECT `id_card_type_id`, `id_card_type` FROM `id_card_type`";
    $result = $con->query($query);

    // Check if the query was successful
    if ($result) {
        // Check if there are any rows returned
        if ($result->num_rows > 0) {
            // Output each row of the result
            while ($row = $result->fetch_assoc()) {
                ?>
                <option value="<?php echo $row['id_card_type_id']; ?>"><?php echo $row['id_card_type']; ?></option>
                <?php
            }
        } else {
            echo "<option>No ID card types found.</option>";
        }
    } else {
        echo "<option>Error: " . $con->error . "</option>";
    }

    // Close the database connection
    $con->close();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize the input data
    $customerName = $_POST['customer_name'];
    $contactNo = $_POST['contact_no'];
    $email = $_POST['email'];
    $idCardType = $_POST['id_card_type'];
    $idCardNo = $_POST['id_card_no'];
    $address = $_POST['address'];

    // Additional validation and sanitization can be added as per your requirements

    // Insert the new customer into the database
    $con = connection(); // Call the connection function to establish a database connection
    $insertQuery = "INSERT INTO `customer` (`customer_name`, `contact_no`, `email`, `id_card_type_id`, `id_card_no`, `address`) VALUES ('$customerName', '$contactNo', '$email', '$idCardType', '$idCardNo', '$address')";
    
    if ($con->query($insertQuery) === TRUE) {
        // Get the newly inserted customer ID
        $customerID = $con->insert_id;

        // Check if the room_id parameter is provided
        if (isset($_GET['room_id'])) {
            $roomID = $_GET['room_id'];

            // Insert the booking into the database
            $checkInDate = $_POST['check_in_date'];
            $checkOutDate = $_POST['check_out_date'];
            $totalPrice = $_POST['total_price'];
            $remainingPrice = $_POST['remaining_price'];
            $paymentStatus = $_POST['payment_status'];

            // Additional booking details can be added as per your requirements

            $insertBookingQuery = "INSERT INTO `booking` (`room_id`, `customer_id`, `check_in`, `check_out`, `total_price`, `remaining_price`, `payment_status`) VALUES ('$roomID', '$customerID', '$checkInDate', '$checkOutDate', '$totalPrice', '$remainingPrice', '$paymentStatus')";

            if ($con->query($insertBookingQuery) === TRUE) {
                echo "Customer registration and booking added successfully.";
            } else {
                echo "Error: " . $con->error;
            }
        } else {
            echo "Customer added successfully.";
        }
    } else {
        echo "Error: " . $con->error;
    }

    // Close the database connection
    $con->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Customer Registration and Booking</title>
</head>
<body>
    <h2>Customer Registration and Booking</h2>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <label for="customer_name">Customer Name:</label>
        <input type="text" name="customer_name" id="customer_name" required>

        <br>

        <label for="contact_no">Contact No:</label>
        <input type="text" name="contact_no" id="contact_no" required>

        <br>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>

        <br>

        <label for="id_card_type">ID Card Type:</label>
        <select name="id_card_type" id="id_card_type" required>
            <?php
            // Retrieve ID card types from the database
            getIDCardTypes();
            ?>
        </select>

        <br>

        <label for="id_card_no">ID Card No:</label>
        <input type="text" name="id_card_no" id="id_card_no" required>

        <br>

        <label for="address">Address:</label>
        <textarea name="address" id="address" required></textarea>

        <br>

        <!-- Booking fields -->
        <?php
        // Check if the room_id parameter is provided
        if (isset($_GET['room_id'])) {
            $roomID = $_GET['room_id'];
            $con = connection(); // Call the connection function to establish a database connection

            // Retrieve room details from the database based on the provided room_id
            $query = "SELECT * FROM `room` WHERE `room_id` = '$roomID'";
            $result = $con->query($query);

            // Check if the query was successful and if there is a matching room
            if ($result && $result->num_rows > 0) {
                $room = $result->fetch_assoc();
                ?>
                <h3>Room: <?php echo $room['room_name']; ?></h3>
                <h4>Room Type: <?php echo $room['room_type']; ?></h4>

                <label for="check_in_date">Check-in Date:</label>
                <input type="date" name="check_in_date" id="check_in_date" required value="<?php echo date('Y-m-d'); ?>">

                <br>

                <label for="check_out_date">Check-out Date:</label>
                <input type="date" name="check_out_date" id="check_out_date" required>

                <br>

                <label for="total_price">Total Price:</label>
                <input type="number" name="total_price" id="total_price" required placeholder="0.00">

                <br>

                <label for="remaining_price">Remaining Price:</label>
                <input type="number" name="remaining_price" id="remaining_price" required placeholder="0.00">

                <br>

                <label for="payment_status">Payment Status:</label>
                <select name="payment_status" id="payment_status" required>
                    <option value="paid">Paid</option>
                    <option value="pending">Pending</option>
                </select>

                <br>
                <?php
            } else {
                echo "Invalid room.";
            }

            // Close the database connection
            $con->close();
        }
        ?>

        <input type="submit" value="Register Customer and Make Booking">
    </form>
</body>
</html>
