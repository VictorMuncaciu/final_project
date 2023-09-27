<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  
  <!-- BOOTSTRAP INTEGRATION -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  
  <!-- Header CSS integration -->
  <link rel="stylesheet" href="header.css">
  
  <title>Contul meu - e-Asociatie</title>
  
    <style>
  	h3, h4 {
	  text-align: center;
	}
	
	.submitButton {
		text-align: center;
	}
	
	.mainButton {
		color: white;
		border: none;
		padding: 10px 20px;
		border-radius: 5px;
		font-size: 16px;
	}
	
	input[type=password], input[type=text] {
		text-align: center;
	}
	
	.delete-button {
		color: white;
		border: none;
		padding: 10px 20px;
		border-radius: 5px;
		font-size: 16px;
	}
	
	.subCategoryContainer {
		text-align: center;
		margin: auto;
		width: 40%;
		border-style: dashed;
		border-color: red;
		box-shadow: 6px 3px 5px #0d6efd;
	}
	
	.subCategoryContainer:hover {
		background-color: lightblue;
	}

  </style>
</head>

<?php session_start(); ?>
<body>

<?php include 'header.php'; ?>

<div class="container">
	<?php
		if (isset($_SESSION["username"])) {
			$username = $_SESSION["username"];
		}
		else {
			if (isset($_COOKIE["username"])) {
				$username = $_COOKIE["username"];
			}
		}
		echo "<h3>Salut $username! Bine ai venit pe pagina contului tau!</h3> <hr><br><br>"; 
	?>
	
	<div class="subCategoryContainer">
		<h4>Schimbare parola</h4> 
	</div>
	
	<form action="creatorChangePassword.php" method="post" onsubmit="return validateForm2()">
		<div class="mb-3 mx-auto" style="width:30%;">
			<label for="currentPass" class="form-label"><h4>Parola curenta: </h4></label>
			<input type="password" class="form-control" placeholder="Introduceti parola curenta" id="currentPass" name="currentPass">
			
			<label for="newPass"><h4>Parola noua:</h4></label>
			<input type="password" class="form-control" placeholder="Introduceti parola noua" name="newPass" id="newPass">

			<label for="pass-repeat"><h4>Reintroduceti parola:</h4></label>
			<input type="password" class="form-control" placeholder="Reintroduceti parola" name="pass-repeat" id="pass-repeat">
			
			<?php
				if (isset($_SESSION['succes_pass_change'])) {
					echo "<h4 style = 'color: green;'>Parola a fost schimbata cu succes!</h4>";
					unset($_SESSION['succes_pass_change']);
				}
				
				if (isset($_SESSION['incorrect_pass'])) {
					echo "<h4 style = 'color: red;'>Parola NU este corecta. Incercati din nou!</h4>";
					unset($_SESSION['incorrect_pass']);
				}
			?>
			
		</div>
		
		<div class="mb-3 mx-auto" style="width:30%; text-align: center;">
			<input type="submit" class="btn btn-primary mainButton" value="Schimba parola"></input>
		</div>
	</form>
</div>

<?php include 'footer.php'; ?>

</div>

<script>
  function validateForm2() {
	var currentPass = document.getElementById("currentPass").value;
	var password = document.getElementById("newPass").value;
	var passwordRepeat = document.getElementById("pass-repeat").value;
	
	if (currentPass == "") {
		alert("Va rugam introduceti parola curenta.");
		return false;
	}
	
	if (password == "") {
		alert("Va rugam introduceti noua parola.");
		return false;
	}
  
	// Password must be at least 8 characters long
	if (password.length < 8) {
		alert("Va rugam introduceti o parola noua care are cel putin 8 caractere.");
		return false;
	}
  
    // Password must contain at least one number
	if (!/\d/.test(password)) {
		alert("Parola noua nu este destul de puternica. Va rugam introduceti o parola care contine cel putin un numar.");
		return false;
	}

	// Password must contain at least one uppercase letter
	if (!/[A-Z]/.test(password)) {
		alert("Parola noua nu este destul de puternica. Va rugam introduceti o parola care contine cel putin o litera de TIPAR!");
		return false;
	}

	// Password must contain at least one lowercase letter
	if (!/[a-z]/.test(password)) {
		alert("Parola noua nu este destul de puternica. Va rugam introduceti o parola care contine cel putin un caracter litera mica!");
		return false;
	}

	if (password != passwordRepeat) {
		alert("Parola noua nu se potriveste cu cea din campul Reintroduceti parola. Incercati din nou!");
		return false;
	}
	
	return true;
	
  }
</script>

  <!-- BOOTSTRAP INTEGRATION -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>