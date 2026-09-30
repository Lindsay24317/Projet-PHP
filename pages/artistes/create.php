<?php
// Les seules dates auxquelles les artistes peuvent performer
$datesFestival = [
    '2027-07-10',
    '2027-07-11',
    '2027-07-12'
];
// D'abord je demande à ma base de données l'identifiant et le nom de chaque artistes
// Ensuite, je prépare les valeurs du formulaire.
$query = "SELECT Id_Artiste, nom FROM Artiste ORDER BY nom";
$artistes = $pdo->query($query)->fetchAll();


$values = [
    'nom' => '',
    'genre_musical' => '',
    'description' => '',
    'setlist' => '',
    'photo' => '',
    'date_debut' => '',
];

$errors = [];

// Gérer le formulaire et stock les erreurs de validation

if ($_SERVER['REQUEST_METHOD'] === 'POST'){

    foreach (array_keys($_POST) as $field){
        $values[$field] = trim($_POST[$field]) ?? '';
    }

    if ($values['nom'] === ''){
        $errors["nom"] = "Le nom est obligatoire";
    }
    else if (strlen($values['nom']) > 50){
        $errors["nom"] = "Le nom ne peut pas dépasser 50 caractères.";
    }
    
    if ($values['genre_musical'] === ''){
        $errors["genre_musical"] = "Le style de musique est obligatoire";
    }
    else if (strlen($values['genre_musical']) > 50){
        $errors["genre_musical"] = "Le genre_musical ne peut pas dépasser 50 caractères.";
    }

    if ($values['description'] === ''){
        $errors["description"] = "La description est obligatoire";
    }
    else if (strlen($values['description']) > 2000){
        $errors["description"] = "La description ne peut pas dépasser 2000 caractères.";
    }

    if ($values['setlist'] === ''){
        $errors["setlist"] = "La setlist est obligatoire";
    }
    else if (strlen($values['setlist']) > 2000){
        $errors["setlist"] = "La setlist ne peut pas dépasser 2000 caractères.";
    }

    if ($values['date_debut'] === ''){
        $errors["date_debut"] = "La date de représentation est obligatoire";
    }

    if(!isset($_FILES['photo']) || $_FILES['photo']['error'] !==UPLOAD_ERR_OK){
        $errors['photo'] = "La photo est obligatoire";
    }

    // On utilise un try/catch pour gérer les erreurs de base de données
    if (!$errors){
        try{

            // Récupération du nom de la photo envoyé par l'admin
            $nomPhoto = basename($_FILES['photo']['name']);

            // Met la photo dans le dossier images
            move_uploaded_file($_FILES['photo']['tmp_name'],
            'images/' . $nomPhoto
        );

            $sql = "INSERT INTO Artiste (nom, genre_musical, description, setlist, photo)
            VALUES (?, ?, ?, ?, ?)";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                $values['nom'],
                $values['genre_musical'],
                $values['description'],
                $values['setlist'],
                $nomPhoto
            ]);

            $Id_Artiste = $pdo->lastInsertId();

            $sql = "INSERT INTO Representation (date_debut)
            VALUES (?)";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                $values['date_debut']
            ]);

            $Id_representation = $pdo->lastInsertId();

            $sql = "INSERT INTO Participe (Id_Artiste, Id_representation)
            VALUES (?, ?)";

            $stmt = $pdo->prepare($sql);

            $stmt->execute([
                $Id_Artiste,
                $Id_representation
            ]);

        }
        catch(PDOException $e){
            $errors['database'] = "Une erreur est survenue lors de l'enregistrement";
        }
    }

}

?>

<h1>Ajouter un artiste</h1>

<form method="post" enctype="multipart/form-data">
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
        <label for="photo">Ajouter une photo</label>
        <input type="file" name="photo" id="photo" required>
     </div>
        
    <div>
        <label for="date_debut">Date de passage de l'artiste: </label>
        <select name="date_debut" id="date_debut" required>

           <option value="">-- Choisir une date --</option>
           <option value="2027-07-10">10 juillet 2027</option>
           <option value="2027-07-11">11 juillet 2027</option>
           <option value="2027-07-12">12 juillet 2027</option>

        </select>
    </div>

    <button>Ajouter</button>


    
</form>