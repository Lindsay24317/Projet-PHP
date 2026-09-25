<?php

session_start();

//Je met d'abord en place les routes

$routes = [

    '' => [
        'file' => 'pages/home.php',
        'title' => 'Accueil',
        'auth' => false

    ],

    // Gestion des artistes

    'artistes' => [
        'file' => 'pages/artistes/liste.php',
        'title' => 'Line-up',
        'auth' => false
    ],

    'artiste-details' => [
        'file' => 'pages/artistes/details.php',
        'title' => 'Description de l\'artiste',
        'auth' => false
    ],
    
    'artiste-create' => [
        'file' => 'pages/artistes/create.php',
        'title' => 'Création d\'un artiste',
        'roles' => ['admin'],
    ],

    'artiste-delete' => [
        'file' => 'pages/artistes/delete.php',
        'title' => 'Suppression d\'un artiste',
        'roles' => ['admin'],
    ],

    'artiste-edit' => [
        'file' => 'pages/artistes/edit.php',
        'title' => 'Modification d\'un artiste',
        'roles' => ['admin'],
    ],

    // Réservation

    'reservation' => [
        'file' => 'pages/billet/reserve.php',
        'title' => 'Faire réservation',
        'auth' => false
    ],

    'profil' => [
        'file' => 'pages/billet/profil.php',
        'title' => 'Profil',
        'auth' => true 
    ],

    // Gestion de la connexion

    'register' => [
        'file' => 'pages/connect/register.php',
        'title' => 'S\'enregister',
    ],

    'login' => [
        'file' => 'pages/connect/login.php',
        'title' => 'Se connecter',
    ],

    'logout' => [
        'file' => 'pages/connect/logout.php',
        'title' => 'Se déconnecter',
    ],

];
$page = $_GET['page'] ?? '';
$route = $routes[$page] ?? null;

if ($route === null) {
  $route = [
    'file' => 'pages/errors/not-found.php',
    'title' => "404 not found",
    'auth' => false
  ];
}

$requiredRoles = $route['roles'] ?? null;
if($requiredRoles !== null){
    if(!isset($_SESSION['user'])){
        header("Location: index.php?page=login");
        exit;
    }

    if(!in_array($_SESSION['user']['role'], $requiredRoles)){
        $route = [
            'file' => 'pages/errors/forbidden.php',
            'title' => "403 forbidden"
        ];
    }
}
$file = $route["file"];
$title = $route["title"];

 require_once 'config/database.php';

ob_start();

require_once $file;
$content = ob_get_clean();

require_once 'partials/header.php';
echo $content;
require_once 'partials/footer.php';


?>