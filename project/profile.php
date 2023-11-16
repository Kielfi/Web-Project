<?php
// Include your database connection logic here (replace with your actual file)
include('config.php');

session_start();
$user_data = [];

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Use prepared statements to prevent SQL injection
    $user_query = "SELECT username, email FROM users WHERE username = ?";
    
    // Prepare the statement
    $stmt = $mysqli->prepare($user_query);

    if ($stmt) {
        // Bind the parameters
        $stmt->bind_param("s", $username);

        // Execute the query
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Fetch the user's information
        if ($result) {
            $user_data = $result->fetch_assoc();
            $result->close();
        } else {
            // Handle the error or redirect to an error page
            echo "Error fetching user data: " . $mysqli->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        // Handle the error or redirect to an error page
        echo "Error preparing statement: " . $mysqli->error;
    }

    // Handle password change if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $currentPassword = $_POST['current_password'];
        $newPassword = $_POST['new_password'];

        // Check if the entered current password is correct
        $checkPasswordQuery = "SELECT password FROM users WHERE username = ?";
        $checkStmt = $mysqli->prepare($checkPasswordQuery);
        $checkStmt->bind_param("s", $username);
        $checkStmt->execute();
        $checkStmt->bind_result($hashed_password);

        if ($checkStmt->fetch() && password_verify($currentPassword, $hashed_password)) {
            // Update the password to the new one
            $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            $updatePasswordQuery = "UPDATE users SET password = ? WHERE username = ?";
            $updateStmt = $mysqli->prepare($updatePasswordQuery);
            $updateStmt->bind_param("ss", $newHashedPassword, $username);

            if ($updateStmt->execute()) {
                echo "Password updated successfully!";
            } else {
                echo "Error updating password: " . $mysqli->error;
            }

            $updateStmt->close();
        } else {
            echo "Invalid current password!";
        }

        $checkStmt->close();
    }
} else {
    // Redirect to the login page if the user is not logged in
    header('Location: login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .navbar {
            background-color: #3498db;
            overflow: hidden;
        }

        .navbar ul {
            list-style-type: none;
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

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #3498db;
            color: #fff;
            cursor: pointer;
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
        
        if (isset($_SESSION['username']) && $_SESSION['role'] === 'Admin') {
            echo '<li><a href="admin_panel.php">Admin Panel</a></li>';
        }
        ?>
        </ul><br>
	</nav>
   <h1>User Profile</h1>

    <form method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $user_data['username']; ?>" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $user_data['email']; ?>" required>

        <label for="current_password">Current Password:</label>
        <input type="password" id="current_password" name="current_password" required>

        <label for="new_password">New Password:</label>
        <input type="password" id="new_password" name="new_password" required>

        <input type="submit" value="Save Changes">
    </form>
</body>
</html>