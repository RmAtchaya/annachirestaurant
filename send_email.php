<?php
// Include necessary PHPMailer files
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'libs/Exception.php';
require 'libs/PHPMailer.php';
require 'libs/SMTP.php';

// Create a new PHPMailer instance
$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host       = 'md-in-63.webhostbox.net';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'info@annachirestaurant.com';
    $mail->Password   = 'Annachi@2024';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    // Recipients
    $mail->setFrom('info@annachirestaurant.com', 'Annachi Restaurant');
    $mail->addAddress('info@annachirestaurant.com'); // Replace with recipient's email address

    // Content
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];  

    $mail->isHTML(true);
    $mail->Subject = 'Mail Reacived From '.$name;
    $emailBody = "
    <div style='max-width: 400px;padding: 20px; background-color: #971A22; border-radius: 8px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);'>
        <h2 style='color: #ffffff;'>Contact Information</h2>
        <hr style='border-color: #ffffff;'>
        
        <div style='margin-bottom: 20px;color:#ffff;'>
            <h3><b style='display: inline-block; width: 80px; color: #ffffff;'>Name:</b> $name<br></h3>
            <h3><b style='display: inline-block; width: 80px; color: #ffffff;'>Email:</b> $email<br></h3>
            <h3><b style='display: inline-block; width: 80px; color: #ffffff;'>Phone:</b> $phone<br></h3>
            <h3><b style='display: inline-block; width: 80px; color: #ffffff;'>Message:</b> $message</h3>
        </div>
    </div>
";

// Now you can use $emailBody as the content for your email
$mail->Body = $emailBody;

// Now you can use $emailBody as the content for your email
$mail->Body = $emailBody;

    // Send the email
    $mail->send();

    echo "SUCCESS|Your mail was sent successfully";
} catch (Exception $e) {
    echo "ERROR|Mailer Error: " . $mail->ErrorInfo;
}
?>