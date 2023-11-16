
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Biodata</title>
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
    <h1>Submit Biodata</h1>
    <div class="text-container">
        <form action="submit.php" method="post" enctype="multipart/form-data">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br><br>

            <label for="birthdate">Birthdate:</label>
            <input type="text" id="birthdate" name="birthdate" required><br><br>
			
			<label for="occupation">Occupation:</label>
            <input type="text" id="occupation" name="occupation" required><br><br>
            
			<label for="aboutThem">About Them:</label>
            <input type="text" id="aboutThem" name="aboutThem" required><br><br>
            
            <label for="image_path">Image:</label>
            <input type="file" name="image_path" id="image_path" required>

            <input type="submit" value="Submit Biodata">
        </form>

        <?php
// Include your database connection logic here (replace with your actual file)
include('config.php');

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $birthdate = isset($_POST['birthdate']) ? $_POST['birthdate'] : '';
    $occupation = isset($_POST['occupation']) ? $_POST['occupation'] : '';
    $aboutThem = isset($_POST['aboutThem']) ? $_POST['aboutThem'] : '';

    // Check if the "image_path" key exists in $_FILES
    if (isset($_FILES['image_path'])) {
        // File upload handling
        $targetDir = "images"; // Set your target directory
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $file = $_FILES['image_path'];

        // Check for file upload errors
        if ($file['error'] !== UPLOAD_ERR_OK) {
            echo "Error: File upload failed. Please try again.";
            exit();
        }

        // Generate a unique image path
        $image_path = 'image_path' . uniqid() . '_' . $file['name'];
        $targetFile = $targetDir . '/' . $image_path;

        // Move uploaded file to the target directory
        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            // Prepare and execute the SQL INSERT query
            $sql = "INSERT INTO biodata (name, birthdate, occupation, aboutThem, image_path) VALUES ('$name', '$birthdate', '$occupation', '$aboutThem', '$image_path')";

            // Check for duplicate entry error
            try {
                if ($mysqli->query($sql) === TRUE) {
                    echo "Biodata submitted successfully.";
                } else {
                    echo "Error: " . $sql . "<br>" . $mysqli->error;
                }
            } catch (mysqli_sql_exception $e) {
                if ($e->getCode() == 1062) {
                    // Duplicate entry error
                    echo "Error: Duplicate entry for image path. Please choose another image.";
                } else {
                    // Other SQL errors
                    echo "Error: " . $e->getMessage();
                }
            }
        } else {
            echo "Error: File upload failed. Please try again.";
        }
    } else {
        echo "Error: File data not received.";
    }
}
?>
    </div>
    <footer class="site-footer">
        <p>&copy; 2023 Better Wikipedia. All rights reserved.</p>
    </footer>
</body>
</html>
