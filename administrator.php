<?php
// Aloitetaan sessio
session_start();
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'trtkp23_9';
$DATABASE_PASS = 'VPnXTtqa';
$DATABASE_NAME = 'web_trtkp23_9';
// Muodostetaan yhteys tietokantaan, jos yhteyttä ei ole näyttää error
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Käyttäjien hakeminen tietokannasta, users hakee tietokannasta tiedot kohdasta "users"
function getAllUsers() {
    global $con;

    $users = array();

    // Query, tietokannassa tietojen saamiseksi 
    $query = "SELECT id, username, email FROM users";
    $result = mysqli_query($con, $query);

    // Toimiko?
    if ($result) {
        // JOkaiselta riviltä 
        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }
    }
    return $users;
}

// Onko sisäänkirjautunut käyttäjä ylläpitäjä 
function isAdmin() {
    global $con;

    if (!isset($_SESSION['username'])) {
        return false; 
    } else 
        { 
            $user_name = $_SESSION['username'];
            $sql = "SELECT is_admin FROM users WHERE username = ?";
            $stmt = $con->prepare($sql);

            // Hakee dataa SQLlästä -> php koodiin
             $stmt->bind_param("s", $user_name);
             $stmt->execute();
             $stmt->bind_result($is_admin);

             // Hakee lopputuloksen -> true/false
            $stmt->fetch();

            return $is_admin == 1;
        }
}

// Tarkoitus siis että, katsotaan onko käyttäjä kirjautunut sisään pääkäyttäjällä ja jos on, näytöllä teksti tervetuloa
if (isset($_SESSION['username'])) {
    echo "Welcome Administrator " . $_SESSION['username'];
    if (isAdmin()) {
    echo " (Administrator)"; 
    }
}
?>