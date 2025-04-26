<h1><?= htmlspecialchars($title) ?></h1>

<img src="<?= htmlspecialchars($avatarUrl) ?>" alt="Avatar de <?= htmlspecialchars($username) ?>">
<p>Bonjour <?= htmlspecialchars($username) ?> !</p>
<p><?= htmlspecialchars($bio) ?></p>
<a href="/TomTroc/books/add">Ajouter un livre</a>
<p><a href="<?= Utils::url('user','logout') ?>">Déconnexion</a></p>
