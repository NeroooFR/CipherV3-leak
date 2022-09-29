<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'eldb.php';
$con = htmlspecialchars($_POST['chat']);
/*$serv = htmlspecialchars($_GET['idserv']);*/

$stmt = $db->prepare("INSERT INTO serverchat (content, serverid, user, steamid, plyip, plyrank, who) VALUES (?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssssss", $content, $serverid, $user, $steamid, $plyip, $plyrank, $who);
$content = $con;
$serverid = '103';
$user = 'Vous';
$steamid = '0';
$plyip = '0';
$plyrank = '0';
$who = '1';
$stmt->execute();
$stmt->close();

?>