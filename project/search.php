<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <style>
        .text-container {
            background-color: rgba(255, 255, 255, 1); /* Add a semi-transparent white background */
            padding: 10px;
            border-radius: 10px;
            margin-bottom: 20px; /* Add some space between results */
        }
    </style>
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
        // Check if the user is logged in and has admin privileges
        session_start();
        if (isset($_SESSION['username']) && $_SESSION['role'] === 'Admin') {
            echo '<li><a href="admin_panel.php">Admin Panel</a></li>';
        }
        ?>
        </ul>
    </nav>
    <h1>Search Results</h1>

    <?php
    include('config.php'); // Include the database connection from config.php

    if (isset($_GET['query'])) {
        $query = $_GET['query']; // Get the search query from the URL

        $sql = "SELECT * FROM biodata WHERE name LIKE '%$query%' OR aboutThem LIKE '%$query%'";
        $result = $mysqli->query($sql);

        if ($result->num_rows > 0) {
            // Display search results
            while ($row = $result->fetch_assoc()) {
                echo '<div class="text-container">'; // Apply the CSS class to text elements
				echo '<img src="' . $row['image_path'] . '" alt="' . $row['name'] . '" />';
                echo '<h2>' . $row['name'] . '</h2>';
                echo '<p>Birthdate: ' . (isset($row['birthdate']) ? $row['birthdate'] : 'N/A') . '</p>';
                echo '<p>Occupation: ' . (isset($row['occupation']) ? $row['occupation'] : 'N/A') . '</p>';
                echo '<p>About Them: ' . $row['aboutThem'] . '</p>';
                echo '</div>';

                
               
            }
        } else {
            echo 'No results found for your search.';
        }
    } else {
        echo 'Please enter a search query.';
    }
    ?>
<footer class="site-footer">
    <p>&copy; 2023 Better Wikipedia. All rights reserved.</p>
</footer>
</body>
</html>

