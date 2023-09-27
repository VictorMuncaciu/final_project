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
	
	.imobilContainer {
		box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
		border: 2px solid red;
		transition: transform 0.2s, background-color 0.5s;
		width: 30%;
		height: 70%;
		margin: 0 auto;
		background-color: green;
	}
	
	.imobilContainer:hover {
		transform: scale(1.05);
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
		<h4>Informatii generale</h4> 
	</div>
	
	<?php 
		// Connect to the database
		$db = new mysqli("127.0.0.1", "root", "", "my_users");

		// Check the connection
		if ($db->connect_error) {
			die("Connection failed: " . $db->connect_error);
		}
					
		if (isset($_SESSION["id_user"])) {
			$id_user = $_SESSION["id_user"];
		}
		else {
			if (isset($_COOKIE["id_user"])) {
				$id_user = $_COOKIE["id_user"];
			}
		}			
		
		$query = "SELECT
					tbcreareasociatie.Denumire,
					tbbloc.Adresa,
					tbbloc.nume_bloc,
					tbscara.Scara,
					apartamente.nr_apartament
				  FROM
					tbcreareasociatie
				  INNER JOIN tbcarteaimobilului ON tbcreareasociatie.id_asociatie = tbcarteaimobilului.id_asociatie
				  INNER JOIN tbscara ON tbcarteaimobilului.id_scara = tbscara.id_scara
				  INNER JOIN tbbloc ON tbscara.id_bloc = tbbloc.id_bloc
				  INNER JOIN apartamente ON tbcarteaimobilului.id_apartament = apartamente.id_apartament
				 WHERE
					tbcarteaimobilului.id_user = $id_user;";
					
					
		$result = mysqli_query($db, $query);
		$row = $result->fetch_assoc();
		
		if ($result->num_rows > 0) {
			$denumireAsociatie = $row["Denumire"];
			echo "<h4>Asociatia de care apartineti:</h4>";
			echo '<h4><i><b>'.$denumireAsociatie.'</b></i></h4>';
			
			echo "<br>";
			
			echo "<div class='imobilContainer'>";
			echo "<h4><u>Imobil</u>:</h4>";
			
			$adresaImobil = $row["Adresa"];
			echo "<h4>Adresa:</h4>";
			echo '<h4><i><b>'.$adresaImobil.'</b></i></h4>';
			
			$numeBloc = $row["nume_bloc"];
			echo "<h4>Bloc:</h4>";
			echo '<h4><i><b>'.$numeBloc.'</b></i></h4>';
			
			$scara = $row["Scara"];
			echo "<h4>Scara:</h4>";
			echo '<h4><i><b>'.$scara.'</b></i></h4>';
			
			$nrApartament = $row["nr_apartament"];
			echo '<h4>Apartament:</h4>';
			echo '<h4><i><b>'.$nrApartament.'</b></i></h4>';
			
			$query = "SELECT
						Nume,
						Prenume
					  FROM
						tbcarteaimobilului
					  WHERE
						id_user = $id_user
					  ORDER BY
						Nume,
						Prenume;";
					
			$result = mysqli_query($db, $query);
			
			// Check if any rows were returned
			if ($result->num_rows > 0) {
    
				echo "<h4>Persoane in apartament:</h4>";
	
				// Initialize an array to store the rows
				$rows = array();

				// Loop through each row in the result set and store it in the array
				while ($row = mysqli_fetch_assoc($result)) {
					$rows[] = $row;
				}
				
				// Print the rows
				foreach ($rows as $row) {
					echo "<h4><i><b>". $row['Nume'] ." ". $row['Prenume'] . "</b></i></h4><br>";
				}
			}
			
			echo "</div><br>";
		} else {
			//echo "<br> 
				  //<h4><i><b>Nu putem extrage datele din baza de date e-Asociatie.ro</b></i></h4>
				  //<br>";
			echo "<br> 
				  <h4><i><b>Nu exista inca date asociate acestui cont in baza de date e-Asociatie.ro!<br><br>
							Trimiteti o cerere catre creatorul site-ului pentru a adauga aceste date!<br>
							Trebuie incluse urmatoarele informatii : numele tuturor persoanelor din apartament, seria si numarul actului de identitate pt fiecare persoana din apartament, data de mutare in imobil, tipul adresei(domiciliu sau resedinta), adresa completa, 
							care dintre persoane din apartament sunt membri de asociatie, tipul de persoana pentru fiecare membru, si carei asociatii apartineti.
				  </b></i></h4>
				  <br>";				  
			}
		
		$db->close();
	?>
	
	<div class="subCategoryContainer">
		<h4>Schimbare parola</h4> 
	</div>
	
	<form action="changePassword.php" method="post" onsubmit="return validateForm2()">
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
	
	<div class="subCategoryContainer">
		<h4>Schimbare email</h4> 
	</div>
	
	<?php
		if (isset($_SESSION["email"])) {
			$email = $_SESSION["email"];
		}
		else {
			if (isset($_COOKIE["email"])) {
				$email = $_COOKIE["email"];
			}
		}
		echo "<h4>Email-ul dvs. curent este:</h4>
			  <h4>$email</h4><br>";
	?>
	
	<form action="changeEmail.php" method="post" onsubmit="return validateForm()">
		<div class="mb-3 mx-auto" style="width:30%;">
			<label for="newEmail" class="form-label"><h4>Email nou: </h4></label>
			<input type="text" class="form-control" placeholder="Introduceti adresa noului email" id="newEmail" name="newEmail">
			
			<label for="psw"><h4>Parola curenta:</h4></label>
			<input type="password" class="form-control" placeholder="Introduceti parola" name="psw" id="psw">

			<label for="psw-repeat"><h4>Reintroduceti parola:</h4></label>
			<input type="password" class="form-control" placeholder="Reintroduceti parola" name="psw-repeat" id="psw-repeat">
			
			<?php
			if (isset($_SESSION['alert_message'])) {
				echo "<h4 style = 'color: red;'>Parola NU este corecta. Incercati din nou!</h4>";
				unset($_SESSION['alert_message']);
			}
			?>
			
		</div>
		<div class="mb-3 mx-auto" style="width:30%; text-align: center;">
			<input type="submit" class="btn btn-primary mainButton" value="Schimba email-ul"></input>
		</div>
	</form>

	<div class="subCategoryContainer">
		<h4>Dezactivare cont</h4> 
	</div>
	<br>
	
	<form action="delete_account.php" method="post" onsubmit="return validateForm1()">
		<div class="submitButton">
			<input type="submit" name="delete_account" class="btn btn-danger delete-button" value="Dezactivati contul"></input>
		</div>
	</form>
	
  </div><br>
  
  <?php include 'footer.php'; ?>
  
  </div>
  
  <script>
  function validateForm() {
	var email = document.getElementById("newEmail").value;
	var password = document.getElementById("psw").value;
	var passwordRepeat = document.getElementById("psw-repeat").value;
	
    if (email == "") {
    alert("Va rugam sa introduceti adresa noua de email!");
    return false;
  }
    
  if (email.indexOf("@") === -1) {
	alert("Va rugam introduceti o adresa de email valida care contine caracterul @");
	return false;
  }
  
  // Split the email address into parts
  var parts = email.split("@");

  // Check if the email address contains exactly one "@" character
  if (parts.length !== 2) {
	alert("Va rugam introduceti o adresa de email care contine numai un singur caracter @");
    return false;
  }

  // Check if the local part (the part before the "@" character) is not too long
  if (parts[0].length > 32) {
	alert("Va rugam verificati partea locala ( partea de dinainte de caracterul @ ). Este prea lunga.");
    return false;
  }

  // Check if the domain part (the part after the "@" character) is not too long
  if (parts[1].length > 32) {
	alert("Va rugam verificati partea de domeniu a adresei ( partea de dupa @ ). Este prea lunga.");
    return false;
  }

  // Check if the domain part contains at least one period (.) character
  // if (parts[1].indexOf(".") > 1 || parts[1].indexOf(".") < 1) {
    if (parts[1].indexOf(".") === -1) {
	alert("Va rugam verificati cate puncte aveti in partea de domeniu. Ar trebui sa contina cel putin un punct.");
    return false;
  }

  if (/[^a-zA-Z0-9@._+-]/.test(email)) {
	alert("Caracter/caractere ilegal/ilegale prezente in adresa de email. Va rugam reverificati pentru anumite greseli de scriere.");
    return false;
  }
  
    if (password == "") {
	alert("Va rugam introduceti parola curenta pentru a va confirma identitatea.");
    return false;
  }
  
  // Password must be at least 8 characters long
  if (password.length < 8) {
	alert("Va rugam introduceti o parola care are cel putin 8 caractere.");
    return false;
  }
  
    // Password must contain at least one number
  if (!/\d/.test(password)) {
	alert("Parola nu este destul de puternica. Va rugam introduceti o parola care contine cel putin un numar.");
    return false;
  }

  // Password must contain at least one uppercase letter
  if (!/[A-Z]/.test(password)) {
	alert("Parola nu este destul de puternica. Va rugam introduceti o parola care contine cel putin o litera de TIPAR!");
    return false;
  }

  // Password must contain at least one lowercase letter
  if (!/[a-z]/.test(password)) {
	alert("Parola nu este destul de puternica. Va rugam introduceti o parola care contine cel putin un caracter litera mica!");
    return false;
  }

  if (password != passwordRepeat) {
    alert("Parolele nu se potrivesc.");
    return false;
  }
  
  return true;
  }
  
  function validateForm1() {
    // show a confirm dialog box
    const confirmed = confirm('Sunteti sigur ca doriti sa va dezactivati contul?');

    // check if the user clicked OK
    if (confirmed) {
      // if confirmed, return true to submit the form
      return true;
    } else {
      // if not confirmed, return false to prevent the form from submitting
      return false;
    }
  }
  
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