<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Adjust these paths based on where PHPMailer is installed on your server
require 'vendor/autoload.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mail = new PHPMailer(true);

    try {
        // --- Server Settings ---
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'rutoallan2017@gmail.com';    // Your Gmail
        $mail->Password   = 'bpvphcwhfdkqyxrr';     // Your Google App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // --- Recipients ---
        $mail->setFrom('rutoallan2017@gmail.com', 'Queen\'s Premier Suites');
        $mail->addAddress('rutoallan2017@gmail.com');     // Where the email is sent
        $mail->addReplyTo($_POST['email'], $_POST['name']);

        // --- Content ---
        $mail->isHTML(true);
        $mail->Subject = "Contact Form: " . $_POST['subject'];
        
        // Email Body Styling
        $messageBody = "
            <h3>New Message from Queen's Premier Suites</h3>
            <p><strong>Name:</strong> {$_POST['name']}</p>
            <p><strong>Email:</strong> {$_POST['email']}</p>
            <p><strong>Subject:</strong> {$_POST['subject']}</p>
            <p><strong>Message:</strong><br>" . nl2br($_POST['message']) . "</p>
        ";
        
        $mail->Body = $messageBody;

        $mail->send();
        echo "OK"; // Crucial for the Bootstrap "php-email-form" JS to show success
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid Request";
}
?>