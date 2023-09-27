<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  
  <!-- BOOTSTRAP INTEGRATION -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  
  <!-- Header CSS integration -->
  <link rel="stylesheet" href="header.css">
  
  <title>Actele mele - e-Asociatie</title>
  
  <style>
    h3, h4 {
		text-align: center;
	}
	
	.pdf-link {
		text-align: center;
		transition: background-color 0.3s ease;
	}
	
	.pdf-link:hover {
		background-color: lightblue;
	}
  </style>
</head>

<?php session_start(); ?>
<body>

  <?php include 'header.php'; ?>
  
	<?php
		if (isset($_SESSION["username"])) {
			$username = $_SESSION["username"];
		}
		else {
			if (isset($_COOKIE["username"])) {
				$username = $_COOKIE["username"];
			}
		}
		echo "<h3>Salut $username! Bine ai venit pe pagina actelor asociatiei tale!</h3> <hr><br>"; 
	?> 

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
					id_asociatie
				  FROM
					tbcarteaimobilului
				  WHERE
					id_user = $id_user
				  LIMIT 1;";
					
		$result = mysqli_query($db, $query);
		$row = mysqli_fetch_assoc($result);
		$accountAsociatie = $row['id_asociatie'];
		
		$query = "SELECT
					COUNT(id_pdf) AS pdf_counter
				  FROM
					tbpdf
				  WHERE
					id_asociatie = $accountAsociatie;";
					
		$result = mysqli_query($db, $query);
		
		$pdfCount = 0;
		if ($result) {
			if($result->num_rows > 0) {
				$row = mysqli_fetch_assoc($result);
				$pdfCount = $row['pdf_counter'];
			}
		}
		
		// Check if asociatie has uploaded documents, if so then display them on the screen, if not display message indicating no documents are present
		if($pdfCount > 0) {
			$query = "SELECT pdf_file_path FROM tbpdf WHERE id_asociatie = $accountAsociatie;";
			$result = mysqli_query($db, $query);
			for($i = 0; $i < $pdfCount; $i++)
			{
				$row = mysqli_fetch_assoc($result);
				$pdfPath = $row['pdf_file_path'];
				
				echo '<div class="pdf-link">';
				echo '<a href="' . $pdfPath . '">';
				echo '<img src="pdf-icon.png" alt="PDF icon" width="15%" height="15%">';
				echo '</a>';
				echo '<a href="' . $pdfPath . '">' . basename($pdfPath, ".pdf") . '</a>';
				echo '</div><br>';
			}
		} else {
			echo "<h4>Se pare ca asociatia dvs. NU are incarcate documente inca! Incercati mai tarziu!</h4><br><br>";
		}
	?>

	<?php include 'footer.php'; ?>

	</div>

  <!-- BOOTSTRAP INTEGRATION -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>