<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Resetare parola</title>
</head>

<style>
.backtohome {
  display: flex;
  align-items: center;
}

.backbutton {
  vertical-align: middle;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

.logo {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 24px;
	font-weight: bold;
	color: #333;
	text-decoration: none;
	transition: color 0.2s;
	display: inline-block;
	height: 50px;
	width: 200px;
	text-align: center;
	line-height: 50px;
}

.logo:hover {
	color: #0d6efd;
}

h1 {
  text-align: center;
}

.emailNotValid {
  text-align: center;
}

</style>

<body bgcolor="#C5FBFF">

  <div class="backtohome">
    <a href="testMainPage.php">
	  <img src="backbutton1.jpg" alt="Back Button" class="backbutton" width="130" height="100">
	</a>
	<a href="testMainPage.php">
	  <p class="backtext">Inapoi la pagina principala</h1>
	</a>
  </div>
  
  <div class="imgcontainer">
	<a href="testMainPage.php" class="logo">
	  e-Asociatie.ro
	</a>
  </div>

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$email = $_POST["email"];

$emailIsValid = checkEmail($email);

if(!$emailIsValid) {
	echo "<div class='emailNotValid'>";
	echo "<h1>Ne pare rau, adresa de email introdusa nu exista sau inca nu a fost activata.</h1>";
	echo "<a href='resetPassword.html' style='font-size: 30px;'>Apasati aici pentru a reveni la pagina de resetare a parolei.</a>";
	echo "</div>";
} else {
	sendPassResetLink($email);
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

  // Check if the email exists in the database and if it is verified
  $query = "SELECT * FROM users WHERE email = '$email' AND is_active = 1";
  $result = $db->query($query);

  // Return true if the email exists and is verified, false otherwise
  $exists = $result->num_rows > 0;

  // Close the database connection
  $db->close();

  return $exists;
}

function sendPassResetLink($email){
  // Connect to the database
  $db = new mysqli("127.0.0.1", "root", "", "my_users");

  // Check the connection
  if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
  }

  // Escape the email to prevent SQL injection
  $email = $db->real_escape_string($email);
  
  // Generate a random token
  $token = bin2hex(random_bytes(16));

  $query = "UPDATE users SET passToken = '$token' WHERE email = '$email'";
  mysqli_query($db, $query);
  
  $mail = new PHPMailer(true);
  $mail->isSMTP();
  $mail->Host = 'smtp.gmail.com';
  $mail->SMTPAuth = true;
  $mail->Username = 'muncaciuvictor@gmail.com';
  $mail->Password = 'ggaorrttottwnxky';
  $mail->SMTPSecure = 'ssl';
  $mail->Port = 465;
  
  $mail->setFrom('muncaciuvictor@gmail.com');
  
  $mail->addAddress($email);
  
  $mail->isHTML(true);
  
  $mail->Subject = 'Resetare parola';
  $mail->Body = 'Va rugam dati click pe link-ul de mai jos pentru a va reseta parola dumneavoastra!<br><br>
				 127.0.0.1/edsa-asociatieProprietari/reset.php?token='.$token.'&email='.$email.'
                 ';
  
  if(!$mail->send()) {
    echo "<h1>Email-ul nu a putut fi trimis. Eroarea este : {$mail->ErrorInfo}</h1>";
  } else {
    echo "<h1>Un link de resetare a fost trimis la $email.</h1> <br> 
	      <h1>Va rugam dati click pe link-ul din email pentru a va reseta parola.</h1>";
  }

  $db->close();
}

?>

</body>
</html>