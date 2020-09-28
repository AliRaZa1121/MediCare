<?php
$conn = "mysql:host=localhost;dbname=care";
$user = "root";
$password = "";
$pdo = new PDO($conn,$user,$password);
$exec = $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
