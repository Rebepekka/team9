<?php
// Aloitetaan sessio
session_start();
// Muodostetaan yhteys.
include ("./connect.php"); // Linkki: luodaan yhteys.
// Tarkistetaan onko tiedot lähetetty, isset () -toiminto tarkistaa, onko tiedot olemassa.
if (!isset($_POST['username'], $_POST['password'], $_POST['email'])) {
    // Jos ei saa lähetettyjä tietoja...
    print "Please complete the <a href='./register.html'>registration</a> form!";
    // exit('Please complete the registration form!'); 
    exit();
}
// Varmistetaan, että lähetetyt rekisteröintiarvot eivät ole tyhjiä.
if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
    // Yksi tai useampi arvo on tyhjä...
    print "Please complete the <a href='./register.html'>registration</a> form!";
    // exit('Please complete the registration form');
    exit();
}
// Varmistetaan, että kaapattu syöttöarvo on sähköpostiosoite.
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
	exit('Email is not valid!');
}
// Hyväksytään vain kirjaimet ja numerot.
if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['username']) == 0) {
    exit('Username is not valid!');
}
// Salasanan tulee olla 5–20 merkkiä pitkä.
if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
	print "Password must be between 5 and 20 characters long! <a href='./register.html'> Get back</a>";
	exit();
}
// Tarkistetaan, onko käyttäjänimellä varustettu tili jo olemassa.
if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
    // Sidotaan parametrit (s, i, jne.).
    $stmt->bind_param('s', $_POST['username']);
	$stmt->execute(); // Viedään tieto tietokantaan.
	$stmt->store_result();
    // Tallenna tulos (store_result), jotta voimme tarkistaa, onko tili tietokannassa.
    if ($stmt->num_rows > 0) {
        // Jos tili on jo olemassa...
        print "Username exists, please choose <a href='./register.html'>another</a>!";
	} else {
    // Käyttäjätunnusta ei ole, lisää uusi tili.
    if ($stmt = $con->prepare('INSERT INTO accounts (username, password, email) VALUES (?, ?, ?)')) {  
    // Ei paljasteta salasanoja tietokannassa: hajautetaan salasana (password_hash), salataan (PASSWORD_DEFAULT) ja tallennetaan $password:iin.
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    // Sidotaan arvot parametreihin ja lisätään $stmt->execute(); tietokantaan
    $stmt->bind_param('sss', $_POST['username'], $password, $_POST['email']);  
    $stmt->execute();
    // Siirrytään vielä kirjautumaan sisälle
    header('Location: login2.html');
    exit();
} else {
    // SQL-lauseessa on jotain vikaa. On tarkistettava, että tilitaulukossa on kaikki kolme kenttää.
    echo 'Could not prepare statement!';
}
    }
    $stmt->close();
} else {  
    // SQL-lauseessa on jotain vikaa. On tarkistettava, että tilitaulukossa on kaikki kolme kenttää.
    echo 'Could not prepare statement!';
}
$con->close();
?>
