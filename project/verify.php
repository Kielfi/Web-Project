<?php
include('config.php');
session_start();

// Check if the user is logged in and is an admin
if (isset($_SESSION['username']) && $_SESSION['role'] === 'Admin') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'])) {
        $name = $_POST['name'];

        // Update the article to mark it as verified
$update_query = "UPDATE biodata SET is_verified = true WHERE name = ?";
$stmt = $mysqli->prepare($update_query);

if ($stmt) {
    // Bind the parameter
    $stmt->bind_param("s", $name);

    // Execute the query
    if ($stmt->execute()) {
        echo "Article verified successfully!";
    } else {
        echo "Error updating article: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
} else {
    // Handle the error or redirect to an error page
    echo "Error preparing statement: " . $mysqli->error;
}

        // Redirect to the admin panel or a success page
        header('Location: admin_panel.php');
        exit();
    } else {
        // Redirect if there is no article_id in the POST request
        header('Location: admin_panel.php');
        exit();
    }
} else {
    // Redirect if the user is not an admin
    header('Location: index.php');
    exit();
}
?>
