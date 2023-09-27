<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Logare - e-Asociatie</title>
</head>

<style>
h1, h2, p {
  text-align: center;
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

.backtohome {
  display: flex;
  align-items: center;
}

.backbutton {
  vertical-align: middle;
}

.container {
  background-color: #ffc107;
  padding: 20px 10px;
  border-radius: 15px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
}

.rememberForgotContainer {
  display: flex;
  justify-content: space-between;
}

.registerPopup {
  text-align: center;
}

.rounded-button, input[type=submit] {
  width: 50%;
  border-radius: 5px;
  color: white;
  background-color: #7a99ff;
  cursor: pointer;
  border: none;
  padding: 15px;
  font-size: 20px;
}

.submitButton {
  text-align: center;
}

.rounded-button:hover, input[type=submit]:hover {
  background-color: #88BDC6;
}

.registerText {
  font-size: 20px;
}

hr {
  border-color: #7a99ff;
}

input[type=password], input[type=text] {
  text-align: center;
  width: 100%;
  padding: 12px 10px;
  margin: 8px 0;
  border: 2px solid #AAF3FF;
  box-sizing: border-box;
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

  <h1>Bine ati venit pe site-ul e-Asociatie</h1>
  <h2>Introduceti datele de autentificare</h2>
  
  <form action="login_action_page.php" method="post" onsubmit="return validateForm()" style="width: 30%; margin: 0 auto;">
	<div class="container">
      <label for="email"><b>Email</b></label><br>
      <input type="text" placeholder="Introduceti email-ul" name="email" id="email"><br>

	  <!-- Error messages in case email of the user is not verified or is not correct -->
	  <?php
	    session_start();
		if (isset($_SESSION["emailNotVerified"]))
		{
		  // echo "Variabila emailNotVerified : " . $_SESSION["emailNotVerified"] . "<br>";
		  if ($_SESSION["emailNotVerified"]) {
		    echo "<p style='color:red'>Email-ul nu a fost verificat sau este dezactivat!</p>";
		  }
		}
		if (isset($_SESSION["incorrectEmail"]))
		{
		  // echo "Variabila incorrectEmail : " . $_SESSION["incorrectEmail"] . "<br>";
		  if ($_SESSION["incorrectEmail"]) {
		    echo "<p style='color:red'>Email-ul nu este inregistrat!</p>";
		  }
		}
	  ?>
  
      <label for="password"><b>Parola</b></label><br>
      <input type="password" placeholder="Introduceti parola" name="password" id="password"><br>
  
	  <!-- Error message in case password of the user is not correct -->
  	  <?php
	    if (isset($_SESSION["incorrectPass"])) 
		{
		  if ($_SESSION["incorrectPass"]) {
		    echo "<p style='color:red'>Parola incorecta!</p>";
		  }
		}
	  ?>
  
	  <div class="rememberForgotContainer">
		<div>
          <label for="remember">
			<input type="checkbox" id="remember" name="remember"> Ține-mă minte
		  </label>
		</div>
		<div>
	      <a href="resetPassword.html">Ai uitat parola?</a>
		</div>
	  </div>
	  
	  <br>
	  <div class="submitButton">
        <input type="submit" value="Logare in cont"></input>
	  </div>
	  <br>
	  <hr>
	  
	  <div class="registerPopup">
		<p class="registerText">Doresti sa creezi un cont nou? Apasa pe butonul de mai jos pentru a incepe!</p>
		<button type="button" onclick="location.href='register.html'" class="rounded-button">Inregistreaza-te</button>
	  </div>
	</div>
  </form>
  
  <!-- Set session variables to false to avoid getting error messages when the user refreshes the page -->
  <?php
    $_SESSION["emailNotVerified"] = false;
	$_SESSION["incorrectPass"] = false;
	$_SESSION["incorrectEmail"] = false;
  ?>

<script>

function validateForm() {
  var email = document.getElementById("email").value;
  var password = document.getElementById("password").value;
  
  if (email == "") {
    alert("Please enter an email address.");
    return false;
  }
  
  if (email.indexOf("@") === -1) {
	alert("Please enter a valid email address that contains @ character");
	return false;
  }
  
  // Split the email address into parts
  var parts = email.split("@");

  // Check if the email address contains exactly one "@" character
  if (parts.length !== 2) {
	alert("Please enter an email address that contains only one @ character.");
    return false;
  }

  // Check if the local part (the part before the "@" character) is not too long
  if (parts[0].length > 32) {
	alert("Please check the local part ( the part before @ ). It is too long.");
    return false;
  }

  // Check if the domain part (the part after the "@" character) is not too long
  if (parts[1].length > 32) {
    alert("Please check the domain part ( the part after @ ). It is too long.");
    return false;
  }

  // Check if the domain part contains at least one period (.) character
  // if (parts[1].indexOf(".") > 1 || parts[1].indexOf(".") < 1) {
  if (parts[1].indexOf(".") === -1) {
    alert("Please check how many dots you have in your domain part. It should be atleast 1. ");
    return false;
  }

  if (/[^a-zA-Z0-9@._+-]/.test(email)) {
    alert("Illegal character/characters present in your email. Please re-check for typos.");
    return false;
  }
  
  if (password == "") {
    alert("Please enter a password.");
    return false;
  }
  
  return true;
}
 
</script>
  
</body>
</html>