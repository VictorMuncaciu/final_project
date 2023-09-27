<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Inregistrare</title>
</head>

<style>
.infoText {
  text-align: center;
}

h1 {
  text-align: center;
}
</style>

<body bgcolor="#C5FBFF">

<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Get the values from the form
$username = $_POST["username"];
$email = $_POST["email"];
$password = $_POST["psw"];
$passwordRepeat = $_POST["psw-repeat"];


// Check if the username is already taken
$usernameExists = checkUsername($username);

if ($usernameExists) {
  // The username is already taken
  // Show an error message and redirect the user back to the form
  echo "<div class='infoText'>";
  echo "<h1>Ne pare rau, username-ul este luat de altcineva.</h1> <br>";
  echo "<a href='register.html' style='font-size: 30px;'>Incercati din nou</a>";
  echo "</div>";
} else {
  // The username is available
  // Check if the email address is already in use
  $emailExists = checkEmail($email);

  if ($emailExists) {
    // The email address is already in use
    // Show an error message and redirect the user back to the form
	echo "<div class='infoText'>";
    echo "<h1>Ne pare rau, adresa de email este deja folosita.</h1> <br>";
    echo "<a href='register.html' style='font-size: 30px;'>Incercati din nou</a>";
	echo "</div>";
  } else {
    // The email address is available
    // Check if the passwords match
    if ($password != $passwordRepeat) {
      // The passwords do not match
      // Show an error message and redirect the user back to the form
	  echo "<div class='infoText'>";
      echo "<h1>Parolele nu se potrivesc.</h1> <br>";
      echo "<a href='register.html' style='font-size: 30px;'>Incercati din nou</a>";
	  echo "</div>";
    } else {
      // The passwords match
	  // Send mail verification
      emailVerificationPassInsertion($username, $email, $password);
    }
  }
}

function emailVerificationPassInsertion($username, $email, $password) {
  // Connect to the database
  $db = new mysqli("127.0.0.1", "root", "", "my_users");

  // Check the connection
  if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
  }

  // Escape the username, email, and password to prevent SQL injection
  $username = $db->real_escape_string($username);
  $email = $db->real_escape_string($email);
  $password = $db->real_escape_string($password);

  // Hash the password for storage in the database
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
  
  // Generate a random token
  $token = bin2hex(random_bytes(16));

  // Insert the email address and token into the database
  $query = "INSERT INTO users (username, email, password, token) VALUES ('$username', '$email', '$hashedPassword', '$token')";
  $result = mysqli_query($db, $query);
  
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
  
  $mail->Subject = 'Verificare autenticitate cont';
  $mail->Body = 'Multumim pentru incredere si pentru decizia de a va inregistra!<br><br> 
                 Va rugam dati click pe link-ul de mai jos pentru a verifica adresa dumneavoastra de email:<br><br>
				 Username-ul ales de dumneavoastra este : '.$username.'<br><br>
				 127.0.0.1/edsa-asociatieProprietari/verify.php?token='.$token.'&email='.$email.'
                 ';
  
  if(!$mail->send()) {
    echo "<h1>Email-ul nu a putut fi trimis. Eroarea este : {$mail->ErrorInfo}</h1>";
  } else {
    echo "<h1>Un email de verificare a fost trimis la $email.</h1> <br>
	      <h1>Va rugam dati click pe link-ul din email pentru a va activa contul.</h1>";
  }

  $db->close();
}

function checkUsername($username) {
  // Connect to the database
  $db = new mysqli("127.0.0.1", "root", "", "my_users");

  // Check the connection
  if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
  }

  // Escape the username to prevent SQL injection
  $username = $db->real_escape_string($username);

  // Check if the username exists in the database
  $query = "SELECT * FROM users WHERE username = '$username'";
  $result = $db->query($query);

  // Return true if the username exists, false otherwise
  $exists = $result->num_rows > 0;

  // Close the database connection
  $db->close();

  return $exists;
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

function createUser($username, $email, $password) {
  // Connect to the database
  $db = new mysqli("127.0.0.1", "root", "", "my_users");

  // Check the connection
  if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
  }

  // Escape the username, email, and password to prevent SQL injection
  $username = $db->real_escape_string($username);
  $email = $db->real_escape_string($email);
  $password = $db->real_escape_string($password);

  // Hash the password for storage in the database
  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  // Insert the new user into the database
  $query = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashedPassword')";
  $result = $db->query($query);

  // Close the database connection
  $db->close();

  // Check if the query was successful
  if ($result) {
    // Return true if the query was successful
    return true;
  } else {
    // Return false if the query failed
    return false;
  }
}

?>

</body>
</html>
