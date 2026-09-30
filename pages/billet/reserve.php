<?php

// Je crée le tableau des valeurs du formulaire
$values = [
    'nom' => '',
    'email' => '',
    'billet' => '',
    'date_jour' => '',
    'quantite' => ''
];

// Je crée un tableau vide pour les erreurs du formulaire 
$errors = [];

if (isset($_POST['billet'])) {
    $billet = $_POST['billet'];

}

?>
<!-- Création de la page de reservation de billet -->
<h1>Réserve ta place</h1>

<form action="index.php" method="get">
<div class="billets">

<div class="card-billet">
    <h2>1 JOUR</h2>
    <p>Accès au festival pour une journée.</p>
    <p class="prix">40€</p>
    <a href="?page=commande&billet=1_jour">
    <button type="button">Choisir</button>
    </a>
</div>

<div class="card-billet">
    <h2>2 JOURS</h2>
    <p>Accès au festival pour deux journées.</p>
    <p class="prix">80€</p>
    <a href="?page=commande&billet=2_jours">
    <button type="button">Choisir</button>
    </a>
</div>

<div class="card-billet">
    <h2>PASS</h2>
    <p>Accès au festival tout les jours.</p>
    <p class="prix">100€</p>
    <a href="?page=commande&billet=pass">
    <button type="button">Choisir</button>
    </a>
</div>

</div>
</form>