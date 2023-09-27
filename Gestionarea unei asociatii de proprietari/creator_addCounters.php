<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  
  <!-- BOOTSTRAP INTEGRATION -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  
  <!-- Header CSS integration -->
  <link rel="stylesheet" href="header.css">
  
  <title>Adaugare Contor Nou - e-Asociatie</title>
  
  <style>
	.container {
	  padding: 16px;
	  border-radius: 15px;
	  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
	}	
	
	input[type=text], input[type=number], input[type=date]{
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

<form action="addContor.php" method="post" onsubmit="return validateForm()" style="width: 30%; margin: 0 auto;">
	<div class="container">
		<label for="denumireContorField"><h3>Denumire Contor : </h3></label>
		<input type="text" placeholder="Introduceti denumirea contorului" id="denumireContorField" name="denumireContorField" maxlength="50">
		
		<input type="reset" value="Resetare formular"></input>
		<input type="submit" value="Adauga Contor"></input>
	</div>
</form><br>

<?php include 'footer.php'; ?>

</div>

<script>
function validateForm() {
  var inputs = document.getElementsByTagName('input');
  
  for (var i = 0; i < inputs.length; i++) {
    var input = inputs[i];
    
    if (input.value === '') {
      alert('Please complete all fields.');
      return false;
    }
  }
  
  return true;
}
</script>

<!-- BOOTSTRAP INTEGRATION -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>