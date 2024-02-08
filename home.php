<?php
// Aloitetaan sessio
session_start();
// Jos käyttäjä ei ole kirjautunut sisään, ohjataan kirjautumissivulle
if (!isset($_SESSION['loggedin'])) {
	header('Location: membership1.html');
	exit;
}
?>
<!-- Kirjautumisen jälkeen käyttäjä tulee tälle sivulle -->
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
        <link href="css/homestyle.css" rel="stylesheet" type="text/css" />
		<title>Home Page</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer">
    </head>
	<body class="loggedin">
		<nav class="navtop">
			<div>
                <!-- Linkit profiilitietoihin, uloskirjautumiseen ja muiden käyttäjien selaamiseen -->
				<h1>Website Title</h1>
				<a href="profile.php"><i class="fas fa-user-circle"></i>Profile</a> 
				<a href="logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
				<a href="muutkayttajat.php"><i class="fas fa-user-circle"></i>Muut käyttäjät</a>
			</div>
		</nav>
		<div class="content">
			<h2>Home Page</h2>
			<p>Welcome back, <?=$_SESSION['name']?>!</p>
		</div>
	</body>
</html>    