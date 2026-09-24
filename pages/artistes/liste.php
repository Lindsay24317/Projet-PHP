<?php

// Je récupere la liste des artistes présent au festival

$sql = "SELECT Id_Artiste, nom 
        FROM Artiste
        ORDER BY nom";
        
$artistes = $pdo->query($sql)->fetchAll();
?>

<h1>Liste des artistes</h1>

<p><?=  count($artistes) ?> Artistes</p>

<div class="cards">

<?php foreach ($artistes as $artiste) : ?>

    <article class="card">

    <h2><?= $artiste["nom"] ?></h2>
    <div class="actions">
        <a href="index.php?page=artiste-details&amp;id=<?= $artiste['Id_Artiste'] ?>" class="btn">Détails</a>
    
    </div>
    </article>

    <?php endforeach ?>
</div>