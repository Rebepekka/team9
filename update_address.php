<?php
session_start(); // Aloita istunto
$initials=parse_ini_file("./ht.settings.ini");
// Tarkista, onko käyttäjä kirjautunut sisään
if(!isset($_SESSION['loggedin'])) {
    echo "Kirjaudu sisään päivittääksesi osoitetietosi.";
    exit;
}
// Muodosta yhteys tietokantaan
// $mysqli = new mysqli('localhost', 'trtkp23_9', 'VPnXTtqa', 'web_trtkp23_9');
$mysqli = new mysqli($initials["host"], $initials["user"], $initials["pass"], $initials["name"]);
// Tarkistaa, onnistuiko yhteyden muodostaminen
if ($mysqli->connect_error) {
    die('Connect Error (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

// Suojaa käyttäjän syöttämät tiedot SQL-injektioita vastaan
$username = $mysqli->real_escape_string($_POST['username']); 
$email = $mysqli->real_escape_string($_POST['email']);

// Päivittää tiedot tietokantaan
$sql = "UPDATE accounts SET username='$username', email='$email' WHERE username='" . $_SESSION['name'] . "'";

if ($mysqli->query($sql) === TRUE) {
    header('Location: profile.php'); // Ohjaa käyttäjä takaisin profiilisivulle
    echo "Tiedot päivitetty onnistuneesti!";
    $_SESSION['name'] = $username;
} else {
    echo "Virhe: " . $sql . "<br>" . $mysqli->error;
}
}

$mysqli->close();
?>

