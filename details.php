
<?php
session_start();
include('connection.php');

// Retrieve the user ID from the session
$user_id = $_SESSION['user_id'];

// Query to fetch the booking details and technician status
$query = "SELECT b.technician_status 
           FROM book b 
           WHERE b.user_id = '$user_id'";

// Execute the query
$result = mysqli_query($conn, $query);

// Check if the query execution was successful and returned results
if ($result && mysqli_num_rows($result) > 0) {
    // Fetch the result as an associative array
    $row = mysqli_fetch_assoc($result);
    $status = $row['technician_status'];

    // Check the status and display appropriate messages
    if ($status == 'confirmed') {
        echo "<h3>Booking Status:</h3>";
        echo "<p>Your booking has been confirmed by the technician.</p>";
    } elseif ($status == 'cancelled') {
        echo "<h3>Booking Status:</h3>";
        echo "<p>Your booking has been cancelled by the technician.</p>";
    } else {
        echo "<h3>Booking Status:</h3>";
        echo "<p>Your booking is pending.</p>";
    }
} else {
    // If no results are found for the user ID, display an error message
    echo "<h3>Booking Status:</h3>";
    echo "<p>No booking details found.</p>";
}

mysqli_close($conn);
?>
