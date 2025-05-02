<h1><?= htmlspecialchars($title)?></h1>
<img src="<?= htmlspecialchars($user['avatarUrl']) ?>" alt="Avatar de <?= htmlspecialchars($user['username']) ?>">
<p><strong>Nom d’utilisateur :</strong> <?= htmlspecialchars($user['username']) ?></p>
<?php if (!empty($user['bio'])): ?>
    <p><strong>Bio :</strong> <?= htmlspecialchars($user['bio']) ?></p>
<?php endif; ?>

<?php if (!empty($books)): ?>
    <h2>Livres de <?= htmlspecialchars($user['username']) ?></h2>
    <ul>
        <?php foreach ($books as $b): ?>
            <li>
                <a href="<?= Utils::url('books', 'detail', [(int)$b['id']]) ?>">
                    <?= htmlspecialchars($b['title']) ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Aucun livre à afficher.</p>
<?php endif; ?>

