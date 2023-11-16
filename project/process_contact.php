<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Set the recipient email address
    $to = 'kielfi2004@gmail.com';

    // Set the subject of the email
    $subject = 'Contact Us Form Submission';

    // Compose the email message
    $message = "Name: $name\n";
    $message .= "Email: $email\n";
    $message .= "Message:\n$message";

    // Set additional headers
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    // Send the email
    $mailSent = mail($to, $subject, $message, $headers);

    if ($mailSent) {
        echo 'Your message has been sent successfully!';
    } else {
        echo 'An error occurred. Please try again later.';
    }
}
?>