<?php
session_start();
include('connection.php'); // Include your DB connection

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php'); // Redirect to login if not logged in
    exit();
}

$user_id = $_SESSION['user_id']; // Get the user_id from session

// Fetch the user's profile details from the database
$query = "SELECT * FROM user WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "User not found!";
    exit();
}
?>

<!-- Display the user's profile -->
<h1>Your Profile</h1>
<p><strong>Name:</strong> <?php echo $user['user_name']; ?></p>
<p><strong>Email:</strong> <?php echo $user['email']; ?></p>
<p><strong>User Type:</strong> <?php echo $user['user_type']; ?></p>
<p><strong>Phone:</strong> <?php echo $user['phone']; ?></p>

<!-- Link to edit profile -->
<a href="edit.php">Edit Profile</a><br>



<form method="POST" action="book_service.php">
    <label for="service">Select Service:</label>
    <select id="service" name="service" required>
        <option value="">-- Select Service --</option>
        <option value="plumber">Plumber</option>
        <option value="electrician">Electrician</option>
    </select>
    <input type="hidden" name="book_id">
    <input type="hidden" name="user_id">

    <button type="submit">Proceed</button>

</form>

<a href="details.php">click to track your status </a><br>

