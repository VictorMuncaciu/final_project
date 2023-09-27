<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  
  <!-- BOOTSTRAP INTEGRATION -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  
  <!-- Header CSS integration -->
  <link rel="stylesheet" href="header.css">
  
  <title>Administrare conturi - e-Asociatie</title>
  
    <style>
	
  	h3, h4 {
	  text-align: center;
	}

	table, th, td {
		margin: 0 auto;
		text-align: center;
		border: 1px solid black;
	}
  
  	tr:first-child {
		background-color: #1C98FF;
	}
	
	tr:nth-child(even) {
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
		echo "<h3>Salut $username!<br>
			  De pe aceasta pagina poti activa/dezactiva conturile utilizatorilor!</h3> <hr><br><br>"; 
	?>
</div>

<?php
	// Connect to the database
	$db = new mysqli("127.0.0.1", "root", "", "my_users");

	// Check the connection
	if ($db->connect_error) {
		die("Connection failed: " . $db->connect_error);
	}  
	
	$query = "SELECT id, email, is_active FROM users WHERE NOT email = 'victor_messi77@yahoo.com';";
	$result = mysqli_query($db, $query);
	
	$rows = array();
	
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}	
	
	if ($result->num_rows > 0) {
		echo "<table>";
		echo "<tr>";
		echo "<th>ID_USER</th>";
		echo "<th>EMAIL USER</th>";
		echo "<th>is_active</th>";
		echo "<th>ACTION</th>";
		echo "</tr>";		
		
		for ($i = 0; $i < count($rows); $i++) {
			echo "<tr>";
			echo "<td>" . $rows[$i]['id'] . "</td>";
			echo "<td>" . $rows[$i]['email'] . "</td>";
			echo "<td>" . $rows[$i]['is_active'] . "</td>";
			if($rows[$i]['is_active'] == 1) {
			    echo "<td><a href='accountActivationOrDeactivation.php?email=" . $rows[$i]['email'] . "&action=deactivate'><b>Dezactivare cont<b></a></td>";
			} else {
				echo "<td><a href='accountActivationOrDeactivation.php?email=" . $rows[$i]['email'] . "&action=activate'><b>Activare cont<b></a></td>";
			}
			echo "</tr>";
		}
		
		echo "</table><br>";
	} else {
		echo "<h4>Nu avem useri de afisat INCA! Verificati mai tarziu!</h4>";
	}
?>

<?php include 'footer.php'; ?>

</div>

<script>

</script>

  <!-- BOOTSTRAP INTEGRATION -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>