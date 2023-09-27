<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  
  <!-- BOOTSTRAP INTEGRATION -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  
  <!-- Header CSS integration -->
  <link rel="stylesheet" href="header.css">
  
  <title>Cererile mele - e-Asociatie</title>
  
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

	.container {
	  padding: 16px;
	  border-radius: 15px;
	  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
	}	
	
	input[type=text]{
		width: 100%;		
		text-align: center;
		padding: 12px 10px;
		margin: 8px 0;
	}
	
	input[type=reset] {
	  width: 100%;		
	  background-color: #FF7E7E;
	  color: white;
	  padding: 14px 20px;
	  margin: 8px 0;
	  border: none;
	  cursor: pointer;
	}

	input[type=reset]:hover {
	  background-color: #FF5B5B;
	}

	input[type=submit] {
	  width: 100%;
	  padding: 14px 20px;
	  background-color: #7a99ff;
	  color: white;
	  border: none;
	  cursor: pointer;
	}

	input[type=submit]:hover {
	  background-color: #4570ff;
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
		echo "<h3>Salut $username!<br>
			  Bine ai venit pe pagina cererilor tale!<br> Aici poti vedea si trimite cereri catre creatorul site-ului!</h3> <hr><br>"; 
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
	
	$query = "SELECT Message, is_resolved FROM tbuserrequests WHERE id_user = $id_user;";
	$result = mysqli_query($db, $query);
	
	$rows = array();
	
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}	
	
	echo "<h3>Cererile tale:</h3>";
	if ($result->num_rows > 0) {
		echo "<table>";
		echo "<tr>";
		echo "<th>Mesaj</th>";
		echo "<th>Este solutionata cererea?</th>";
		echo "</tr>";		
		
		for ($i = 0; $i < count($rows); $i++) {
			echo "<tr>";
			echo "<td>" . $rows[$i]['Message'] . "</td>";
			if($rows[$i]['is_resolved'] == 1) {
				echo "<td><h4 style='color: green;'>DA</h4></td>";
			} else {
				echo "<td><h5 style='color: red;'>NU! URMEAZA SA FIE SOLUTIONATA IN CEL MAI SCURT TIMP!</h5></td>";
			}
			echo "</tr>";
		}
		
		echo "</table><br>";
	} else {
		echo "<h4>Nu avem cereri de afisat INCA pt contul dumneavoastra! Mai jos puteti trimite o cerere la creator!</h4><br>";
	}


echo "<h3>Trimite o cerere:</h3>";

echo '<form action="addRequest.php" method="post" onsubmit="return validateForm()" style="width: 70%; margin: 0 auto;">';
	echo '<div class="container">';
		echo '<textarea id="messageField" name="messageField" placeholder="Introduceti mesajul dvs." style="width: 100%; height: 100px;" maxlength="300"></textarea>';
		
		echo '<input type="hidden" name = "id_user" value="' . $id_user . '"></input>';
		echo '<input type="submit" value="Trimite cererea"></input>';
	echo '</div>';
echo '</form><br>';

?>

<?php include 'footer.php'; ?>

</div>

<script>
function validateForm() {
  var textarea = document.getElementById("messageField").value;

  if (textarea == "") {
    alert("Va rugam introduceti un mesaj pentru a putea fi trimis!");
    return false;
  }
  
  return true;
}
</script>

  <!-- BOOTSTRAP INTEGRATION -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>