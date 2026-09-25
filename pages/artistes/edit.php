<?php 
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

$query = "SELECT a.Id_Artiste, nom, genre_musical, description, setlist, r.date_debut, r.Id_representation
          FROM Artiste AS a
          JOIN Participe AS p
              ON a.Id_Artiste = p.Id_Artiste
          JOIN Representation AS r
              ON p.Id_representation = r.Id_representation
          WHERE a.Id_Artiste = ?";

$stmt = $pdo->prepare($query);
$stmt->execute([$id]);

$artiste = $stmt->fetch();

if(!$artiste){
    header("Location: index.php?page=artistes");
    exit;
}

$values = [
    'nom' => $artiste['nom'],
    'genre_musical' => $artiste['genre_musical'],
    'description' => $artiste['description'],
    'setlist' => $artiste['setlist'],
    'date_debut' => $artiste['date_debut'],
    'id_representation' => $artiste['Id_representation'],
];

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    foreach (array_keys($_POST) as $field){
    $values[$field] = trim($_POST[$field] ?? '');
    }

    if ($values['nom'] === ''){
        $errors['nom'] = "Le nom est obligatoire";
    }
    else if (strlen($values['nom']) > 50){
        $errors['nom'] = "Le nom ne peut pas dépasser 50 caractères.";
    }

    if ($values['genre_musical'] === ''){
        $errors['genre_musical'] = "Le genre musical est obligatoire";
    }
    else if (strlen($values['genre_musical']) > 150){
        $errors['genre_musical'] = "Le genre musical ne peut pas dépasser 150 caractères.";
    }

    if ($values['description'] === ''){
        $errors['description'] = "La description est obligatoire";
    }
    else if (strlen($values['description']) > 2000){
        $errors['description'] = "La description ne peut pas dépasser 2000 caractères.";
    }

    if ($values['setlist'] === ''){
        $errors['setlist'] = "La setlist est obligatoire";
    }
    else if (strlen($values['setlist']) > 1000){
        $errors['setlist'] = "La setlist ne peut pas dépasser 1000 caractères.";
    }

    if(!$errors) { 

        try{
            $sql = "
            UPDATE Artiste
            SET
              nom = ?,
              genre_musical = ?,
              description = ?,
              setlist = ?
            WHERE Id_Artiste = ?
            ";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                $values['nom'],
                $values['genre_musical'],
                $values['description'],
                $values['setlist'],
                $id
                
            ]);

            $sql = "
            UPDATE Representation
            SET date_debut = ?
            WHERE Id_representation = ?
            ";  

            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                $values['date_debut'],
                $values['id_representation']
            ]);

            header('Location: index.php?page=artiste-details&id=' . $id);
            exit;
        }
        catch (PDOException $e) {
            $errors['general'] = "Une erreur est survenue lors de la modification.";
    }
  }
}
?>

<h1>Modification d'un artiste</h1>

<form method="post">

    <div>
        <label for="nom">Nom de l'artiste: </label>
        <input type="text" name="nom" id="nom" required value="<?= $values['nom'] ?>">
        <?php if (isset($errors['nom'])) : ?>
            <span class="error"><?= $errors['nom'] ?></span>
        <?php endif ?>
    </div>

    <div>
        <label for="genre_musical">Style musical de l'artiste: </label><br>
        <textarea class="txtarea" name="genre_musical" id="genre_musical" required><?= $values['genre_musical'] ?></textarea>
        <?php if (isset($errors['genre_musical'])) : ?>
            <span class="error"><?= $errors['genre_musical'] ?></span>
        <?php endif ?>
    </div>

    <div>
        <label for="description">Description de l'artiste: </label><br>
        <textarea class="txtarea" name="description" id="description" required><?= $values['description'] ?></textarea>
        <?php if (isset($errors['description'])) : ?>
            <span class="error"><?= $errors['description'] ?></span>
        <?php endif ?>
    </div>

    <div>
        <label for="setlist">Setlist de l'artiste: </label><br>
        <textarea class="txtarea" name="setlist" id="setlist" required><?= $values['setlist'] ?></textarea>
        <?php if (isset($errors['setlist'])) : ?>
            <span class="error"><?= $errors['setlist'] ?></span>
        <?php endif ?>
    </div>

    <div>
        <label for="date_debut">Date de passage de l'artiste: </label>
        <input type="date" name="date_debut" id="date_debut" required value="<?= $values['date_debut'] ?>">
        <?php if (isset($errors['date_debut'])) : ?>
            <span class="error"><?= $errors['date_debut'] ?></span>
        <?php endif ?>
    </div>

    <button>Modifier</button>


</form>