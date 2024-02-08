<?php
$DATABASE_HOST = 'shell';
$DATABASE_USER = 'trtkp23_9';
$DATABASE_PASS = 'VPnXTtqa';
$DATABASE_NAME = 'web_trtkp23_9';
// Muodostetaan yhteys.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) { // Jos yhteydessä on virhe, pysäytä komentosarja ja näytä virhe.
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// Tarkistetaan onko tiedot lähetetty, isset () -toiminto tarkistaa, onko tiedot olemassa.
if (!isset($_POST['username'], $_POST['password'], $_POST['email'])) {
// Jos ei saa lähetettyjä tietoja...
exit('Please complete the registration form!');
}
// Varmistetaan, että lähetetyt rekisteröintiarvot eivät ole tyhjiä.
if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email'])) {
    // Yksi tai useampi arvo on tyhjä...
    exit('Please complete the registration form');
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
	exit('Password must be between 5 and 20 characters long!');
}
// Tarkistetaan, onko käyttäjänimellä varustettu tili jo olemassa.
if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
    // Sidotaan parametrit (s, i, jne.), Hajautetaan salasana PHP password_hash -toiminnolla.
    $stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
	$stmt->store_result();
    // Tallenna tulos (store_result), jotta voimme tarkistaa, onko tili tietokannassa.
    if ($stmt->num_rows > 0) {
        // Jos tili on jo olemassa...
        echo 'Username exists, please choose another!';
	} else {
    // Käyttäjätunnusta ei ole, lisää uusi tili.
    if ($stmt = $con->prepare('INSERT INTO accounts (username, password, email, activation_code) VALUES (?, ?, ?, ?)')) {   
    // Ei paljasteta salasanoja tietokannassa: hajautetaan salasana ja käytetään password_verify, kun käyttäjä kirjautuu sisään.
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    // $uniqud muuttuja luo yksilöllisen tunnuksen, jota käytetään aktivointikoodissa (se lähetetään käyttäjän sähköpostiosoitteeseen).
    $uniqid = uniqid();
    $stmt->bind_param('ssss', $_POST['username'], $password, $_POST['email'], $uniqid);
    
    $stmt->execute();
    // Tilin rekisteröinnin yhteydessä käyttäjän on aktivoitava tilinsä käyttämällä aktivointilinkkiä, joka lähetetään hänen sähköpostiosoitteeseensa. $from- ja $activate_link-muuttujiin omat muuttujat!
    $from    = 'noreply@yourdomain.com'; // Tähän pitää päivittää oma!!
    $subject = 'Account Activation Required';
    $headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
        
    $activate_link = 'http://yourdomain.com/phplogin/activate.php?email=' . $_POST['email'] . '&code=' . $uniqid; // $activate_link = '' pitää päivittää!!
    $message = '<p>Please click the following link to activate your account: <a href="' . $activate_link . '">' . $activate_link . '</a></p>';
    mail($_POST['email'], $subject, $message, $headers);
    echo 'Please check your email to activate your account!';
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
<!-- Linkki, joka vie takaisin kirjautumissivulle (login.html). -->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
    <div><a href="login.html"><i class="fas fa-sign-out-alt"></i>Kirjautumissivulle</a></div>
</body>
</html>