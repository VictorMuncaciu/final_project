<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  
  <!-- BOOTSTRAP INTEGRATION -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  
  <!-- Header CSS integration -->
  <link rel="stylesheet" href="header.css">

  <title>
  e-Asociatie.ro - Gestionarea asociatilor de proprietari
  </title>
  
  <style>
	h1, h2, h3 {
		text-align: center;
	}
  
    /* Styles for the first page */
    #first-page {
      display: flex;
      justify-content: space-evenly;
      align-items: center;
      height: 100%;
    }
	
    #menu {
      /* Style for the menu */
      text-align: center;
    }

    .menu-button {
		color: white;
		background-color: blue;
		border-radius: 5px;
		/* Other styles for the menu buttons */
		
		width: 150px;
		height: 50px;
		line-height: 50px;
		text-align: center;
	}
	
	.menu-button:hover {
		background-color: lightblue;
	}

    /* Styles for the second page */
    #second-page {
      /* Style for the main content */
    }
	
	#main-content {
		border: none;
	}
	
	.container {
		height: 100%;
		display: flex;
      }

    .section-1 {
		width: 30%;
		background-color: #f1f1f1;
		border-right: 5px solid lightblue;
      }

    .section-2 {
		width: 70%;
		background-color: #ffffff;
      }
	
	h3 {
	  text-align: center;
	}
  </style>
</head>

<?php include 'main_action_page.php';?>
<body>

<?php include 'header.php'; ?>
  
  <div class="container">
    <div class="section-1">
		<h1><i>Statistici generale : </i></h1><br>
		
		<?php
		// Connect to the database
			$db = new mysqli("127.0.0.1", "root", "", "my_users");

			// Check the connection
			if ($db->connect_error) {
				die("Connection failed: " . $db->connect_error);
			}
			
			// Numar utilizatori inregistrati
			$query = "SELECT
						COUNT(id) AS id_users_counter
					FROM
						users;";
					
			$result = mysqli_query($db, $query);
			$row = mysqli_fetch_assoc($result);
			$idUsersCount = $row['id_users_counter'];
			
			echo "<h3>Numarul de utilizatori e-Asociatie inregistrati : <b style='color: #1C98FF;'>" . $idUsersCount . "</b></h3><br><br>";
			
			
			// Numar asociatii inscrise
			$query = "SELECT
						COUNT(id_asociatie) AS id_asociatie_counter
					FROM
						tbcreareasociatie;";
					
			$result = mysqli_query($db, $query);
			$row = mysqli_fetch_assoc($result);
			$idAsociatieCount = $row['id_asociatie_counter'];	

			echo "<h3>Numarul de asociatii inscrise pe e-Asociatie : <b style='color: #1C98FF;'>" . $idAsociatieCount . "</b></h3><br><br>";

			// Numar inregistrari de carti imobil adaugate
			$query = "SELECT
						COUNT(id_carte_imobil) AS id_carti_imobil_counter
					FROM
						tbcarteaimobilului;";
					
			$result = mysqli_query($db, $query);
			$row = mysqli_fetch_assoc($result);
			$idCarteImobilCount = $row['id_carti_imobil_counter'];	

			echo "<h3>Numarul de inregistrari de carti imobil adaugate pe e-Asociatie : <b style='color: #1C98FF;'>" . $idCarteImobilCount . "</b></h3>";			
			
			$db->close();
		?>
	</div>
	<div class="section-2" id="about-section">
		<h2><b>Iti punem la dispozitie unelte pentru stocarea datelor pentru contoare si afisarea cu usurinta a actelor asociatiei de care apartineti.</b></h2><br>
		
		<h3>Site-ul permite <b style="color: #1C98FF;">introducerea</b> valorilor din luna curenta si <b style="color: #1C98FF;">trimiterea</b> lor catre asociatia de care apartineti. De asemenea, consumul este calculat <b style="color: #1C98FF;">automat</b> in momentul introducerii valorilor.</h3>
		<div style="text-align: center;">
			<img src="myCountersDemo.png" alt="Counters Demo" width="80%" height="150">
		</div><br><br>

		<h2><b>Te-ai saturat de cautarea actelor asociatiei tale?</b></h2>
		<h3>Afisarea in intregime si <b style="color: #1C98FF;">citirea</b> actelor care apartin asociatiei dumneavoastra nu a fost niciodata mai <b style="color: #1C98FF;">usoara</b>. Nu mai este nevoie sa apelati la solicitari de acte. Le aveti pe toate intr-un singur loc si la un singur click distanta.</h3>
		<div style="text-align: center;">
			<img src="myDocumentsDemo.png" alt="Documents Demo" width="80%" height="400">
		</div><br><br>
		
		
		<br><br>
		<?php
		  echo "<h2><b>Informatii despre starea de logare : </b></h2>";
		  
		  if (isset($_SESSION["email"]) && isset($_SESSION["username"])) {
			echo "<h3>From session:: Buna ziua! Email-ul user-ului logat este: " . $_SESSION["email"] . " iar username-ul este : " . $_SESSION["username"] . "</h3>";
		  } elseif (isset($_COOKIE["email"]) && isset($_COOKIE["username"])) {
			echo "<h3>From cookie:: Buna ziua! Email-ul user-ului logat este: " . $_COOKIE["email"] . " iar username-ul este : " . $_COOKIE["username"] . "</h3>";
		  } else {
			echo "<h3>Nu este logat niciun user momentan.</h3>";
		  }
		?>
    </div>
  </div><br>
  
<div id="contact-section">
<?php include 'footer.php'; ?>
</div>
  
</div>

  <!-- Bootstrap integration -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  
</body>
</html>