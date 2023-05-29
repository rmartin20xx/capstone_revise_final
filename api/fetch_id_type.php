
<?php

header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require_once 'dbconn.php';

// Fetch ID card types from the database
function fetchIDCardTypes()
{
    $con = connection(); // Get the database connection

    $query = "SELECT id_card_type_id, id_card_type FROM id_card_type";
    $result = $con->query($query);

    $idCardTypes = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $idCardTypes[] = $row;
        }
    }

    $con->close(); // Close the database connection

    return $idCardTypes;
}

// Handle the API request
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Fetch ID card types
    $idCardTypes = fetchIDCardTypes();

    // Return the response as JSON
    header('Content-Type: application/json');
    echo json_encode($idCardTypes);
} else {
    // Handle other request methods if needed
    // ...
}
?>
