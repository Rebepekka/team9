<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="css/otherusersstyle.css" rel="stylesheet" type="text/css" />
	<title>Bodybuilders | Other users</title>
</head>
<body>
	<header style="text-align: left; padding-left: 10px; pagging-top: 10px;">
		<a href="profile.php" style="font-size: 19px; filter: brightness(85%); color: gold;">BACK</a>
	</header>

	<div class="text">
		<h1>USERS</h1>
	</div>

	<div class="users">

<?php
session_start();
// Muodostetaan yhteys.
include ("./connect.php"); // Linkki: luodaan yhteys.
// Tarkistetaan, onko käyttäjä kirjautunut sisään
if (!isset($_SESSION['loggedin'])) {
	exit('Please log in first!');
}

// Haetaan kaikki käyttäjät tietokannasta
if ($stmt = $con->prepare('SELECT username FROM accounts')) {
	$stmt->execute();
	$stmt->bind_result($username);
	while ($stmt->fetch()) {
		echo $username . '<br>';
	}
	$stmt->close();
} else {
	echo 'Could not prepare statement!';
}
$con->close();
?>

	</div>
</body>
</html>