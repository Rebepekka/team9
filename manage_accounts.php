<?php
session_start();

// Tarkistaa onko käyttäjä ylläpitäjä ja kirjautunut sisään
if (!isset($_SESSION['username']) || !isAdmin()) {
    header("Location: login.php");
    exit(); // Jos ei, hänet ohjataan takaisin
}

// Poista käyttäjiä
if (isset($_POST['delete_user'])) {
    if(isset($_POST['user_id'])) {
        $user_id = $_POST['user_id'];

        if(deleteUser($user_id)) {
            // Jos poisto onnistunut käyttäjä ohjataan takaisin
            header("Location: manage_accounts.php?success=1");
            exit();
        } else {
            // Jos poisto ei ole onnistunut käyttäjä ohjataan takaisin hallintasivulle
            header("Location: manage_accounts.php?error=1");
            exit();
        }
    } else {
        // Jos paramentriä ei ole asetettu käyttäjä ohjataan takasin hallintasivulle 
        header("Location: manage_accounts.php?error=1");
        exit();
    }
}

// Käyttäjätilin poistaminen mysql tietokammasta
function deleteUser($user_id) {
    global $con; // Yhteys tietokantaan
    
    // SQL
    $stmt = $con->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    
    // Suorita SQL
    if($stmt->execute()) {
        // Onnistunut käyttjätilin poisto
        return true;
    } else {
        // KEpäonnistunut käyttäjätilin poisto 
        return false;
    }
}

// Sisällyttää manage_accounts.html
include 'manage_accounts.html';
?>