<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
     
  <title>Id Scara Result - e-Asociatie</title>
  
  <style>
    h1, h3, h4 {
	  text-align: center;
	}
  </style>
  
</head>

<body>

<?php 
// Get the values from the form
$adresa = $_POST["adresaField"];
$numeBloc = $_POST["numeBlocField"];
$scara = $_POST["scaraField"];

// Connect to the database
$db = new mysqli("127.0.0.1", "root", "", "my_users");

// Check the connection
if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}

// Query to return the id_scara based on the input introduced by creator
$query = "SELECT
			tbscara.id_scara
		FROM
			tbscara
		INNER JOIN tbbloc ON tbscara.id_bloc = tbbloc.id_bloc
		WHERE
			tbbloc.Adresa = '$adresa' AND tbbloc.nume_bloc = '$numeBloc' AND tbscara.Scara = '$scara';";
$result = mysqli_query($db, $query);

if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	$id_scara = $row["id_scara"];
	
	echo "<h1>ID_SCARA REZULTAT ESTE : " . $id_scara . "</h1>";
} else {
	echo "<h1>Se pare ca nu exista scara cu aceste informatii. Verifica din nou acuratetea adresei, numelui de bloc si scarii!</h1>";
}

echo '<a href="searchForCarteImobil.php">';
echo '<h3>Inapoi la Gestionare carte imobil</h3>';
echo '</a>';

?>

</body>
</html>