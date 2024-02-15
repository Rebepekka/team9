<?php
session_start();
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'trtkp23_9';
$DATABASE_PASS = 'VPnXTtqa';
$DATABASE_NAME = 'web_trtkp23_9';
// Muodostetaan yhteys tietokantaan, jos yhteyttä ei ole näyrrää error
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Käyttäjien hakeminen tietokannasta
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

// Onko käyttäjä ylläpitäjä 
function isAdmin() {
    global $con;

    if (!isset($_SESSION['username'])) {
        return false; 
    } else { 
        // Onko käyttäjä ylläpitäjä? 
        $user_name = $_SESSION['username'];
        $sql = "SELECT is_admin FROM users WHERE username = ?";
        $stmt = $con->prepare($sql);

        // Sido parametrit ja suori se
        $stmt->bind_param("s", $user_name);
        $stmt->execute();
        $stmt->bind_result($is_admin);

        // Hakee lopputuloksen 
        $stmt->fetch();

        return $is_admin == 1;
    }
}

// Katsotaan onko käyttäjä kirjautunut sisään 
if (isset($_SESSION['username'])) {
    echo "Welcome " . $_SESSION['username'];
    if (isAdmin()) {
    echo " (Administrator)"; 
    }
}
?>