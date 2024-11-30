<?php
session_start();
include('connection.php');

if(isset($_POST['submit']))
{
   $book_id = $_SESSION['book_id'];

$query = "UPDATE book SET user_status = 'cancelled' WHERE book_id = '$book_id'";
mysqli_query($conn, $query);

echo "<h3>Booking Cancellation:</h3>";
echo "<p>Cancellation successful!</p>";
}
mysqli_close($conn);
?>
