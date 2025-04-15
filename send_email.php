<?php

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    // Sanitize and validate input
    $name = isset($_POST["name"]) ? strip_tags(trim($_POST["name"])) : '';
    $email = isset($_POST["email"]) ? filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL) : '';
    $message = isset($_POST["message"]) ? trim($_POST["message"]) : '';

    // Validate inputs
    if (empty($name) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Please fill out the form correctly.";
        exit;
    }

    // Recipient info
    $recipient = "hazratali.webdev@gmail.com";
    $subject = "New contact from $name";

    // Email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n\n";
    $email_content .= "Message:\n$message\n";

    // Email headers
    $email_headers = "From: $name <$email>\r\n";
    $email_headers .= "Reply-To: $email\r\n";
    $email_headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Send the email
    if (mail($recipient, $subject, $email_content, $email_headers)) {
        http_response_code(200);
        echo "Thank you! Your message has been sent successfully.";
    } else {
        http_response_code(500);
        echo "Sorry! Something went wrong and your message could not be sent.";
    }

} else {
    // Not a POST request
    http_response_code(405);
    echo "Method Not Allowed. Please submit the form properly.";
}
