<?php

$to = "guha.rakesh@gmail.com";
$email = $_REQUEST['Email_Address']; 
$subject = "Contact form submission";
$headers = "From: $email";

$name = $_REQUEST['Full_Name'];
$phone = $_REQUEST['Telephone_Number'];
$skills = $_REQUEST['Skills'];

$fields = array();
$fields{"Full_Name"} = "Name";
$fields{"Email_Address"} = "Email";
$fields{"Telephone_Number"} = "Phone";
$fields{"Skills"} = "Skills";

$body = "We have received the following information:\n\n"; foreach($fields as $a => $b){ 	$body .= sprintf("%20s: %s\n",$b,$_REQUEST[$a]); }

$auto_reply_subject = "Thanks for signing up!";
$auto_reply_body = "Thank you for signing up at bookwork.co. You will be contacted shortly to begin the matching process. If you have any more questions, please contact me at rakesh@bookwork.co or reply to this email.";
$auto_reply_headers = "From: rakesh@bookwork.co";

$email_pattern = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';

if ($skills == '') {
	$error = "You have not entered your skills, please go back and try again.";
} elseif ($email == '') {
	$error = "You have not entered your email address, please go back and try again.";
} elseif (preg_match($email_pattern, $email) == 0) {
	$error = "The email you have entered is invalid, please go back and try again.";
} elseif ($name == '') {
	$error = "You have not entered your name, please go back and try again.";
} else {
	$error = '';
}

mail($email, $auto_reply_subject, $auto_reply_body, $auto_reply_headers);
mail($to, $subject, $body, $headers);

if ($error != '') {
	header("Location: http://www.ulance.co/error.html");
} else {
	header("Location: http://www.ulance.co/thankyou.html");
}

?>