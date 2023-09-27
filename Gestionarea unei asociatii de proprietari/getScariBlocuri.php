<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">

<title>e-Asociatie</title>

<style>
  	h3, h4 {
	  text-align: center;
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

	table, th, td {
		text-align: center;
		border: 1px solid black;
		margin: 0 auto;
	}
	
	tr:first-child {
		background-color: #1C98FF;
	}
	
	tr:nth-child(even) {
		background-color: lightblue;
	}
</style>

</head>
<body>

<div class="subCategoryContainer">
	<h3>Tabel tbScara</h3> 
</div><br>

<?php
    // Connect to the database
    $db = new mysqli("127.0.0.1", "root", "", "my_users");

	// Check the connection
    if ($db->connect_error) {
      die("Connection failed: " . $db->connect_error);
    }
	
	$query = "SELECT
				id_scara,
				id_bloc,
				Scara,
				nr_ap_scara
			FROM
				tbscara;";
    $result = mysqli_query($db, $query);
	
	$rows = array();
	
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	
	if ($result->num_rows > 0) {
		echo "<table>";
		echo "<tr>";
		echo "<th>ID_SCARA</th>";
		echo "<th>ID_BLOC</th>";
		echo "<th>Scara</th>";
		echo "<th>nr_ap_scara</th>";
		echo "</tr>";
		
		for ($i = 0; $i < count($rows); $i++) {
			echo "<tr>";
			echo "<td>" . $rows[$i]['id_scara'] . "</td>";
			echo "<td>" . $rows[$i]['id_bloc'] . "</td>";
			echo "<td>" . $rows[$i]['Scara'] . "</td>";
			echo "<td>" . $rows[$i]['nr_ap_scara'] . "</td>";
			echo "</tr>";
		}

		echo "</table><br>";		
	} else {
		echo "<h4>Nu avem inregistrari scara de afisat INCA! Verificati mai tarziu!</h4>";
	}
	
	// Close the database connection
	$db->close();
?>

<div class="subCategoryContainer">
	<h3>Tabel tbBloc</h3> 
</div><br>

<?php
    // Connect to the database
    $db = new mysqli("127.0.0.1", "root", "", "my_users");

	// Check the connection
    if ($db->connect_error) {
      die("Connection failed: " . $db->connect_error);
    }
	
	$query = "SELECT
				id_bloc,
				Descriere,
				nume_bloc,
				nr_scari,
				Adresa
			FROM
				tbbloc;";
    $result = mysqli_query($db, $query);
	
	$rows = array();
	
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	
	if ($result->num_rows > 0) {
		echo "<table>";
		echo "<tr>";
		echo "<th>ID_BLOC</th>";
		echo "<th>Descriere</th>";
		echo "<th>nume_bloc</th>";
		echo "<th>nr_scari</th>";
		echo "<th>Adresa</th>";
		echo "</tr>";
		
		for ($i = 0; $i < count($rows); $i++) {
			echo "<tr>";
			echo "<td>" . $rows[$i]['id_bloc'] . "</td>";
			echo "<td>" . $rows[$i]['Descriere'] . "</td>";
			echo "<td>" . $rows[$i]['nume_bloc'] . "</td>";
			echo "<td>" . $rows[$i]['nr_scari'] . "</td>";
			echo "<td>" . $rows[$i]['Adresa'] . "</td>";
			echo "</tr>";
		}

		echo "</table><br>";		
	} else {
		echo "<h4>Nu avem inregistrari bloc de afisat INCA! Verificati mai tarziu!</h4>";
	}
	
	// Close the database connection
	$db->close();
?>

</body>
</html>