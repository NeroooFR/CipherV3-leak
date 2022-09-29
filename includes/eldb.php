<?php
$username = "cipherpa_root"; 
$password = "dDBhh9Feva33qvN"; 
$host = "nl1-ls7.a2hosting.com"; 
$db = "cipherpa_root";

$db = mysqli_connect($host, $username, $password, $db);
mysqli_query($db, "SET NAMES 'utf8'");
?>