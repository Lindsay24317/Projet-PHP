<?php

$source = "sqlsrv";
$host = "WAD-15\IF3";
$dbname = "festival_musical";

$dsn = "$source:Server=$host;Database=$dbname;TrustServerCertificate=true";
$user = "demo_user";
$pass = "Test1234=";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
  ];

  try {
    $pdo = new PDO($dsn, $user, $pass, $options);
  } catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
  }

?>