<?php

// PHPMailer Integration
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Connect to the database
$db = new mysqli("127.0.0.1", "root", "", "my_users");

// Check the connection
if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}

// Get form data
$current_password = $_POST['currentPass'];
$new_password = $_POST['newPass'];

// Get email from session or cookie variables
session_start();
if (isset($_SESSION["email"])) {
	$email = $_SESSION["email"];
}
else {
	if (isset($_COOKIE["email"])) {
		$email = $_COOKIE["email"];
		}
	}

// Verify current password
$query = "SELECT password FROM users WHERE email = '$email'";
$result = $db->query($query);

$row = $result->fetch_assoc();
$hashed_password = $row['password'];

if (password_verify($current_password, $hashed_password)) {
	// Password is correct, it matches the one in the database
	// Update password
	$new_password_hash = password_hash($new_password, PASSWORD_DEFAULT);
	$query = "UPDATE users SET password = '$new_password_hash' WHERE email = '$email'";
	$result = $db->query($query);
	
	// Notify the user that their password has been changed and should be reminded to keep their password secure by not sharing it with others and not using the same password for multiple accounts.
	// Send the mail using PHPMailer
	$mail = new PHPMailer(true);
	$mail->isSMTP();
	$mail->Host = 'smtp.gmail.com';
	$mail->SMTPAuth = true;
	$mail->Username = 'muncaciuvictor@gmail.com';
	$mail->Password = '';
	$mail->SMTPSecure = 'ssl';
	$mail->Port = 465;
  
	$mail->setFrom('muncaciuvictor@gmail.com');
  
	$mail->addAddress($email);
  
	$mail->isHTML(true);
  
	$mail->Subject = 'Notificare schimbare parola cont - e-Asociatie.ro';
	$mail->Body = 'A fost efectuata schimbarea parolei de pe contul dumneavoastra e-Asociatie.ro!<br><br> 
				   Pentru a va pastra parola securizata va recomandam sa nu o impartasiti cu ceilalti si sa nu folositi aceeasi parola pentru conturi multiple!<br><br><br>
                   Daca nu ati solicitat aceasta schimbare, va rugam sa trimiteti o cerere de recuperare a contului la muncaciuvictor@gmail.com';
  
	if(!$mail->send()) {
		echo "<h1>Email-ul nu a putut fi trimis. Eroarea este : {$mail->ErrorInfo}</h1>";
	}
	
	$_SESSION['succes_pass_change'] = true;
	header("Location: myAccount.php");
	
} else {
    // Password is incorrect
	$_SESSION['incorrect_pass'] = true;
	header("Location: myAccount.php");	
    }


$db->close();

?>
