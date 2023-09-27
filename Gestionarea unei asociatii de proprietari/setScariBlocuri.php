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
	
	input[type=text], input[type=number]{
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
	<h3>Adaugare Scara</h3> 
</div><br>

<form action="addScara.php" method="post" onsubmit="return validateForm(this)" style="width: 30%; margin: 0 auto;">
	<div class="container">
		<label for="idBlocField"><h3>Id Bloc : </h3></label>
		<input type="number" placeholder="Introduceti id bloc" id="idBlocField" name="idBlocField" min="1">
		
		<label for="scaraField"><h3>Scara : </h3></label>
		<input type="text" placeholder="Introduceti scara" id="scaraField" name="scaraField" maxlength="10">
		
		<label for="nrApScaraField"><h3>Numar apartamente scara : </h3></label>
		<input type="text" placeholder="Introduceti numar apartamente scara" id="nrApScaraField" name="nrApScaraField">
		
		<input type="reset" value="Resetare formular"></input>
		<input type="submit" value="Adaugare scara"></input>
	</div>
</form><br>

<div class="subCategoryContainer">
	<h3>Adaugare Bloc</h3> 
</div><br>

<form action="addBloc.php" method="post" onsubmit="return validateForm(this)" style="width: 30%; margin: 0 auto;">
	<div class="container">
		<label for="descriereField"><h3>Descriere : </h3></label>
		<input type="text" placeholder="Introduceti descrierea" id="descriereField" name="descriereField" maxlength="50">
		
		<label for="numeBlocField"><h3>Numele blocului : </h3></label>
		<input type="text" placeholder="Introduceti numele blocului" id="numeBlocField" name="numeBlocField" maxlength="50">

		<label for="nrScariField"><h3>Numar scari : </h3></label>
		<input type="number" placeholder="Introduceti nr. scari" id="nrScariField" name="nrScariField" min="1">

		<label for="adresaField"><h3>Adresa in acest format : Nume strada(spatiu)nr.(spatiu)numar strada</h3></label>
		<input type="text" placeholder="Introduceti adresa" id="adresaField" name="adresaField" maxlength="150">
		
		<input type="reset" value="Resetare formular"></input>
		<input type="submit" value="Adaugare bloc"></input>
	</div>
</form>

<script>
function validateForm(form) {
  var inputs = form.getElementsByTagName('input');
  
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

</body>
</html>