
<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Collect form data
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $query = trim($_POST["query"]);

    // Validate input (you can add more validation as per your requirements)
    if (empty($name) || empty($email) || empty($phone) || empty($query)) {
        // Handle empty fields error
        echo "All fields are required.";
        exit;
    }

    // Example of further validation for email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Handle invalid email format
        echo "Invalid email format.";
        exit;
    }

    // Now you can process the form data (send email, save to database, etc.)
    // For simplicity, let's just print the collected data
    echo "Name: " . $name . "<br>";
    echo "Email: " . $email . "<br>";
    echo "Phone: " . $phone . "<br>";
    echo "Query: " . $query . "<br>";

    // Here you would typically perform additional tasks like saving to a database or sending an email
}
?>




<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Path to PHPMailer autoload.php

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Collect form data
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);
    $query = trim($_POST["query"]);

    // Validate input (you can add more validation as per your requirements)
    if (empty($name) || empty($email) || empty($phone) || empty($query)) {
        // Handle empty fields error
        echo "All fields are required.";
        exit;
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Handle invalid email format
        echo "Invalid email format.";
        exit;
    }

    // PHPMailer configuration
    $mail = new PHPMailer(true);
    
    try {
        //Server settings
        $mail->isSMTP();                                            // Send using SMTP
        $mail->Host       = 'smtp.example.com';                      // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        $mail->Username   = 'your-email@example.com';                // SMTP username
        $mail->Password   = 'your-smtp-password';                   // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;          // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

        //Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('recipient@example.com');                 // Add a recipient

        // Content
        $mail->isHTML(false);                                       // Set email format to HTML
        $mail->Subject = 'Contact Form Submission';
        $mail->Body    = "Name: $name\nEmail: $email\nPhone: $phone\nQuery:\n$query";

        $mail->send();
        echo 'Thank you! Your message has been sent.';
    } catch (Exception $e) {
        echo "Oops! Something went wrong and we couldn't send your message. Error: {$mail->ErrorInfo}";
    }
}
?>
