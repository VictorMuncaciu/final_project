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

.updatePassText {
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
	$email = $_GET["email"];
	$password = $_POST["psw"];
	
	// Connect to the database
    $db = new mysqli("127.0.0.1", "root", "", "my_users");
	
	// Check the connection
    if ($db->connect_error) {
      die("Connection failed: " . $db->connect_error);
    }
	
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Update the user's password in the database and then update the passToken field to be NULL so that the user cannot update his password twice
    $query = "UPDATE users SET password='$hashedPassword', passToken='' WHERE email='$email'";
    mysqli_query($db, $query);
				
	echo "<div class='updatePassText'>
		    <h1>Parola dumneavoastra a fost actualizata cu succes.</h1> <br>
		    <a href='loginOrRegister.php' style='font-size: 30px;'>Apasati aici pentru a fi redirectionat la pagina de logare.</a>
		   </div>";
	
	$db->close();
?>

</body>
</html>
