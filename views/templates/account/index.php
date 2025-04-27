<h1><?= htmlspecialchars($title) ?></h1>

<img class="account-image" src="<?= htmlspecialchars($avatarUrl) ?>" alt="Avatar de <?= htmlspecialchars($username) ?>">
<p class="account-hello" >Bonjour <?= htmlspecialchars($username) ?> !</p>
<p class="account-bio" ><?= htmlspecialchars($bio) ?></p>
<p class="account-logout" ><a href="<?= Utils::url('user','logout') ?>">Déconnexion</a></p>

<h2>Mes livres mis en échange</h2>

<?php if (empty($books)): ?>
    <p>Vous n’avez pas encore de livre à l’échange.</p>
<?php else: ?>
    <ul class="account-book-list">
        <?php foreach ($books as $b): ?>
            <li class="account-book-list-item">
                <img class="account-book-list-item-image" src="<?= htmlspecialchars($b['imageUrl']) ?>" alt="<?= htmlspecialchars($b['title']) ?>">
                <p class="account-book-list-item-title"><?= htmlspecialchars($b['title']) ?></p>
                <p class="account-book-list-item-author"><?= htmlspecialchars($b['author']) ?></p>
                <p class="account-book-list-item-description"><?= htmlspecialchars($b['description']) ?></p>
                <p class="account-book-list-item-status"><?= htmlspecialchars($b['status']) ?></p>
                <a class="account-book-list-item-edit" href="/">Éditer</a>
                <a class="account-book-list-item-delete" href="/">Supprimer</a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<a href="/TomTroc/books/add">Ajouter un livre</a>
<a href="<?= Utils::url('books','add') ?>">
