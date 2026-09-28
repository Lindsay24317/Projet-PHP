<?php

if (!isset($_SESSION['user'])) {
    header('Location: index.php?page=login');
    exit;
}

$billet = $_GET['billet'] ?? '';

$billets = [
    '1_jour' => [
        'nom' => '1 JOUR',
        'prix' => 40
    ],
    '2_jours' => [
        'nom' => '2 JOURS',
        'prix' => 80
    ],
    'pass' => [
        'nom' => 'PASS',
        'prix' => 100
    ]
];

if (!isset($billets[$billet])) {
    echo "<p>Billet invalide.</p>";
    exit;
}

$nomBillet = $billets[$billet]['nom'];
$prix = $billets[$billet]['prix'];

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $quantite = $_POST['quantite'] ?? 1;
    $datesChoisies = $_POST['dates'] ?? [];

    $idUser = $_SESSION['user']['id'];
    $idRepresentation = 1;
    $dateReservation = date('Y-m-d');

    if ($billet === 'pass') {
        $datesChoisies = [
            '2027-07-10',
            '2027-07-11',
            '2027-07-12'
        ];
    }

    if ($billet === '1_jour' && count($datesChoisies) !== 1) {
        $error = "Tu dois choisir 1 jour.";
    }

    if ($billet === '2_jours' && count($datesChoisies) !== 2) {
        $error = "Tu dois choisir 2 jours.";
    }

    if ($error === '') {

        $sql = "INSERT INTO Reservation
                (Id_User, Id_representation, date_reservation, date_jour, quantite, type_billet, prix)
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $pdo->prepare($sql);

        foreach ($datesChoisies as $dateJour) {

            $stmt->execute([
                $idUser,
                $idRepresentation,
                $dateReservation,
                $dateJour,
                $quantite,
                $billet,
                $prix
            ]);
        }

        header('Location: index.php?page=profil');
        exit;
    }
}

?>

<h1>Ma commande</h1>

<h2><?= htmlspecialchars($nomBillet) ?></h2>

<p>Prix : <?= $prix ?> €</p>

<form method="post">

    <label for="quantite">Quantité :</label>
    <input type="number" id="quantite" name="quantite" value="1" min="1">

    <h3>Choisis ton ou tes jours :</h3>

    <?php if ($billet === '1_jour'): ?>

        <select name="dates[]" required>
            <option value="">-- Choisir un jour --</option>
            <option value="2027-07-10">10 juillet 2027</option>
            <option value="2027-07-11">11 juillet 2027</option>
            <option value="2027-07-12">12 juillet 2027</option>
        </select>

    <?php elseif ($billet === '2_jours'): ?>

        <p>Choisis 2 jours :</p>

        <input type="checkbox" name="dates[]" value="2027-07-10">
        10 juillet 2027

        <br>

        <input type="checkbox" name="dates[]" value="2027-07-11">
        11 juillet 2027

        <br>

        <input type="checkbox" name="dates[]" value="2027-07-12">
        12 juillet 2027

    <?php else: ?>

        <p>Ton PASS donne accès aux 3 jours :</p>

        <p>10 juillet 2027</p>
        <p>11 juillet 2027</p>
        <p>12 juillet 2027</p>

    <?php endif; ?>

    <button type="submit">Confirmer ma commande</button>

</form>