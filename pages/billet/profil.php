<?php

if (!isset($_SESSION['user'])) {
    header('Location: index.php?page=login');
    exit;
}
// Récupération de l'id et de l'email de l'utilisateur
$idUser = $_SESSION['user']['id'];

$sql = "SELECT email
        FROM User_
        WHERE Id_User = ?";

$stmt = $pdo->prepare($sql);
$stmt->execute([$idUser]);

$user = $stmt->fetch(PDO::FETCH_ASSOC);

//Récupération du bitte de l'utilisateur 
$sql = "SELECT type_billet, prix, quantite, date_reservation, date_jour
        FROM Reservation
        WHERE Id_User = ?";

$stmt = $pdo->prepare($sql);
$stmt->execute([$idUser]);

$billets = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<h1>Mon profil</h1>

<h2>Mes informations</h2>

<p>Email : <?= htmlspecialchars($user['email']) ?></p>

<h2>Mes billets</h2>

<!-- Vérification de si l'utilisateur possède des billets -->
<?php if (!$billets): ?>

    <p>Tu n'as pas encore de billet.</p>

<?php else: ?>

    <?php foreach ($billets as $billet): ?>
    
        <div class="card-billet">
    
            <h3><?= htmlspecialchars($billet['type_billet']) ?></h3>
    
            <p>Prix : <?= htmlspecialchars($billet['prix']) ?> €</p>
    
            <p>Quantité : <?= htmlspecialchars($billet['quantite']) ?></p>
    
            <p>Jour du festival :
                <?= htmlspecialchars($billet['date_jour']) ?>
            </p>
            
            <p>Date de réservation :
                <?= htmlspecialchars($billet['date_reservation']) ?>
            </p>
        </div>
    
    <?php endforeach; ?>

<?php endif; ?>