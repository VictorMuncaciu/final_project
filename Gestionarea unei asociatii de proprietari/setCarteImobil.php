<!doctype html>
<html lang="en">

<head>
<meta charset="utf-8">

<title>e-Asociatie</title>

<style>
  	h3, h4 {
	  text-align: center;
	}
	
	.container {
	  padding: 16px;
	  border-radius: 15px;
	  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
	}	
	
	input[type=text], input[type=number], input[type=date]{
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

<form action="addCarteImobil.php" method="post" onsubmit="return validateForm()" style="width: 30%; margin: 0 auto;">
	<div class="container">
		<label for="numeField"><h3>Nume : </h3></label>
		<input type="text" placeholder="Introduceti numele" id="numeField" name="numeField" maxlength="60">
		
		<label for="prenumeField"><h3>Prenume : </h3></label>
		<input type="text" placeholder="Introduceti prenume" id="prenumeField" name="prenumeField" maxlength="60">
		
		<label for="seriaField"><h3>Seria : </h3></label>
		<input type="text" placeholder="Introduceti seria" id="seriaField" name="seriaField" maxlength="2">
		
		<label for="nrField"><h3>Nr : </h3></label>
		<input type="number" placeholder="Introduceti numarul" id="nrField" name="nrField" min="0" max="1000000000">	

		<label for="dataMutareField"><h3>Data Mutare In Imobil : </h3></label>
		<input type="date" value="2023-01-01" placeholder="Introduceti data de mutare in imobil" id="dataMutareField" name="dataMutareField">		
		
		<label for="tipAdresaField"><h3>Tip Adresa (1 pentru Domiciliu, 2 pentru Resedinta) : </h3></label>
		<input type="number" placeholder="Introduceti tipul adresei" id="tipAdresaField" name="tipAdresaField" min="1" max="2">		
		
		<label for="idScaraField"><h3>Id Scara (foloseste Search Tools sa gasesti id-ul potrivit) : </h3></label>
		<input type="number" placeholder="Introduceti id scara" id="idScaraField" name="idScaraField" min="1">
		
		<label for="idApartamentField"><h3>Id Apartament (1 to 40) : </h3></label>
		<input type="number" placeholder="Introduceti id apartament" id="idApartamentField" name="idApartamentField" min="1" max="40">		
		
		<label for="isMemberAsociatieField"><h3>Este membru asociatie (0 sau 1) : </h3></label>
		<input type="number" placeholder="Introduceti bool membru asociatie" id="isMemberAsociatieField" name="isMemberAsociatieField" min="0" max="1">	

		<label for="idPersoanaField"><h3>Id Persoana (1 pt proprietar,2 pt locatar sau 3 pt copil) : </h3></label>
		<input type="number" placeholder="Introduceti id persoana" id="idPersoanaField" name="idPersoanaField" min="1" max="3">		

		<label for="idAsociatieField"><h3>Id Asociatie (foloseste Search Tools sa gasesti id-ul potrivit) : </h3></label>
		<input type="number" placeholder="Introduceti id asociatie" id="idAsociatieField" name="idAsociatieField" min="1">	
		
		<label for="idUserField"><h3>Id User (preia id user conform id asociat cererii): </h3></label>
		<input type="number" placeholder="Introduceti id user" id="idUserField" name="idUserField" min="1">	
		
		<input type="reset" value="Resetare formular"></input>
		<input type="submit" value="Adauga Carte Imobil"></input>
	</div>
</form><br>

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


</body>
</html>