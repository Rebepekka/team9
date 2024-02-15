<?php
session_start();
$initials=parse_ini_file("./.ht.settings.ini");
// Muodostetaan yhteys.
$con=mysqli_connect($initials["host"], $initials["user"], $initials["pass"], $initials["name"]);
if ( mysqli_connect_errno() ) {
    // Jos yhteydessä on virhe, pysäytä komentosarja ja näytä virhe.   
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// Tarkistetaan, onko kirjautumislomakkeen tiedot lähetetty, isset () tarkistaa, ovatko tiedot olemassa.
if ( !isset($_POST['username'], $_POST['password']) ) {
    // Jos ei saa lähetettyjä tietoja...
    exit('Please fill both the username and password fields!');
}
// Valmistele SQL, SQL-lauseen valmistelu estää SQL-injektion.
if ($stmt = $con->prepare('SELECT id, password FROM accounts WHERE username = ?')) {
    // Sidotaan parametrit (s, i, jne.). Käytetään s, koska käyttäjätunnus on merkkijono.
    $stmt->bind_param('s', $_POST['username']);
	$stmt->execute();
    // Tallennetaan tulos, jotta voidaan tarkistaa, onko tili tietokannassa.
    $stmt->store_result();
}
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $password);
        $stmt->fetch();
        // Tili on olemassa. Tarkistaan salasana.
        if (password_verify($_POST['password'], $password)) {
        // Luodaan sessioita, jotta tiedetään, että käyttäjä on kirjautunut sisään.
        session_regenerate_id();
        $_SESSION['loggedin'] = TRUE;
        $_SESSION['name'] = $_POST['username'];
        $_SESSION['id'] = $id;    
        // Kirjautunut käyttäjä ohjataan sivulle home.php.
        header('Location: home.php');
    } else {
        // Väärä salasana...
        echo 'Incorrect username and/or password!';
        echo "<a href='./login.html'> Get back</a>";
    }
} else {
    // Väärä käyttäjänimi...
    echo 'Incorrect username and/or password!';
    echo "<a href='./login.html'> Get back</a>";    
    
    $stmt->close();
}
?>         