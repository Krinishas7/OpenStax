<?php
// register.php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    include '../db.php';  // Ensure you have a valid db.php for connection

    // Get input values
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passwordConfirm = $_POST['password_confirm'];

    // Check if password and confirm password match
    if ($password !== $passwordConfirm) {
        $error = "Passwords do not match.";
    } else {
        // Hash the password before storing it
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Prepare the SQL statement to insert user data into 'reg' table
        $stmt = $pdo->prepare("INSERT INTO register (first_name, last_name, email, password) VALUES (?, ?, ?, ?)");

        // Execute the statement with the actual user data
        if ($stmt->execute([$fname, $lname, $email, $hashedPassword])) {
            header("Location: login.php"); // Redirect to login page after successful registration
            exit;
        } else {
            $error = "Something went wrong. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/Register.css">
</head>
<body>
    <div class="container" id="signup">
        <h1 class="form-title">Register</h1>
        <form method="POST">
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="fname" id="fname" required />
                <label for="fname">First Name</label>
            </div>
            <div class="input-group">
                <i class="fas fa-user"></i>
                <input type="text" name="lname" id="lname" required />
                <label for="lname">Last Name</label>
            </div>
            <div class="input-group">
                <i class="fas fa-envelope"></i>
                <input type="email" name="email" id="email" required />
                <label for="email">Email</label>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password" id="password" required />
                <label for="password">Password</label>
            </div>
            <div class="input-group">
                <i class="fas fa-lock"></i>
                <input type="password" name="password_confirm" id="password_confirm" required />
                <label for="password_confirm">Confirm Password</label>
            </div>
            <input type="submit" class="btn" value="Sign Up" />
        </form>

        <?php
        if (isset($error)) {
            echo "<p class='error'>$error</p>";
        }
        ?>

        <p class="or">------------------or-----------------</p>
        
        <div class="links">
            <p>Already have an account?</p>
            <a href="login.php">Sign In</a>
        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html>
