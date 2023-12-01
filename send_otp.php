<?php

require 'config.php';
$con=mysqli_connect(HOST,USER,PASSWORD,DATABASE);

$to=$_POST['email'];

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    // $mail->isSMTP();                                            //Send using SMTP
    // $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    // $mail->SMTPAuth   = false;                                   //Enable SMTP authentication
    // $mail->Username   = 'rehanthewebbee@gmail.com';                     //SMTP username
    // $mail->Password   = 'Desktop678';                               //SMTP password
    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    // $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

	$mail->isSMTP();
	$mail->Host = MAIL_HOST;
	$mail->SMTPAuth = MAIL_AUTH;
	$mail->Port = MAIL_PORT;
	$mail->Username = MAIL_USER;
	$mail->Password = MAIL_PASSWORD;

    //Recipients
    $mail->setFrom(MAIL_FROM, 'Mailer');
    $mail->addAddress($to, 'Rehan');     //Add a recipient

	// Generate the OTP code
	$otp = rand(100000, 999999);

  	// stores the otp into a session variable
	$_SESSION['session_otp'] = $otp;

    // store OTP for verification against email
    mysqli_query($con,"INSERT INTO otp (type, code, expires_at, email) VALUES ('email_otp', $otp , '', '$to')");

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Email OTP';
    $mail->Body = 'Your OTP code is: ' . $otp;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'yes';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}