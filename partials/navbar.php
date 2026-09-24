<nav>
    <ul>
        <li><a href="index.php">Accueil</a></li>

        <li>
            Gestion des Artistes

            <ul>
                <li><a href="index.php?page=artistes">Liste des artistes présent</a></li>
                <?php if (isset($_SESSION['user']) && $_SESSION['user'] === 'admin') : ?>
                    <li><a href="index.php?page=artiste-create">Création d'un artiste</a></li>
                <?php endif ?>
            </ul>
        </li>
    </ul>

    <ul>
    <?php if (!isset($_SESSION['user'])) : ?>
      <li><a href="index.php?page=login">Se connecter</a></li>
      <li><a href="index.php?page=register">S'inscrire</a></li>
    <?php else : ?>
      <li>Connecté en tant que : <?= $_SESSION['user']['email'] ?></li>
      <li><a href="index.php?page=logout">Se déconnecter</a></li>
    <?php endif ?>
    </ul>
</nav>