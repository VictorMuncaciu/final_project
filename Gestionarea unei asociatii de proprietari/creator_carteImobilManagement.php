<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  
  <!-- BOOTSTRAP INTEGRATION -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  
  <!-- Header CSS integration -->
  <link rel="stylesheet" href="header.css">
  
  <title>Gestionare carte imobil - e-Asociatie</title>
  
  <style>
	.dynamicButtons{
      display: flex;
      justify-content: center;
    }
  </style>
  
</head>

<?php session_start(); ?>
<body>

<?php include 'header.php'; ?>

<div class="dynamicButtons">
	<button onclick="loadGetCarteImobil()">Afisare Carte Imobil</button>
	<button onclick="loadSearchCarteImobil()">Search Tools For Carte Imobil</button>
	<button onclick="loadSetCarteImobil()">Adaugare Carte Imobil</button>
</div>
  
<br>  
  
<iframe id="content-iframe" style="border: 5px solid #000;" width="100%" height="450"></iframe>

<br><br><br>

<?php include 'footer.php'; ?>

</div>

<script>
    function loadGetCarteImobil() {
      // Find the iframe element
      var iframe = document.getElementById('content-iframe');
      
      // Set the source attribute of the iframe to the PHP file
      iframe.src = 'getCarteImobil.php';
    }
	
	function loadSearchCarteImobil() {
      // Find the iframe element
      var iframe = document.getElementById('content-iframe');
      
      // Set the source attribute of the iframe to the PHP file
      iframe.src = 'searchForCarteImobil.php';
    }
	
    function loadSetCarteImobil() {
      // Find the iframe element
      var iframe = document.getElementById('content-iframe');
      
      // Set the source attribute of the iframe to the PHP file
      iframe.src = 'setCarteImobil.php';
    }	
</script>

<!-- BOOTSTRAP INTEGRATION -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>