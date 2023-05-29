<?php
// Allow cross-origin requests
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");

// Include the database connection file
require_once 'dbconn.php';

$conn = connection();

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the values from the request payload
    $post_data = json_decode(file_get_contents("php://input"), true);

    // Retrieve the customer details
    $customer_name = $post_data['customer_name'] ?? '';
    $contact_no = $post_data['contact_no'] ?? '';
    $email = $post_data['email'] ?? '';
    $id_card_type_id = $post_data['id_card_type_id'] ?? '';
    $id_card_no = $post_data['id_card_no'] ?? '';
    $address = $post_data['address'] ?? '';

    // Create a new customer and get the customer ID
    $customer_id = createCustomer($customer_name, $contact_no, $email, $id_card_type_id, $id_card_no, $address);

    if ($customer_id) {
        $room_type_id = $post_data['room_type_id'] ?? '';
        $room_id = $post_data['room_id'] ?? '';
        $check_in = $post_data['check_in'] ?? '';
        $check_out = $post_data['check_out'] ?? '';
        $total_price = $post_data['total_price'] ?? '';
        $remaining_price = $post_data['remaining_price'] ?? '';
        $payment_status = $post_data['payment_status'] ?? '';

        // Create a new booking
        createBooking($customer_id, $room_type_id, $room_id, $check_in, $check_out, $total_price, $remaining_price, $payment_status);
    }
}

// Create a new customer and return the customer ID
function createCustomer($customer_name, $contact_no, $email, $id_card_type_id, $id_card_no, $address) {
    // Use the global $conn variable from dbconn.php
    global $conn;

    if ($conn) {
        // Prepare the INSERT statement
        $stmt = $conn->prepare("INSERT INTO `customer` (`customer_name`, `contact_no`, `email`, `id_card_type_id`, `id_card_no`, `address`) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssiis", $customer_name, $contact_no, $email, $id_card_type_id, $id_card_no, $address);

        // Execute the statement
        $stmt->execute();

        // Get the generated customer ID
        $customer_id = $stmt->insert_id;

        $stmt->close();

        return $customer_id;
    } else {
        // Handle database connection error
        die("Database connection error.");
    }
}

// Create a new booking
function createBooking($customer_id, $room_type_id, $room_id, $check_in, $check_out, $total_price, $remaining_price, $payment_status) {
    // Use the global $conn variable from dbconn.php
    global $conn;

    if ($conn) {
        // Prepare the INSERT statement
        $stmt = $conn->prepare("INSERT INTO `booking` (`customer_id`, `room_type_id`, `room_id`, `check_in`, `check_out`, `total_price`, `remaining_price`, `payment_status`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iiisssdd", $customer_id, $room_type_id, $room_id, $check_in, $check_out, $total_price, $remaining_price, $payment_status);

        // Execute the statement
        $stmt->execute();

        $stmt->close();
        $conn->close();
    } else {
        // Handle database connection error
        die("Database connection error.");
    }
}
