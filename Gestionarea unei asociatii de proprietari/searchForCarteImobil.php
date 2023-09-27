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
	
	.container {
	  padding: 16px;
	  border-radius: 15px;
	  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
	}	
	
	input[type=text]{
		width: calc(100% - 24px);		
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

<body>

<div class="subCategoryContainer">
	<h3>Cautare Id Scara</h3> 
</div>

<br>

<form action="getIdScara.php" method="post" onsubmit="return validateForm()" style="width: 30%; margin: 0 auto;">
	<div class="container">
		<label for="adresaField"><h3>Adresa in acest format : Nume strada(spatiu)nr.(spatiu)numar strada</h3></label>
		<input type="text" placeholder="Introduceti adresa" id="adresaField" name="adresaField">
		
		<label for="numeBlocField"><h3>Nume bloc (nr. bloc): </h3></label>
		<input type="text" placeholder="Introduceti nume bloc" id="numeBlocField" name="numeBlocField">
		
		<label for="scaraField"><h3>Scara : </h3></label>
		<input type="text" placeholder="Introduceti scara" id="scaraField" name="scaraField">
		
		<input type="reset" value="Resetare formular"></input>
		<input type="submit" value="Cauta Id Scara"></input>
	</div>
</form><br>

<div class="subCategoryContainer">
	<h3>Search Denumire Asociatie</h3> 
</div><br>

<form action="getIdAsociatie.php" method="post" onsubmit="return validateForm2()" style="width: 30%; margin: 0 auto;">
	<div class="container">
		<label for="asociatieField"><h3>Numele Asociatiei : </h3></label>
		<input type="text" placeholder="Introduceti numele asociatiei" id="asociatieField" name="asociatieField">
		
		<input type="submit" value="Cauta Id Asociatie"></input>
	</div>
</form>

<script>
function validateForm() {
  var adresa = document.getElementById("adresaField").value;
  var numeBloc = document.getElementById("numeBlocField").value;
  var scara = document.getElementById("scaraField").value;

  if (adresa == "") {
    alert("Te rog adauga o adresa!");
    return false;
  }

  if (numeBloc == "") {
    alert("Te rog adauga un nume de bloc!");
    return false;
  }
  
  if (scara == "") {
    alert("Te rog adauga o scara!");
    return false;
  }
  
  return true;
}

function validateForm2() {
  var asociatie = document.getElementById("asociatieField").value;

  if (asociatie == "") {
    alert("Te rog adauga o denumire de asociatie!");
    return false;
  }
  
  return true;
}
</script>

</body>
</html>