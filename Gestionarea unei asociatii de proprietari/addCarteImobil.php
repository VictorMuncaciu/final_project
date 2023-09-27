<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
     
  <title>Add Carte Imobil - e-Asociatie</title>
  
  <style>
    h1, h3, h4 {
	  text-align: center;
	}
  </style>
  
</head>

<body>

<?php

// Get the values from the form
$nume = $_POST["numeField"];
$prenume = $_POST["prenumeField"];
$seria = $_POST["seriaField"];
$nr = $_POST["nrField"];
$dataMutareInImobil = $_POST["dataMutareField"];
$tipAdresa = $_POST["tipAdresaField"];
$id_scara = $_POST["idScaraField"];
$id_apartament = $_POST["idApartamentField"];
$isMemberAsociatie = $_POST["isMemberAsociatieField"];
$id_persoana = $_POST["idPersoanaField"];
$id_asociatie = $_POST["idAsociatieField"];
$id_user = $_POST["idUserField"];

// Connect to the database
$db = new mysqli("127.0.0.1", "root", "", "my_users");

// Check the connection
if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}

// Insert the new carte imobil into the database
$query = "INSERT INTO tbcarteaimobilului (Nume, Prenume, Seria, Nr, DataMutareInImobil, id_tip_adresa, id_scara, id_apartament, MembruAsociatie, id_persoana, id_asociatie, id_user)
		  VALUES ('$nume', '$prenume', '$seria', '$nr', '$dataMutareInImobil', '$tipAdresa','$id_scara', '$id_apartament', '$isMemberAsociatie','$id_persoana', '$id_asociatie', '$id_user')";

// Check if the query was successful
if ($db->query($query)) {
    echo "<h1>Record inserted successfully</h1><br>";
} else {
    echo "<h1>Error inserting record: " . $db->error . "</h1>";
}

echo '<a href="setCarteImobil.php">';
echo '<h3>Inapoi la Gestionare carte imobil</h3>';
echo '</a>';

// Close the database connection
$db->close();
  
?>

</body>
</html>