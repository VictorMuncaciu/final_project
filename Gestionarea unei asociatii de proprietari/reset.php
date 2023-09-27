<!DOCTYPE html>
<html>
<head>
  <title>Resetare parola</title>
  
<style>

h1 {
	text-align: center;
}

.container {
  background-color: #a6a6a6;
  padding: 20px 10px;
  border-radius: 15px;
  box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.5);
}

input[type=password] {
  text-align: center;
  width: 100%;
  padding: 12px 10px;
  margin: 8px 0;
  border: 2px solid #AAF3FF;
  box-sizing: border-box;
}

input[type=submit] {
  width: 50%;
  border-radius: 5px;
  color: white;
  background-color: #7a99ff;
  cursor: pointer;
  border: none;
  padding: 15px;
  font-size: 20px;
}

.submitButton {
  text-align: center;
}

</style>  
</head>
<body bgcolor="#C5FBFF">
<?php
    // Connect to the database
    $db = new mysqli("127.0.0.1", "root", "", "my_users");

	// Check the connection
    if ($db->connect_error) {
      die("Connection failed: " . $db->connect_error);
    }

    // Get the token and email address from the query string
    $token = mysqli_real_escape_string($db, $_GET['token']);
    $email = mysqli_real_escape_string($db, $_GET['email']);

    // Look up the token and email address in the database
    $query = "SELECT * FROM users WHERE email='$email' AND passToken='$token'";
    $result = mysqli_query($db, $query);
	
	if (mysqli_num_rows($result) > 0) {
		echo "<h1>Introduceti noua dumneavoastra parola : </h1>";
		echo "<form action='update_password.php?email=$email' onsubmit='return validateForm()' method='post' style='width: 30%; margin: 0 auto;'>
			   <div class='container'>
			     <label for='psw'><b>Parola noua</b></label>
                 <input type='password' name='psw' id='psw' placeholder='Parola noua'><br>
			   
			     <label for='psw-repeat'><b>Repetati parola</b></label>
                 <input type='password' name='psw-repeat' id='psw-repeat' placeholder='Reintroduceti parola'><br>
			   
			     <div class='submitButton'>
                   <input type='submit' name='submit' value='Resetare parola'>
				 </div>
			   </div>
              </form>";
	} else {
		echo "<h1>Token sau adresa de email invalida!</h1>";
	  }
	  
	$db->close();
?>

<script>

function validateForm() {
  var password = document.getElementById("psw").value;
  var passwordRepeat = document.getElementById("psw-repeat").value;
  
  if (password == "") {
    alert("Va rugam sa introduceti o parola!");
    return false;
  }
  
  // Password must be at least 8 characters long
  if (password.length < 8) {
	alert("Va rugam sa introduceti o parola care are cel putin 8 caractere!");
    return false;
  }
  
    // Password must contain at least one number
  if (!/\d/.test(password)) {
	alert("Parola nu este destul de puternica. Va rugam sa introduceti o parola care contine cel putin un numar!");
    return false;
  }

  // Password must contain at least one uppercase letter
  if (!/[A-Z]/.test(password)) {
	alert("Parola nu este destul de puternica. Va rugam introduceti o parola care contine cel putin un caracter de tipar!");
    return false;
  }

  // Password must contain at least one lowercase letter
  if (!/[a-z]/.test(password)) {
	alert("Parola nu este destul de puternica. Va rugam sa introduceti o parola care contine cel putin o litera mica!");
    return false;
  }

  if (password != passwordRepeat) {
	alert("Parolele nu se potrivesc.");
    return false;
  }
  
  return true;
}

</script>

</body>
</html>