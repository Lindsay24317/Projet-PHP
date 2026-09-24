<?php

$errors = [];
$values = ['email' => ''];

if($_SERVER['REQUEST_METHOD'] === 'POST'){

    $values['email'] = trim($_POST['email'] ?? '');
    $password = trim($_POST["password"] ?? '');
    $confirmation = trim($_POST["confirmation"] ?? '');

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


    // Enregistrement DB

    if (!$errors){

        try{

            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO User_ (email, mot_de_passe)
            VALUES (?, ?)";

            $stmt = $pdo->prepare($sql);
            $stmt->execute([$values['email'], $password_hash]);

            $_SESSION['user'] = [
                'id' => $pdo->lastInsertId(),
                'email' => $values['email'],
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