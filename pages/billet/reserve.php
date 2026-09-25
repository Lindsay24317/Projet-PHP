<?php

$values = [
    'nom' => '',
    'email' => '',
    'date_jour' => '',
    'quantité' => ''
];

$errors = [];

?>

<h1>Réserve ta place</h1>

<form method="post">
<div class="billets">

<div class="card-billet">
    <h2>1 JOUR</h2>
    <p>Accès au festival pour une journée.</p>
    <p class="prix">40€</p>
    <button type="submit" name="billet" value="">Choisir</button>
</div>

<div class="card-billet">
    <h2>2 JOURS</h2>
    <p>Accès au festival pour deux journées.</p>
    <p class="prix">80€</p>
    <button type="submit" name="billet" value="">Choisir</button>
</div>

<div class="card-billet">
    <h2>PASS</h2>
    <p>Accès au festival tout les jours.</p>
    <p class="prix">100€</p>
    <button type="submit" name="billet" value="">Choisir</button>
</div>

</div>
</form>