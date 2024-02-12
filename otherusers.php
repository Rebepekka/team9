<?php
session_start();
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
