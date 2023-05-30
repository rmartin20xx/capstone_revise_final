<?php
// Include the database connection file
// include 'dbconn.php';

// Establish a database connection
$con = connection();

// Query to retrieve booking information
$query = "SELECT b.booking_id, DATE_FORMAT(b.booking_date, '%m-%d-%Y') AS formatted_booking_date, rt.room_type, c.customer_name, c.contact_no, c.email, b.check_in, b.check_out, b.total_price
          FROM booking b
          JOIN room_type rt ON b.room_type_id = rt.room_type_id
          JOIN customer c ON b.customer_id = c.customer_id";

// Execute the query
$result = $con->query($query);

// Check if the query was successful
if ($result && $result->num_rows > 0) {
    // Display the booking information
    echo "<table class='booking-table'>";
    echo "<tr>

              <th>Booking Date</th>
              <th>Room Type</th>
              <th>Customer Name</th>
              <th>Contact No</th>
              <th>Email</th>
              <th>Check-in</th>
              <th>Check-out</th>
              <th>Total Price</th>
          </tr>";

    // Fetch and display each row of the result
    while ($row = $result->fetch_assoc()) {
        $formattedPrice = number_format($row['total_price'], 2);
        $formattedPriceWithSign = '₱' . $formattedPrice;
        
        echo "<tr>

                  <td>".$row['formatted_booking_date']."</td>
                  <td>".$row['room_type']."</td>
                  <td>".$row['customer_name']."</td>
                  <td>".$row['contact_no']."</td>
                  <td>".$row['email']."</td>
                  <td>".$row['check_in']."</td>
                  <td>".$row['check_out']."</td>
                  <td>".$formattedPriceWithSign."</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "No bookings found.";
}

// Close the database connection
$con->close();
?>
