<h1><?= htmlspecialchars($title) ?></h1>

<img src="<?= htmlspecialchars($avatarUrl) ?>" alt="Avatar de <?= htmlspecialchars($username) ?>">
<p>Bonjour <?= htmlspecialchars($username) ?> !</p>
<p><?= htmlspecialchars($bio) ?></p>
<p><a href="<?= Utils::url('user','logout') ?>">Déconnexion</a></p>


<h1><?= htmlspecialchars($title) ?></h1>

<p>Bonjour <?= htmlspecialchars($username) ?> !</p>

<h2>Mes livres mis en échange</h2>

<?php if (empty($books)): ?>
    <p>Vous n’avez pas encore de livre à l’échange.</p>
<?php else: ?>
    <ul>
        <?php foreach ($books as $b): ?>
            <li>
                <img src="<?= htmlspecialchars($b['imageUrl']) ?>" alt="<?= htmlspecialchars($b['title']) ?>">
                <a href="<?= Utils::url('books','detail',[$b['id']]) ?>">
                    <?= htmlspecialchars($b['title']) ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<a href="/TomTroc/books/add">Ajouter un livre</a>
<a href="<?= Utils::url('books','add') ?>">
