 <!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | Better Wikipedia</title>
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
            <h2>Contact Us</h2>
            <form action="process_contact.php" method="post">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <textarea name="message" placeholder="Your Message" required></textarea>
                <input type="submit" value="Send" class="button">
                <button class="back-button" onclick="goBack()">Back</button>
            </form>
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