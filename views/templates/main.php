<?php
$title = $title ?? 'Aucun Titre';
$content = $content ?? '<p>Aucun Contenu</p>';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= htmlspecialchars($title) ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/TomTroc/css/style.css">
    <link rel="icon" href="/TomTroc/assets/images/tomtroc-alt.png">
    <script src="https://kit.fontawesome.com/182cba9089.js" crossorigin="anonymous"></script>
    <script src="/TomTroc/js/scripts.js" defer></script>
</head>
<body>
<header>
    <nav>
        <div class="menu-left">
            <a href="/TomTroc/"><img class="logo" src="/TomTroc/assets/images/tomtroc.png" alt="Logo TomTroc"></a>
            <a href="/TomTroc/books">Nos livres à l'échange <i class="fa-solid fa-book"></i></a>
        </div>
        <div class="menu-right">
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="/TomTroc/conversation"><i class="fa-solid fa-comment"></i> Messagerie</a>
                <a href="/TomTroc/account"><i class="fa-solid fa-user"></i> Mon Compte</a>
                <a href="/TomTroc/user/logout"><i class="fa-solid fa-right-from-bracket"></i> Déconnexion</a>
            <?php else: ?>
                <a href="/TomTroc/user/login">Connexion</a>
                <a href="/TomTroc/user/register">Inscription</a>
            <?php endif; ?>
        </div>
    </nav>
</header>
<main>
    <?= $content ?>
</main>
<footer>
    <a href="/TomTroc/">Politique de confidentialité</a>
    <a href="/TomTroc/">Mentions légales</a>
    <p>TomTroc ©</p>
    <img class="logo-alt" src="/TomTroc/assets/images/tomtroc-alt.png" alt="Logo TomTroc">
</footer>
</body>
</html>
