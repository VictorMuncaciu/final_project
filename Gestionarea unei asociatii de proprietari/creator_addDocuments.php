<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  
  <!-- BOOTSTRAP INTEGRATION -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  
  <!-- Header CSS integration -->
  <link rel="stylesheet" href="header.css">
  
  <title>Adaugare acte asociatie - e-Asociatie</title>
  
  <style>
  	.container {
	  padding: 16px;
	  border-radius: 15px;
	  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
	}	
	
	input[type=file], input[type=number]{
		width: 100%;		
		text-align: center;
		padding: 12px 10px;
		margin: 8px 0;
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

<form action="uploadPDF.php" method="post" enctype="multipart/form-data" style="width: 30%; margin: 0 auto;">
	<div class="container">
        <label for="pdf_file"><h3>Select PDF file (max 2MB) : </h3></label>
        <input type="file" name="pdf_file" id="pdf_file" accept=".pdf">
		
		<label for="idAsociatieField"><h3>Id-ul asociatiei de care apartine documentul (cauta in Search Tools for Carte Imobil id asociatie) : </h3></label>
		<input type="number" placeholder="Introduceti id asociatie" id="idAsociatieField" name="idAsociatieField" min="1">		
		
        <input type="submit" value="Upload">
	</div>
</form><br>

<?php include 'footer.php'; ?>

</div>

<script>

</script>

<!-- BOOTSTRAP INTEGRATION -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>