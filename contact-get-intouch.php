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
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //Load Composer's autoloader
    require 'PHPMailer/autoload.php';

    $root_url = $_POST['url'];
    $site_name = $_POST['sitename'];
    $emailOwner = $_POST['email_owner'];
    $fullName = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $subjects = $_POST['subject'];
    $txtMessage = $_POST['sms'];


    date_default_timezone_set('Asia/Phnom_Penh');
    $date_inquery = date("Y-m-d H:m:s a");

    $HTML_owner = "
    <html lang='en'>
        <table style='padding: 0px; width: 100%; min-width: 675px; border: 1px solid #CED0D4; 
           font-family: arial; font-size: 12px;border-collapse: collapse;'>
        <tbody>
    
        <tr style='background:rgba(255, 255, 255, 0.89);'>
            <td style='border-bottom: 1px solid #CED0D4;padding:15px 23px'>
                <a style='display: flex;align-items: center;' href='' target='_blank'>
                <img width='70' alt='$site_name' src='$root_url/uploads/images/logo3.png'>
                </a>
            </td>
        </tr>
    
        <tr style='text-align: left; '><td style='border-bottom: 1px solid #CED0D4;padding: 15px 20px;'>
            <table border='0' style='font-family: arial;font-size: 12px;'>
            <tbody>
                <tr style='height: 50px;'>
                   <td style='font-family: arial;font-size: 18px;width: 100%;' colspan='2'>
                      <strong style='color:#000000'>Contact</strong><br/>
                   </td>
                <tr>
                <tr style='font-size: 14px;'><td style='width:170px'>Full Name</td><td>: $fullName</td></tr>
                <tr style='font-size: 14px;'><td>Email Address</td><td>: $email</td></tr>
                <tr style='font-size: 14px;'><td>Phone Number</td><td>: $phone</td></tr>
                <tr style='font-size: 14px;'><td>Subjects</td><td>: $subjects</td></tr>
                <tr style='font-size: 14px;'><td>Message</td><td>: $txtMessage</td></tr>
            </tbody>
            </table>
            
        </td>
        </tr>
        
        <tr style='text-align: left;'><td style='padding: 20px;'>
            <p>Inquery Date:  $date_inquery</p>
        </td></tr>
        </tbody>
        </table>

    </html>";

    $SubjecEmail = "Contact from " . $site_name . " Website";
    sendEmail($site_name, $emailOwner, $email, $fullName, $SubjecEmail, $HTML_owner, $isSendToOwner = 1, $isFinishToRedirect = '');

    $SubjecEmail = "Your submited successful";
    sendEmail($site_name, $emailOwner, $email, $fullName, $SubjecEmail, $HTML_owner, $isSendToOwner = 0, $isFinishToRedirect = 'Ok');
} else {
    echo "Cannot send infomation, please contact later.";
} //siteControl Selft Identifyer

// *###*#*#*#*#*# STRART CREATE EMAIL FUNCTION ##*##*#**#*#*##***#*#  
function sendEmail($SiteName, $emailAddressReceiver, $bookerEmail, $bookerNamer, $SubjecEmail, $emailBody, $isSendToOwner, $isFinishToRedirect)
{
    //Load SMTP Server to for sent email
    $_smtp_host = 'mail.zgroup.asia';
    $_smtp_username = 'noreply@zgroup.asia';
    $_smtp_password = '1I4=XFUA]p(g';
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    try {
        //Server settings
        //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = $_smtp_host;                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = $_smtp_username;                     //SMTP username
        $mail->Password   = $_smtp_password;                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients

        if ($isSendToOwner == 1) {
            $mail->setFrom($bookerEmail, $bookerNamer);
            $mail->addAddress($emailAddressReceiver, $SiteName); // Primary recipient

            // Add CC recipients
            $mail->addCC("lavtit.nssp2021@gmail.com", $bookerNamer);

            // Add BCC recipients
            $mail->addBCC($emailAddressReceiver, $bookerNamer);
        } else { // Auto-respond to the booker
            $mail->setFrom($_smtp_username, $SiteName);
            $mail->addAddress($bookerEmail, $bookerNamer); // Primary recipient
            $mail->addReplyTo($emailAddressReceiver, $SiteName);
        }

        //Content
        $mail->isHTML(true);    //Set email format to HTML
        $mail->Subject = $SubjecEmail;
        $mail->Body    = $emailBody;
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->send();

        if ($isFinishToRedirect != '') {
            //header('Location: thanks-you-2.html');
            echo json_encode(array('status' => true, 'message' => "Your email was sent successfully."));
            exit;
        }
    } catch (Exception $e) {
        echo json_encode(array('status' => false, 'message' => "Message could not be sent. Mailer Error: {$mail->ErrorInfo}"));
        exit;
    }
}// END sendEmail Function
