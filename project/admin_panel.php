
<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5; /* Set your background color */
        }

        .navbar {
            background-color: #3498db;
            overflow: hidden;
        }

        .navbar ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
        }

        .navbar ul li {
            float: left;
        }

        .navbar a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .navbar a:hover {
            background-color: #2980b9;
        }

        .text-container {
            background-color: rgba(255, 255, 255, 1);
            padding: 10px;
            border-radius: 10px;
            margin: 20px; /* Add some space between results */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #3498db;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
        }

        th {
            background-color: #3498db;
            color: white;
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
            if (isset($_SESSION['username']) && $_SESSION['role'] === 'Admin') {
                echo '<li><a href="admin_panel.php">Admin Panel</a></li>';
            }
            ?>
        </ul>
    </nav>
    <div class="text-container">
        <h2>Admin Panel</h2>
        <?php
        include('config.php');
        session_start();

        // Check if the user is logged in and is an admin
        if (isset($_SESSION['username']) && $_SESSION['role'] === 'Admin') {
            $query = "SELECT * FROM biodata WHERE is_verified = false";
            $result = $mysqli->query($query);

            if ($result->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>Title</th><th>Content</th><th>Action</th></tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>{$row['name']}</td>";
                    echo "<td>{$row['aboutThem']}</td>";
                    echo "<td><form method='post' action='verify.php'><input type='hidden' name='name' value='{$row['name']}'><input type='submit' value='Verify'></form></td>";
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "<p>No articles to verify.</p>";
            }
        } else {
            // Redirect if the user is not an admin
            header('Location: index.php');
            exit();
        }
        ?>
    </div>
    <footer class="site-footer">
        <p>&copy; 2023 Better Wikipedia. All rights reserved.</p>
    </footer>
</body>

</html>
