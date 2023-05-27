<?php

namespace Medians\Mail\Application;
use \Shared\dbaser\CustomController;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class MailService
{


	private $this->app;

	private $this->email;

	private $this->name;

	private $this->subject;

	private $this->body;


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


		//Create an instance; passing `true` enables exceptions
		$mail = new PHPMailer(true);

		try {
		    //Server settings

		    $mail->isSMTP();                                    //Send using SMTP
			$mail->Host       = smtp_host;                     //Set the SMTP server to send through
			$mail->SMTPAuth   = true;                           //Enable SMTP authentication
			$mail->Username   = smtp_username;                  //SMTP username
			$mail->Password   = smtp_password;                  //SMTP password
			$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;    //Enable implicit TLS encryption
		    $mail->SMTPDebug = SMTP::DEBUG_SERVER;              //Enable verbose debug output
			$mail->Port       = smtp_port;                      //TCP port to connect to; use 587 if you have set `SMTPSecure = 

		    //Recipients
		    $mail->setFrom(smtp_sender, $this->app->sitename);
		    $mail->addAddress($this->email, $this->name);     //Add a recipient
		    $mail->addReplyTo(smtp_sender, 'no-reply');
		    // $mail->addBCC('info@medianssolutions.com');

		    //Content
		    $mail->isHTML(true);                                  //Set email format to HTML
		    $mail->Subject = $this->subject;
		    $mail->Body    = $this->body;

		    $mail->send();

		    return true;

		} catch (Exception $e) {
		    return __("Message could not be sent. Mailer Error"). $mail->ErrorInfo;
		}
	}

}
