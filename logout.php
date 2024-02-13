<?php
session_start();
session_destroy();
// Ohjataan kirjautumissivulle
header('Location: mainpage.html');
?>