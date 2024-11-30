<?php
session_start();
include('connection.php');

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE email='$email'";
    $result = mysqli_query($conn, $sql);
    if ($result && mysqli_num_rows($result) == 1) {
        // Fetch the user record
        $user = mysqli_fetch_assoc($result);

        // Directly compare the passwords (plain text)
        if ($password == $user['password']) {
            // Store user information in the session
            
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['password'] = $user['password'];

            // Redirect to a dashboard or home page
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with this email.";
    }
}
else {
    echo "Enter your valid credentials";
}

mysqli_close($conn);
?>

<form action="login.php" method="POST">
        <label for="id">Id:</label><br>
        <input type="text" name="user_id" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        
        <button type="submit" name="login">Login</button>
    </form>