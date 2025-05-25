<?php

date_default_timezone_set('Africa/Cairo');

if (empty($_POST['token']) || $_POST['token'] != 'bedaya-amr')
{
    return;
}

error_log(json_encode($_POST));

// Allow from any origin
if (isset($_SERVER['HTTP_ORIGIN'])) {

    print_r($_SERVER['HTTP_ORIGIN']);
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

    exit(0);
}


require_once __DIR__.'/vendor/autoload.php';



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

use Medians\Settings\Application\SystemSettingsController;

class MailService
{


        private $app;

        private $email;

        private $name;

        private $subject;

        private $body;


        function __construct($email, $name, $subject, $body)
        {

                $this->email = $email;
                $this->name = $name;
                $this->subject = $subject;
                $this->body = $body;
        }


        public function sendMail()
        {
                // Get system settings for Google Login
                $settings = [
                        'smtp_host' => 'mail.mediansai.com',
                        'smtp_user' => 'amr@mediansai.com',
                        'smtp_sender' => 'amr@mediansai.com',
                        'smtp_password' => 'Amr@2025',
                        'smtp_port' => 465,
                ];

                //Create an instance; passing `true` enables exceptions
                $mail = new PHPMailer(true);

                try {
                    //Server settings

                    $mail->isSMTP();                                    //Send using SMTP
                        $mail->Host       = $settings['smtp_host'];         //Set the SMTP server to send through
                        $mail->SMTPAuth   = !empty($settings['smtp_user']) ? true : false;       //Enable SMTP authentication
                        $mail->Username   = $settings['smtp_user'];         //SMTP username
                        $mail->Password   = $settings['smtp_password'];     //SMTP password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;    //Enable implicit TLS encryption
                    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;              //Enable verbose debug output
                        $mail->Port       = $settings['smtp_port'];         //TCP port to connect to; use 587 if you have set `SMTPSecure =
                        $mail->CharSet        = 'utf-8';         //TCP port to connect to; use 587 if you have set `SMTPSecure =
                        $mail->ContentType         = 'text/html';         //TCP port to connect to; use 587 if you have set `SMTPSecure =

                    //Recipients
                    $mail->setFrom($settings['smtp_sender'], 'مستشفيات بداية - Bedaya hospitals');

                    $mail->addAddress($this->email, $this->name);     //Add a recipient
        			$mail->addReplyTo('info@bedayahospitals.com', 'مستشفيات بداية - Bedaya hospitals');

                    // $mail->addBCC('info@medianssolutions.com');

                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = $this->subject;
                    $mail->Body    = $this->body;

                    $mail->send();
                        print_r('Message has been sent');
                    return true;

                } catch (Exception $e) {
                        error_log($e->getMessage());
                    return "Message could not be sent. Mailer Error". $mail->ErrorInfo;
                }
        }

}

$mail = new MailService(
    $_POST['email'],
    $_POST['name'],
    $_POST['subject'],
    $_POST['body']
);
$result = $mail->sendMail();
if ($result === true) {
    echo json_encode(['status' => 'success', 'message' => 'Email sent successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => $result]);
}
