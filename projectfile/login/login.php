<?php
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    include '../db.php'; // Ensure you have the correct path for db.php

    // Get input values
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare the SQL statement to check if the user exists in the 'reg' table
    $stmt = $pdo->prepare("SELECT * FROM register WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    // Verify password and start a session if valid
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id']; // Store user ID in session
        header("Location: ../userpage/home.php"); // Redirect to the dashboard after successful login
        exit;
    } else {
        $error = "Invalid email or password."; // Display error if login fails
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">  <!-- Your specific login CSS -->
    <title>Login</title>
</head>
<body>
    <div class="home">
        <div class="wrapper-login">
            <h2>Member Login</h2>
            <form method="POST" action="login.php">
                <div class="input-box">
                    <span class="icon"><ion-icon name="mail-outline"></ion-icon></span>
                    <input type="email" name="email" placeholder="Enter your email" required />
                </div>

                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed-outline"></ion-icon></span>
                    <input type="password" name="password" placeholder="Enter your password" required />
                </div>

                <div class="remember-forgot">
                    <label><input type="checkbox" /> Remember me</label>
                    <a href="#">Forgot password?</a>
                </div>
                <button type="submit" class="btn">Login</button>

                <div class="register-link">
                    <p>Not a member? <a href="register.php">Sign up now</a></p>
                </div>
            </form>

            <?php
            // Display error message if login fails
            if (isset($error)) {
                echo "<p class='error'>$error</p>";
            }
            ?>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
