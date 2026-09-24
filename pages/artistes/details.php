<?php
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

$artiste = false;
$representations = [];

if ($id !== false && $id !== null){
    // Récupération de l'artiste 

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

    // Récupération des représentations
    if ($artiste){ 

        $sql = "SELECT r.date_debut,
                       r.date_fin
                FROM   Participe AS p
                INNER JOIN Representation AS r
                     ON p.Id_representation = r.Id_representation
                WHERE  p.Id_Artiste = ?";
    }
    $request = $pdo->prepare($sql);
    $request->execute([$id]);

    $representations = $request->fetchAll();
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

        <dt>JOURS DE REPRESENTATION:</dt>
        <?php foreach ($representations as $representation) : ?>

            <?=  htmlspecialchars($representation['date_debut']) ?>
        <?php endforeach ?>
    </dl>
<?php endif ?>