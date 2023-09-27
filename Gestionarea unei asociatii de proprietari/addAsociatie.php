<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  
  <!-- BOOTSTRAP INTEGRATION -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  
  <!-- Header CSS integration -->
  <link rel="stylesheet" href="header.css">
  
  <title>Adaugare Asociatie Noua - e-Asociatie</title>
  
  <style>
    h1, h3, h4 {
	  text-align: center;
	}
  </style>
  
</head>

<?php session_start(); ?>
<body>

<?php include 'header.php'; ?>

<?php

// Get the values from the form
$denumireAsociatie = $_POST["denumireField"];
$cod = $_POST["codField"];
$codFiscal = $_POST["codFiscalField"];
$adresa = $_POST["adresaField"];
$presedinte = $_POST["presedinteField"];
$cenzor = $_POST["cenzorField"];
$administrator = $_POST["administratorField"];
$contabil = $_POST["contabilField"];
$casier = $_POST["casierField"];
$banca = $_POST["bancaField"];
$codBancar = $_POST["codBancarField"];

// Connect to the database
$db = new mysqli("127.0.0.1", "root", "", "my_users");

// Check the connection
if ($db->connect_error) {
  die("Connection failed: " . $db->connect_error);
}

// Insert the new user into the database
$query = "INSERT INTO tbcreareasociatie (Denumire, Cod, CodFiscal, Adresa, Presedinte, Cenzor, Administrator, Contabil, Casier, Banca, CodBancar)
		  VALUES ('$denumireAsociatie', '$cod', '$codFiscal', '$adresa', '$presedinte', '$cenzor','$administrator', '$contabil', '$casier','$banca', '$codBancar')";

// Check if the query was successful
if ($db->query($query)) {
    echo "<h1>Record inserted successfully</h1><br>";
} else {
    echo "<h1>Error inserting record: " . $db->error . "</h1>";
}

echo '<a href="creator_addAsociatie.php">';
echo '<h3>Inapoi la Adaugare Asociatie Noua</h3>';
echo '</a>';

// Close the database connection
$db->close();
  
?>

</div>

<!-- BOOTSTRAP INTEGRATION -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>