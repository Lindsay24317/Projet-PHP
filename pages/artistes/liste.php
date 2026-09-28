<?php

// Je récupere la liste des artistes présent au festival

$sql = "SELECT Id_Artiste, nom, photo 
        FROM Artiste
        ORDER BY nom";
        
$artistes = $pdo->query($sql)->fetchAll();

?>

<h1>Liste des artistes</h1>

<p><?=  count($artistes) ?> Artistes</p>

<?php if (isset($_SESSION['user']['role']) &&  $_SESSION['user']['role'] === 'admin'): ?>

    <!-- Lien qui permet a l'admin de créer un artiste -->
    <a href="index.php?page=artiste-create" class="btn">
        Créer un artiste
    </a>

<?php endif; ?>


<div class="cards">

<?php foreach ($artistes as $artiste) : ?>

    <article class="card">
        
    <h2><?= htmlspecialchars($artiste["nom"]) ?></h2>
    <img src="images/<?= htmlspecialchars($artiste['photo']) ?>" alt="<?= htmlspecialchars($artiste['nom']) ?>">
    <div class="actions">
        <a href="index.php?page=artiste-details&amp;id=<?= $artiste['Id_Artiste'] ?>" class="btn">Détails</a>

        <!-- Lien qui permet de modifier et supprimer des artistes -->
        <?php if (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'admin'): ?>

            <a href="index.php?page=artiste-edit&amp;id=<?= $artiste['Id_Artiste'] ?>" class="btn">
                Modifier
            </a>
            
            <form method="post" action="index.php?page=artiste-delete" onsubmit="return confirm('Voulez-vous supprimer <?=  $artiste['nom'] ?> ?')">
                <input type="hidden" name="id" value="<?= $artiste['Id_Artiste'] ?>">
                <button class="btn">Supprimer</button>
            </form>
        
        <?php endif; ?>
    </div>
    </article>

    <?php endforeach ?>
</div>