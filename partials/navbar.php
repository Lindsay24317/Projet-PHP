<nav class="navbar">
    <h1>NOVA Festival</h1>
    <ul>
        <li><a href="index.php">Accueil</a></li>
        
        <li><a href="index.php?page=artistes">Line-up</a></li>
        <?php if (isset($_SESSION['user']) && $_SESSION['user'] === 'admin') : ?>
            <li><a href="index.php?page=artiste-create">Création d'un artiste</a></li>
        <?php endif ?>
        <li><a href="index.php?page=reservation">Billet</a></li>
            
        <?php if (!isset($_SESSION['user'])) : ?>
          <li><a href="index.php?page=login">Se connecter</a></li>
          <li><a href="index.php?page=register">S'inscrire</a></li>
        <?php else : ?>
          <li>Connecté en tant que : <?= $_SESSION['user']['email'] ?></li>
          <li><a href="index.php?page=profil">Profil</a></li>
          <li><a href="index.php?page=logout">Se déconnecter</a></li>
        <?php endif ?>
    </ul>
</nav>