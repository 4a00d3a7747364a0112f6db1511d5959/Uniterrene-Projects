<?php
if(!empty($_POST)){
	require("phpemailclassfiles/PHPMailerAutoload.php");
$mail = new PHPMailer;

	 // EDIT THE 2 LINES BELOW AS REQUIRED test.gid2015@gmail.com
 $email_to = "info@leonlambertdesign.com";
    $email_subject = "Leonlambertdesign contact us";
// $to = 'leonlambertweb@gmail.com';
    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
 
 
    // validation expected data exists
/*    if(!isset($_POST['name']) ||
        !isset($_POST['website']) ||
        !isset($_POST['email']) ||
        !isset($_POST['telephone']) ||
        !isset($_POST['comments'])) {
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
    }
 */
     
 
    $first_name = $_POST['name']; // required
    $email_from = $_POST['email']; // required
    $telephone = $_POST['website']; // not required
    $comments = $_POST['work']; // required
 
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$first_name)) {
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
  }
/* 
  if(!preg_match($string_exp,$last_name)) {
    $error_message .= 'The Last Name you entered does not appear to be valid.<br />';
  }*/
 
  if(strlen($comments) < 2) {
    $error_message .= 'The Comments you entered do not appear to be valid.<br />';
  }
 
  if(strlen($error_message) > 0) {
    died($error_message);
  }
 
    $email_message = "Form details below.</br></br>";
 
     
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
 
 $email_message .= "<strong>Name</strong>: ".clean_string($first_name)."</br>";
      /* $email_message .= "<strong>Email</strong>: ".clean_string($email_from)."</br>";*/
    $email_message .= "<strong>Website</strong>: ".clean_string($telephone)."</br>";
    $email_message .= "<strong>Comments</strong>: ".clean_string($comments)."</br>";
 
 
 
$mail->From = $email_from;
$mail->FromName = $first_name;
$mail->addReplyTo($email_to, 'LeonlambertDesign.com');
$mail->addAddress($email_to);               // Name is optional

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = $email_subject;
$mail->Body    =$email_message;
$mail->AltBody = '';
if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
/*$headers = 'From: LeonlambertDesign info@leonlambertdesign.com' . "\r\n" ;
    $headers .='Reply-To: '. $email_to . "\r\n" ;
    $headers .='X-Mailer: PHP/' . phpversion();
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";   
if(mail($email_to, $email_subject, $email_message,$headers)) {
  echo('<br>'."Email Sent ;D ".'</br>');
  } 
  else 
  {
  echo("<p>Email Message delivery failed...</p>");
  }*/
}