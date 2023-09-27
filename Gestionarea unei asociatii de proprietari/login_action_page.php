<?php
// Connect to the database
$conn = new mysqli("127.0.0.1", "root", "", "my_users");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the email and password from the form
$email = $_POST["email"];
$password = $_POST["password"];

// Check if the email exists in the database
$query = "SELECT * FROM users WHERE email='$email'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Email exists, check the password
    $row = $result->fetch_assoc();
	$id_user = $row["id"];
    $hashed_password = $row["password"];
	$username = $row["username"];
	$is_active = $row["is_active"];
    if (password_verify($password, $hashed_password)) {
      // Check if the email has been verified
      if ($is_active == 1) {
        // Start a session and set a cookie if the "remember me" checkbox is checked
        session_start();
		$_SESSION["id_user"] = $id_user;
        $_SESSION["username"] = $username;
        $_SESSION["email"] = $email;
		if($email == 'victor_messi77@yahoo.com') {
			$_SESSION["creator_logged_in"] = "1";
		} else {
			$_SESSION["logged_in"] = "1";			
		}		
		
        if (isset($_POST["remember"])) {
			setcookie("id_user", $id_user, time() + (30 * 24 * 60 * 60), "/");
            setcookie("username", $username, time() + (30 * 24 * 60 * 60), "/");
            setcookie("email", $email, time() + (30 * 24 * 60 * 60), "/");
			if($email == 'victor_messi77@yahoo.com') {
				setcookie("creator_logged_in", "1", time() + (30 * 24 * 60 * 60), "/");
			} else {
				setcookie("logged_in", "1", time() + (30 * 24 * 60 * 60), "/");
			}			
        }
        // Redirect to the dashboard page
        header("Location: testMainPage.php");
      } else {
        // Email is not verified
        // echo "Email-ul nu a fost verificat. Va rugam sa va verificati email-ul si sa incercati din nou!";
		session_start();
		$_SESSION["emailNotVerified"] = true;
		header("Location: loginOrRegister.php");
      }
    } else {
        // Password is incorrect
        // echo "Parola incorecta!";
		session_start();
		$_SESSION["incorrectPass"] = true;
		header("Location: loginOrRegister.php");
      }
} else {
		// Email is incorrect
	    // echo "Email nu este inregistrat!";
		session_start();
		$_SESSION["incorrectEmail"] = true;
		header("Location: loginOrRegister.php");
      }

$conn->close();

?>