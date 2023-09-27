<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">

<title>e-Asociatie</title>

<style>
  	h3, h4 {
	  text-align: center;
	}

	table, th, td {
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
<body>

<?php
    // Connect to the database
    $db = new mysqli("127.0.0.1", "root", "", "my_users");

	// Check the connection
    if ($db->connect_error) {
      die("Connection failed: " . $db->connect_error);
    }
	
	$query = "SELECT
				tbcarteaimobilului.id_carte_imobil,
				tbcarteaimobilului.Nume,
				tbcarteaimobilului.Prenume,
				tbcarteaimobilului.Seria,
				tbcarteaimobilului.Nr,
				tbcarteaimobilului.DataMutareInImobil,
				tbtipuladresei.Tip_Adresa,
				tbscara.Scara,
				apartamente.nr_apartament,
				tbcarteaimobilului.MembruAsociatie,
				tbpersoana.Tip_persoana,
				tbcreareasociatie.Denumire,
				tbcarteaimobilului.id_user
			FROM
				tbcarteaimobilului
			INNER JOIN tbtipuladresei ON tbcarteaimobilului.id_tip_adresa = tbtipuladresei.id_tip_adresa
			INNER JOIN tbscara ON tbcarteaimobilului.id_scara = tbscara.id_scara
			INNER JOIN apartamente ON tbcarteaimobilului.id_apartament = apartamente.id_apartament
			INNER JOIN tbpersoana ON tbcarteaimobilului.id_persoana = tbpersoana.id_persoana
			INNER JOIN tbcreareasociatie ON tbcarteaimobilului.id_asociatie = tbcreareasociatie.id_asociatie;";
    $result = mysqli_query($db, $query);
	
	$rows = array();
	
	while ($row = mysqli_fetch_assoc($result)) {
		$rows[] = $row;
	}
	
	if ($result->num_rows > 0) {
		echo "<table>";
		echo "<tr>";
		echo "<th>ID_CARTE_IMOBIL</th>";
		echo "<th>Nume</th>";
		echo "<th>Prenume</th>";
		echo "<th>Seria</th>";
		echo "<th>Nr</th>";
		echo "<th>Data Mutare In Imobil</th>";
		echo "<th>Tip adresa</th>";
		echo "<th>Scara</th>";
		echo "<th>Nr Apartament</th>";
		echo "<th>ESTE MEMBRU ASOCIATIE</th>";
		echo "<th>Tip Persoana</th>";
		echo "<th>Asociatia la care apartine</th>";
		echo "<th>ID_USER</th>";
		echo "</tr>";
		
		for ($i = 0; $i < count($rows); $i++) {
			echo "<tr>";
			echo "<td>" . $rows[$i]['id_carte_imobil'] . "</td>";
			echo "<td>" . $rows[$i]['Nume'] . "</td>";
			echo "<td>" . $rows[$i]['Prenume'] . "</td>";
			echo "<td>" . $rows[$i]['Seria'] . "</td>";
			echo "<td>" . $rows[$i]['Nr'] . "</td>";
			echo "<td>" . $rows[$i]['DataMutareInImobil'] . "</td>";
			echo "<td>" . $rows[$i]['Tip_Adresa'] . "</td>";
			echo "<td>" . $rows[$i]['Scara'] . "</td>";
			echo "<td>" . $rows[$i]['nr_apartament'] . "</td>";
			echo "<td>" . $rows[$i]['MembruAsociatie'] . "</td>";
			echo "<td>" . $rows[$i]['Tip_persoana'] . "</td>";
			echo "<td>" . $rows[$i]['Denumire'] . "</td>";
			echo "<td>" . $rows[$i]['id_user'] . "</td>";
			echo "</tr>";
		}

		echo "</table><br>";		
	} else {
		echo "<h4>Nu avem inregistrari carte imobil de afisat INCA! Verificati mai tarziu!</h4>";
	}
?>

</body>
</html>