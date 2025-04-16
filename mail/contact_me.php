<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require '../vendor/autoload.php'; // Adjust path as needed

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = htmlspecialchars($_POST['name']);
    $email   = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        // SMTP Settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.hostinger.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'iqbal.hossan@bornil.shop';        // Your Hostinger email
        $mail->Password   = 'bornil@Iqubal@20';                // Email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;       // Use SSL
        $mail->Port       = 465;                                // SSL port

        // Recipients
        $mail->setFrom('iqbal.hossan@bornil.shop', 'Portfolio Contact Form');
        $mail->addAddress('hazratali.webdev@gmail.com'); // Where you want to receive messages

        // Content
        $mail->isHTML(false); // Set to true if you want to allow HTML in email body
        $mail->Subject = "New Contact Message from $name";
        $mail->Body    = "Name: $name\nEmail: $email\n\nMessage:\n$message";

        $mail->send();
        echo "Message sent successfully!";
    } catch (Exception $e) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    }
}
?>
