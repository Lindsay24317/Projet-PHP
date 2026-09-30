<?php

$errors = [];
$values = ['nom' => '',
           'prenom' => '',
           'email' => ''];

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $values['nom'] = trim($_POST['nom'] ?? '');
    $values['prenom'] = trim($_POST['prenom'] ?? '');
    $values['email'] = trim($_POST['email'] ?? '');
    $password = trim($_POST["password"] ?? '');
    $confirmation = trim($_POST["confirmation"] ?? '');

    if($values['nom'] === ''){
        $errors['nom'] = "Le nom est obligatoire."; 
    }

    if($values['prenom'] === ''){
        $errors['prenom'] = "Le prenom est obligatoire."; 
    }

    if($values['email'] === ''){
        $errors['email'] = "L'email est obligatoire.";
    }

    else if (!filter_var($values['email'], FILTER_VALIDATE_EMAIL)){
        $errors['email'] = "Le format de l'email est incorrect.";
    }

    else if (strlen($values['email']) > 180){
        $errors['email'] = "L'email ne peut pas excéder 180 caractères.";
    }

    if ($password === ''){
        $errors['password'] ="Le mot de passe est obligatoire.";
    }

    else if (strlen($password) < 8){
        $errors['password'] = "Le mot de passe doit avoir minimum 8 caractères.";
    }

    if($confirmation === ''){
        $errors['confirmation'] = "La confirmation du mot de passe est obligatoire.";
    }

    else if($password !== $confirmation){
        $errors['confirmation'] = "Le mot de passe ne correspond pas.";
    }


    // Enregistrement du nouvel utilisateur dans la DB

    if (!$errors){

        try{

            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO User_ (nom, prenom, email, mot_de_passe)
            VALUES (?, ?, ?, ?)";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([$values['nom'],
                            $values['prenom'],
                            $values['email'], 
                            $password_hash]);

            $_SESSION['user'] = [
                'id' => $pdo->lastInsertId(),
                'email' => $values['email'],
                'nom' => $values['nom'],
                'prenom' => $values['prenom'],
            ];

            header('Location: index.php');
            exit();
        } catch (PDOException $e){
            $errors['email'] = "L'email existe déjà.";
        }
    }

}
?>

<h1>S'inscrire</h1>

<form method="post">
    <div>
        <label for="nom">Nom</label>
        <input type="nom" name="nom" id="nom" value="<?= $values['nom'] ?>">
        <?php if(isset($errors['nom'])) : ?>
            <span class="error"><?= $errors['nom'] ?></span>
        <?php endif ?>
    </div>

    <div>
        <label for="prenom">Prenom</label>
        <input type="prenom" name="prenom" id="prenom" value="<?= $values['prenom'] ?>">
        <?php if(isset($errors['prenom'])) : ?>
            <span class="error"><?= $errors['prenom'] ?></span>
        <?php endif ?>
    </div> 

    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="<?= $values['email'] ?>">
        <?php if(isset($errors['email'])) : ?>
            <span class="error"><?= $errors['email'] ?></span>
        <?php endif ?>
    </div>

    <div>
        <label for="password">Mot de passe</label>
        <input type="password" name="password" id="password">
        <?php if(isset($errors['password'])) : ?>
            <span class="error"><?= $errors['password'] ?></span>
        <?php endif ?>
    </div>

    <div>
        <label for="confirmation">Confirmation</label>
        <input type="password" name="confirmation" id="confirmation">
        <?php if(isset($errors['confirmation'])) : ?>
            <span class="error"><?= $errors['confirmation'] ?></span>
        <?php endif ?>
    </div>

    <button>S'inscrire</button>

</form>

<p>Déjà inscrit ? <a href="index.php?page=login">Connecte toi !</a></p>