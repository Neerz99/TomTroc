<h1><?= htmlspecialchars($title) ?></h1>

<img class="account-image" src="<?= htmlspecialchars($avatarUrl) ?>" alt="Avatar de <?= htmlspecialchars_decode($username) ?>">
<p class="account-hello" >Bonjour <?= htmlspecialchars_decode($username) ?> !</p>
<p class="account-bio" ><?= htmlspecialchars_decode($bio) ?></p>
<p class="account-logout" ><a href="<?= Utils::url('user','logout') ?>">Déconnexion</a></p>

<h2>Mes livres mis en échange</h2>

<a href="/TomTroc/books/add">Ajouter un livre</a>

<?php if (empty($books)): ?>
    <p>Vous n’avez pas encore de livre à l’échange.</p>
<?php else: ?>
    <ul class="account-book-list">
        <?php foreach ($books as $b): ?>
            <li class="account-book-list-item">
                <img class="account-book-list-item-image" src="<?= htmlspecialchars($b['imageUrl']) ?>" alt="<?= htmlspecialchars_decode($b['title']) ?>">
                <p class="account-book-list-item-title"><?= htmlspecialchars_decode($b['title']) ?></p>
                <p class="account-book-list-item-author"><?= htmlspecialchars_decode($b['author']) ?></p>
                <p class="account-book-list-item-description"><?= htmlspecialchars_decode($b['description']) ?></p>
                <p class="account-book-list-item-status"><?= htmlspecialchars($b['status']) ?></p>
                <a class="account-book-list-item-edit" href="/">Éditer</a>
                <a class="account-book-list-item-delete" href="<?= Utils::url('books', 'delete', ($b['id'])) ?>">Supprimer</a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<a href="<?= Utils::url('books','add') ?>">
