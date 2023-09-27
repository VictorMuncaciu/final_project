<?php

// PHPMailer Integration
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Connect to the database
$conn = new mysqli("127.0.0.1", "root", "", "my_users");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the new email and current password from the form
$newEmail = $_POST["newEmail"];
$password = $_POST["psw"];

// Get the current email address - this variable will be used to send a notification email to the user to notify them that the email has been changed. If they did not request this change, contact the admin.
session_start();
if (isset($_SESSION["email"])) {
	$email = $_SESSION["email"];
}
else {
	if (isset($_COOKIE["email"])) {
		$email = $_COOKIE["email"];
		}
	}

// Check if the new email address is already in use
$emailExists = checkEmail($newEmail);

if ($emailExists) {
    // The email address is already in use
    // Show an error message and redirect the user back to the form
	echo "<div class='infoText'>";
    echo "<h1>Ne pare rau, adresa noua de email pe care doriti sa o folositi este deja ocupata de alt cont.</h1> <br>";
    echo "<a href='myAccount.php' style='font-size: 30px;'>Incercati din nou</a>";
	echo "</div>";
  } else {
      // The email address is available
	  // Validate the password then send mail verification
      passValidationEmailVerification($newEmail, $password, $email);
    }

function checkEmail($email) {
  // Connect to the database
  $db = new mysqli("127.0.0.1", "root", "", "my_users");

  // Check the connection
  if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
  }

  // Escape the email to prevent SQL injection
  $email = $db->real_escape_string($email);

  // Check if the email exists in the database
  $query = "SELECT * FROM users WHERE email = '$email'";
  $result = $db->query($query);

  // Return true if the email exists, false otherwise
  $exists = $result->num_rows > 0;

  // Close the database connection
  $db->close();

  return $exists;
}

function passValidationEmailVerification($newEmail, $password, $email) {
  // Connect to the database
  $db = new mysqli("127.0.0.1", "root", "", "my_users");

  // Check the connection
  if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
  }
  
  // Escape the email, and password to prevent SQL injection
  $email = $db->real_escape_string($email);
  $password = $db->real_escape_string($password);
  
  // Get the data of the current email to check the password
  $query = "SELECT * FROM users WHERE email='$email'";
  $result = $db->query($query);

  // Email exists, check the password
  $row = $result->fetch_assoc();
  $hashed_password = $row["password"];
  if (password_verify($password, $hashed_password)) {
	// Generate a random token
    $token = bin2hex(random_bytes(16));
	
	// Update the new_email field in the database and set the token for email verification purpose
	$query = "UPDATE users SET token = '$token', new_email = '$newEmail' WHERE email = '$email'";
	$result = $db->query($query);
	
	// Send the confirmation mail to the new email using PHPMailer
	$mail = new PHPMailer(true);
	$mail->isSMTP();
	$mail->Host = 'smtp.gmail.com';
	$mail->SMTPAuth = true;
	$mail->Username = 'muncaciuvictor@gmail.com';
	$mail->Password = 'ggaorrttottwnxky';
	$mail->SMTPSecure = 'ssl';
	$mail->Port = 465;
  
	$mail->setFrom('muncaciuvictor@gmail.com');
  
	$mail->addAddress($newEmail);
  
	$mail->isHTML(true);
  
	$mail->Subject = 'Verificare schimbare adresa email cont - e-Asociatie.ro';
	$mail->Body = 'A fost solicitata schimbarea adresei de email de pe un cont e-Asociatie.ro pe aceasta adresa!<br><br> 
                 Va rugam dati click pe link-ul de mai jos pentru a verifica adresa dumneavoastra de email:<br><br>
				 127.0.0.1/edsa-asociatieProprietari/confirm_email.php?token='.$token.'&email='.$newEmail.'
                 ';
  
	if(!$mail->send()) {
		echo "<h1>Email-ul nu a putut fi trimis. Eroarea este : {$mail->ErrorInfo}</h1>";
	} else {
		echo "<h1>Un email de verificare a fost trimis la $newEmail.</h1> <br>
	      <h1>Va rugam dati click pe link-ul din email pentru a confirma schimbarea adresei de email.</h1>";
	}

	
  } else {
        // Password is incorrect
		$_SESSION['alert_message'] = true;
		header("Location: myAccount.php");
      }
  
  	$db->close();
  
}

?>