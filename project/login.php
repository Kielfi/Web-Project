<?php
include('config.php'); // Include the database connection from config.php

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $mysqli->prepare("SELECT username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($fetched_username, $hashed_password);

    // Fetch the result
    if ($stmt->fetch() && password_verify($password, $hashed_password)) {
        // Fetch the role along with the username
        $stmt->close(); // Close the previous statement

        $stmt = $mysqli->prepare("SELECT role FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->bind_result($user_role);

        // Fetch the result for the second time
        if ($stmt->fetch()) {
            // Save both 'username' and 'role' in the session
            session_start();
            $_SESSION['username'] = $fetched_username;
            $_SESSION['role'] = $user_role;

            // Redirect to the home page
            header('Location: index.php');
            exit();
        }
    } else {
        $message = "Invalid username or password!";
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Better Wikipedia</title>
</head>
<body>
    <nav class="navbar">
        <a href="index.html" class="logo-container">
            <img src="990d3c6370b8a8c39bde7a501334599d.jpg" alt="Better Wikipedia Logo" width="80" height="53" class="logo">
        </a>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
			<li><a href="contact.php">Contact Us</a></li>
			<li><a href="profile.php">Profile</a></li>
			<li><a href="submit.php">Submit ur own</a></li>
			<?php
			if (isset($_SESSION['username']) && $_SESSION['role'] === 'Admin') {
            echo '<li><a href="admin_panel.php">Admin Panel</a></li>';
        }
        ?>
        </ul>
    </nav>
    <div class="content">
    <div class="box">
        <h2>Login to Better Wikipedia</h2>
        <form action="login.php" method="post">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="submit" value="Login" class="button">
            <button class="back-button" onclick="goBack()">Back</button>
        </form>
        <!-- Display the message here -->
        <p><?php echo $message; ?></p>
    </div>
</div>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
<footer class="site-footer">
    <p>&copy; 2023 Better Wikipedia. All rights reserved.</p>
</footer>
</body>
</html>