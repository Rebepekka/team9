<?php
mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

// Salasanat ym. laitetaan eri tiedostoon. ht.-alkuisia tiedostoja "ei näy".
$initials=parse_ini_file("./.ht.settings.ini");

try{
    $con=mysqli_connect($initials["host"], $initials["user"], $initials["pass"], $initials["name"]);
}
catch(Exception $e){
    header("Location:./error.html");
    exit;
}
?>