<?php
// Aloitetaan sessio
session_start();
// Jos ei ole kirjautunus, ohjataan kirjautumissivulle
if (!isset($_SESSION['loggedin'])) {
	header('Location: membership.html');
	exit;
}
// $DATABASE_HOST = 'localhost';
// $DATABASE_USER = 'trtkp23_9';
// $DATABASE_PASS = 'VPnXTtqa';
// $DATABASE_NAME = 'web_trtkp23_9';
$initials=parse_ini_file("./ht.settings.ini");
// $con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
$con=mysqli_connect($initials["host"], $initials["user"], $initials["pass"], $initials["name"]);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// Haetaan käyttäjän tiedot tietokannasta.
$stmt = $con->prepare('SELECT password, email FROM accounts WHERE id = ?');
// Haetaan tiedot id:llä
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Profile Page</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
	</head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
				<h1>Website Title</h1>
                <!-- Linkit uloskirjautumiseen ja etusivulle -->
                <a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
				<a href="home.php"><i class="fas fa-sign-out-alt"></i>Etusivulle</a>
			</div>
		</nav>
		<div class="content">
			<h2>Profile Page</h2>
			<div>
				<p>Your account details are below:</p>
				<table>
					<tr>
						<td>Username:</td>
						<td><?=$_SESSION['name']?></td>
					</tr>
					<tr>
						<td>Password:</td>
						<td><?=$password?></td>
					</tr>
					<tr>
						<td>Email:</td>
						<td><?=$email?></td>
					</tr>
				</table>
				<div>
                    <!-- Päivitetään tiedot update_form.html -tiedostossa -->
				<a href="update_form.html">Päivitä tiedot</a> 
				</div>
			</div>
		</div>
	</body>
</html>