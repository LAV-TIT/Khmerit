<?php
header('Content-Type: application/json');
/* Handle CORS */
// Specify domains from which requests are allowed
header('Access-Control-Allow-Origin: *');
// Specify which request methods are allowed
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
// Additional headers which may be sent along with the CORS request
header('Access-Control-Allow-Headers: X-Requested-With,Authorization,Content-Type');
// Set the age to 1 day to improve speed/caching.
header('Access-Control-Max-Age: 86400');
// Ensure PHPMailer and other required dependencies are included
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $siteName = $_POST['sitename'] ?? '';
    $emailOwner = $_POST['email_owner'] ?? '';
    $fullName = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $phone = $_POST['phone'] ?? '';
    $subject = $_POST['subject'] ?? '';
    $message = $_POST['sms'] ?? '';

    if (empty($fullName) || empty($email) || empty($subject) || empty($message)) {
        echo json_encode(['status' => false, 'message' => 'All fields are required.']);
        exit;
    }

    $mail = new PHPMailer(true);

    try {

        $_smtp_host = 'mail.zgroup.asia';
        $_smtp_username = 'noreply@zgroup.asia';
        $_smtp_password = '1I4=XFUA]p(g';

        $mail->isSMTP();
        $mail->Host = 'mail.zgroup.asia';
        $mail->SMTPAuth = true;
        $mail->Username = 'noreply@zgroup.asia';
        $mail->Password = '1I4=XFUA]p(g';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        $mail->setFrom($email, $fullName);
        $mail->addAddress($emailOwner);

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body = "
            <p><strong>Name:</strong> {$fullName}</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Phone:</strong> {$phone}</p>
            <p><strong>Message:</strong><br>{$message}</p>
        ";

        $mail->send();

        echo json_encode(['status' => true, 'message' => 'Your email was sent successfully.']);
    } catch (Exception $e) {
        echo json_encode(['status' => false, 'message' => 'Mailer Error: ' . $mail->ErrorInfo]);
    }
} else {
    echo json_encode(['status' => false, 'message' => 'Invalid request method.']);
}
