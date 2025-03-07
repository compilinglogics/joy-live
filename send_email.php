<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Include PHPMailer
require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'] ?? '';
    $lastName = $_POST['lastName'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $email = $_POST['email'] ?? '';
    $guests = $_POST['guests'] ?? '';
    $date = $_POST['date'] ?? '';
    $time = $_POST['time'] ?? '';
    $notes = $_POST['notes'] ?? '';

    $mail = new PHPMailer(true);

    try {
        // SMTP Settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com'; // Replace with your SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'jjjoywebform@gmail.com'; // Your email
        $mail->Password   = 'aigistxdsemsicnx';  // Your email password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Sender & Recipient
        $mail->setFrom($firstName.'@email.com', 'JJ Reservations');
        $mail->addAddress('joypenticton@gmail.com', 'Manager');

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = "New Reservation from $firstName $lastName";
        $mail->Body    = "
            <h2>Reservation Details</h2>
            <p><strong>Name:</strong> $firstName $lastName</p>
            <p><strong>Phone:</strong> $phone</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Guests:</strong> $guests</p>
            <p><strong>Date:</strong> $date</p>
            <p><strong>Time:</strong> $time</p>
            <p><strong>Special Notes:</strong> $notes</p>
        ";

        // Send Email
        $mail->send();
        
        // Redirect with success message
        echo json_encode(["status" => "success", "message" => "Reservation successfully submitted!"]);
        exit();
    } catch (Exception $e) {
        echo json_encode(["status" => "error", "message" => "Frist Name & Contact number is required. {$mail->ErrorInfo}"]);
        exit();
    }
}
?>
