<?php
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

$artiste = false;

if ($id !== false && $id !== null){

    $sql = "SELECT a.Id_Artiste,
                   a.nom,
                   a.genre_musical,
                   a.description,
                   a.setlist
            FROM   Artiste AS a
            WHERE  a.Id_Artiste = ?";
    
    $request = $pdo->prepare($sql);
    $request->execute([$id]);

    $artiste = $request->fetch();
}

?>

<?php if (!$artiste) : ?>
    <?php http_response_code(404); ?>
    <h1>Artiste introuvable</h1>
    <p>Aucun artiste e correspond à l'id<?=  $id ?>.</p>

<?php else : ?>

    <h1>Prêt(e) pour <?=  htmlspecialchars($artiste["nom"]) ?></h1>

    <dl>
        <dt>STYLE DE MUSIQUE:</dt>
        <dd><?= htmlspecialchars($artiste['genre_musical']) ?></dd>
        <dt>DESCRIPTION:</dt>
        <dd><?= htmlspecialchars($artiste['description']) ?></dd>
        <dt>SETLIST:</dt>
        <dd><?= htmlspecialchars($artiste['setlist']) ?></dd>

    </dl>
<?php endif ?>