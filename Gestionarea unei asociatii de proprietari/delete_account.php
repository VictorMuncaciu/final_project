<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Dezactivare cont - e-Asociatie.ro</title>
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
// Connect to the database
$conn = new mysqli("127.0.0.1", "root", "", "my_users");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

session_start();
// Get email from session or cookie
if (isset($_SESSION["email"])) {
	$email = $_SESSION["email"];
	}
	else {
		if (isset($_COOKIE["email"])) {
		$email = $_COOKIE["email"];
		}
	}

// $query1 = "DELETE FROM users WHERE email = $email";
$query = "UPDATE users SET is_active = 0 WHERE email = '$email'";

if (mysqli_query($conn, $query)) {
	echo "<h1>Contul a fost dezactivat cu succes! Dati click <a href='testMainPage.php'>aici</a>, pe logo-ul site-ului, sau pe butonul din stanga sus pentru a reveni la pagina principala!</h1>";
	// Destroy the session data so the user does not stay logged in after account deactivation
	session_unset();
	session_destroy();
	setcookie("email", "", time() - 3600, "/");
	setcookie("username", "", time() - 3600, "/");
	setcookie("id_user", "", time() - 3600, "/");
}
else {
    echo "<h1>Eroare la dezactivarea contului: " . $conn->error . "</h1>";
  }
  
// Close MySQL connection
$conn->close();
?>