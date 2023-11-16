<?php
include('config.php');

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password']; // Do not hash the password here
    $email = $_POST['email'];

    // Hash the password before storing it in the database
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $mysqli->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $hashedPassword, $email);

    if ($stmt->execute()) {
        $message = "Registered successfully!";
    } else {
        $message = "Error: " . $stmt->error;
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
    <title>Register | Better Wikipedia</title>
</head>
<body>
    <nav class="navbar">
        <a href="index.html" class="logo-container">
            <img src="990d3c6370b8a8c39bde7a501334599d.jpg" alt="Better Wikipedia Logo" width="80" height="53" class="logo">
        </a>
        <<ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="login.php">Login</a></li>
            <li><a href="register.php">Register</a></li>
			<li><a href="contact.php">Contact Us</a></li>
			<li><a href="profile.php">Profile</a></li>
			<li><a href="submit.php">Submit ur own</a></li>
			 <?php
        // Check if the user is logged in and has admin privileges
        session_start();
        if (isset($_SESSION['username']) && $_SESSION['role'] === 'Admin') {
            echo '<li><a href="admin_panel.php">Admin Panel</a></li>';
        }
        ?>
        </ul>
    </nav>
    <div class="content">
        <div class="box">
            <h2>Register for Better Wikipedia</h2>
            <form action="register.php" method="post">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="submit" value="Register" class="button">
                <button class="back-button" onclick="goBack()">Back</button>
            </form>
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

