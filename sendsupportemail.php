<?php
header('Content-type: text/html; charset=utf-8');

if(isset($_POST['email']) && isset($_POST['feedback'])) {
	
	require("class.phpmailer-lite.php");
	$mail = new PHPMailerLite();
	$mail->SetFrom('feedback@portablepixels.com', 'Feedback');
	$mail->AddAddress("support@portablepixels.com", "Phonics App Website Feedback");

//	$mail->AddAttachment($attachment_name);
	
	$mail->Subject = "Feedback from Phonics App Contact Form";

	
	$content  = "Name: " . trim($_POST['name']) . "\n";
	$content .= "Email: " . trim($_POST['email']) . "\n";
	$content .= "Subject: " . trim($_POST['subject']) . "\n";
	$content .= "Feedback: " . trim($_POST['feedback']) . "\n";
	$mail->Body = $content;
	
	if(empty($_POST['name']) && empty($_POST['email']) && empty($_POST['feedback']) ) {
		echo "Message wasn't sent because the fields were empty.";
		exit;
	}

	if(!$mail->Send())
	{
		header("HTTP/1.1 500 Message could not be sent.");
		echo "Mail error:$mail->ErrorInfo";
	  	exit;
	}

	echo "Thank you. Your message has been sent. We read all messages and aim to respond within 2 working days";
	exit;
}

header('HTTP/1.1 403 Forbidden');
echo "Missing information.";
exit;

?>
