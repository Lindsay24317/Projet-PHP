<?php

$query = "SELECT id, nom FROM Artistes ORDER BY nom";
$artistes = $pdo->query($query)->fetchAll();


$values = [
    'artiste-nom' => '',
    'artiste-genre_musical' => '',
    'artiste-description' => '',
    'artiste-setlist' => '',
];

$errors = [];

// Gérer le formulaire

if

?>