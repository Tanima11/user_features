<?php
session_start();
include('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get the selected technician and service from the form
  
  $technician_id = $_POST['technician_id'];
  $service = $_POST['service'];
  $booking_id = $_SESSION['book_id'];  


// Get technician details
$technician_query = "SELECT * FROM technician WHERE technician_id = '$technician_id'";
$technician_result = mysqli_query($conn, $technician_query);
$technician = mysqli_fetch_assoc($technician_result);

  // Update the booking status
  $query = "UPDATE book SET user_status = 'confirmed' WHERE book_id = '$booking_id'";
  mysqli_query($conn, $query);


  // Display the booking confirmation
  echo "<h3>Your Booking Details:</h3>";
  echo "<p>Service: $service</p>";
  echo "<p>Book Id: $booking_id</p>";
  echo "<p>Technician: $technician_id</p>";
  echo "<p>Technician: " . $technician['name'] . "</p>";
  echo "<p>Technician Contact: " . $technician['phone'] . "</p>";

}


echo '<form action="cancel_booking.php" method="post">';
echo '<input type="submit" name="submit" value="Cancel Booking">';
echo '</form>';

echo '<a href="dashboard.php"> go to dashboard </a>';

mysqli_close($conn);
?>

