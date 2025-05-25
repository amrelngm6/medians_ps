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
			$mail->SMTPAuth   = false;       //Enable SMTP authentication
			$mail->Username   = $settings['smtp_user'];         //SMTP username
			$mail->Password   = $settings['smtp_password'];     //SMTP password
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;    //Enable implicit TLS encryption
		    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;              //Enable verbose debug output
			$mail->Port       = $settings['smtp_port'];         //TCP port to connect to; use 587 if you have set `SMTPSecure = 
			$mail->CharSet        = 'utf-8';         //TCP port to connect to; use 587 if you have set `SMTPSecure = 
			$mail->ContentType         = 'text/html';         //TCP port to connect to; use 587 if you have set `SMTPSecure = 

		    //Recipients
		    $mail->setFrom('amr@mediansai.com', 'مستشفيات بداية - Bedaya hospitals');
		    $mail->addAddress($this->email, $this->name);     //Add a recipient
		    $mail->addReplyTo('info@bedayahospitals.com', 'no-reply');

		    // $mail->addBCC('info@medianssolutions.com');

		    //Content
		    $mail->isHTML(true);                                  //Set email format to HTML
		    $mail->Subject = $this->subject;
		    $mail->Body    = render('views/email/email.html.twig',['msg'=> $this->body], null);

		    $mail->send();

		    return true;

		} catch (Exception $e) {
			error_log($e->getMessage());	
			return $this->sendWithMedians();
		    // return translate("Message could not be sent. Mailer Error"). $mail->ErrorInfo;
		}
	}

	public function sendWithMedians()
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
		    $mail->setFrom('amr@mediansai.com', 'مستشفيات بداية - Bedaya hospitals');
			$mail->addAddress($this->email, $this->name);     //Add a recipient
			$mail->addReplyTo('info@bedayahospitals.com', 'مستشفيات بداية - Bedaya hospitals');

			// $mail->addBCC('info@medianssolutions.com');

			//Content
			$mail->isHTML(true);                                  //Set email format to HTML
			$mail->Subject = $this->subject;
			$mail->Body    = $this->body;

			$mail->send();

			return true;

		} catch (Exception $e) {
			return "Message could not be sent. Mailer Error";
		}

	}

}
