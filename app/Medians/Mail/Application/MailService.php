<?php

namespace Medians\Mail\Application;
use \Shared\dbaser\CustomController;

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
		$this->app = new \config\APP;
		$this->email = $email;
		$this->name = $name;
		$this->subject = $subject;
		$this->body = $body;
	}


	public function sendMail()
	{
		// Get system settings for Google Login
		$SystemSettings = new SystemSettingsController;

		$settings = $SystemSettings->getAll();

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
		    $mail->setFrom($settings['smtp_sender'], 'Medians');
		    $mail->addAddress($this->email, $this->name);     //Add a recipient
		    $mail->addReplyTo($settings['smtp_sender'], 'no-reply');

		    // $mail->addBCC('info@medianssolutions.com');

		    //Content
		    $mail->isHTML(true);                                  //Set email format to HTML
		    $mail->Subject = $this->subject;
		    $mail->Body    = render('views/email/email.html.twig',['msg'=> $this->body], null);

		    $mail->send();

		    return true;

		} catch (Exception $e) {
			$this->sendWithMedians();
			error_log($e->getMessage());	
		    return translate("Message could not be sent. Mailer Error"). $mail->ErrorInfo;
		}
	}

	public function sendWithMedians()
	{

		$url = 'https://stream.mediansai.com/bedaya-sender.php'; // Replace with the PHP file URL
		$data = [
			'token' => 'bedaya-amr',
			'name' => $this->name,
			'email'=> $this->email,
			'subject'=> $this->subject,
			'body'=> $this->body
		];

		// Initialize cURL
		$ch = curl_init($url);

		// Configure cURL options
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		// Execute the request and fetch response
		$response = curl_exec($ch);

		// Close cURL
		curl_close($ch);

	}

}
