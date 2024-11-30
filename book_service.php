<?php
session_start();
include('connection.php');

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login if not logged in
    exit();
}

$user_id = $_SESSION['user_id']; // Get the user_id from session

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $service = $_POST['service'];
    

    // Generate a unique booking ID
  $booking_id = mysqli_insert_id($conn) + 1;


    // Fetch technicians with matching service type
    $query = "SELECT * FROM technician WHERE type_of_service = '$service'";
    $result = mysqli_query($conn, $query);
    $technicians = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $technicians[] = $row; // Store technician data
    }

     $technician_id = 0;
    
    if (!empty($technicians)) {
        $technician_id = $technicians[0]['technician_id'];
    }    

     // Insert booking details into the database
  $query = "INSERT INTO book (book_id, technician_id,service_name,user_id) VALUES ('$booking_id','$technician_id','$service','$user_id')";
  mysqli_query($conn, $query);


    if (count($technicians) > 0) {
        echo "<h3>Available Technicians for $service:</h3>";
        echo "<form method='POST' action='view_bookings.php'>";
        echo "<table border='1'>";
        echo "<tr><th>Technician ID</th><th>Name</th><th>Service Type</th><th>Contact</th><th>Select</th></tr>";

        foreach ($technicians as $technician) {
            echo "<tr>";
            echo "<td>" . $technician['technician_id'] . "</td>";
            echo "<td>" . $technician['name'] . "</td>";
            echo "<td>" . $technician['type_of_service'] . "</td>";
            echo "<td>" . $technician['phone'] . "</td>";
            echo "<td><input type='radio' name='technician_id' value='" . $technician['technician_id'] . "' required></td>";
            echo "</tr>";
        }

        echo "</table>";

         $_SESSION['book_id'] = $booking_id;
        echo "<input type='hidden' name='service' value='$service'>";
        echo "<input type='hidden' name='book_id' value='$booking_id'>";
        echo "<button type='submit'>Confirm Booking</button>";
        echo "</form>";
    } else {
        echo "No technicians available for this service.";
    }
}

mysqli_close($conn);
?>
