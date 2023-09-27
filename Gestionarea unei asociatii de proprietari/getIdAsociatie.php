<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
     
  <title>Id Asociatie Result - e-Asociatie</title>
  
  <style>
    h1, h3, h4 {
	  text-align: center;
	}
  </style>
  
</head>

<body>

<?php 
// Get the values from the form
$denumireAsociatie = $_POST["asociatieField"];

// Connect to the database
$db = new mysqli("127.0.0.1", "root", "", "my_users");

// Check the connection
if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}

// Query to return the id_scara based on the input introduced by creator
$query = "SELECT id_asociatie FROM tbcreareasociatie WHERE Denumire = '$denumireAsociatie';";
$result = mysqli_query($db, $query);

if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	$id_asociatie = $row["id_asociatie"];
	
	echo "<h1>ID_ASOCIATIE REZULTAT ESTE : " . $id_asociatie . "</h1>";
} else {
	echo "<h1>Se pare ca nu exista asociatie cu aceasta denumire. Verifica din nou pentru typo-uri!</h1>";
}

echo '<a href="searchForCarteImobil.php">';
echo '<h3>Inapoi la Gestionare carte imobil</h3>';
echo '</a>';

?>

</body>
</html>