<h1><?= htmlspecialchars($title)?></h1>
<img src="<?= htmlspecialchars($user['avatarUrl']) ?>" alt="Avatar de <?= htmlspecialchars_decode($user['username']) ?>">
<p><strong>Nom d’utilisateur :</strong> <?= htmlspecialchars_decode($user['username']) ?></p>
<?php if (!empty($user['bio'])): ?>
    <p><strong>Bio :</strong> <?= htmlspecialchars_decode($user['bio']) ?></p>
<?php endif; ?>

<?php if (!empty($books)): ?>
    <h2>Livres de <?= htmlspecialchars_decode($user['username']) ?></h2>
    <ul>
        <?php foreach ($books as $b): ?>
            <li>
                <a href="<?= Utils::url('books', 'detail', [(int)$b['id']]) ?>">
                    <?= htmlspecialchars_decode($b['title']) ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Aucun livre à afficher.</p>
<?php endif; ?>

