<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'trtkp23_9';
$DATABASE_PASS = 'VPnXTtqa';
$DATABASE_NAME = 'web_trtkp23_9 ';
// Muodostetaan yhteys
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
    // Jos yhteydessä on virhe, pysäytä komentosarja ja näytä virhe.
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// Tarkistetaan, onko sähköposti ja koodi olemassa
if (isset($_GET['email'], $_GET['code'])) {
	if ($stmt = $con->prepare('SELECT * FROM accounts WHERE email = ? AND activation_code = ?')) {
		$stmt->bind_param('ss', $_GET['email'], $_GET['code']);
		$stmt->execute();
        // Tallennetaan tulos (store_result), jotta voimme tarkistaa, onko tili tietokannassa.
		$stmt->store_result();
		if ($stmt->num_rows > 0) {
            // Tili on olemassa pyydetyllä sähköpostiosoitteella ja koodilla.
            if ($stmt = $con->prepare('UPDATE accounts SET activation_code = ? WHERE email = ? AND activation_code = ?')) {
                // Aseta uudeksi aktivointikoodiksi "activated", näin voimme tarkistaa, onko käyttäjä aktivoinut tilinsä.
                $newcode = 'activated';
				$stmt->bind_param('sss', $newcode, $_GET['email'], $_GET['code']);
				$stmt->execute();
				echo 'Your account is now activated! You can now <a href="membership1.html">login</a>!';
			}
		} else {
			echo 'The account is already activated or doesn\'t exist!';
		}
	}
}  
?>    