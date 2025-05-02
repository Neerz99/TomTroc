<h1><?= htmlspecialchars($book['title']) ?></h1>
<p><strong>Auteur :</strong> <?= htmlspecialchars($book['author']) ?></p>

<?php if (!empty($book['imageUrl'])): ?>
    <img src="<?= htmlspecialchars($book['imageUrl']) ?>"
         alt="Image de <?= htmlspecialchars($book['title']) ?>">
<?php endif; ?>

<p><?= nl2br(htmlspecialchars($book['description'])) ?></p>
<p><em>Status : <?= htmlspecialchars($book['status']) ?></em></p>

<?php if (!empty($owner)): ?>
    <p>
        <a href="<?= Utils::url('conversation','start', [(int)$owner['id']]) ?>">
            Démarrer une discussion avec <?= htmlspecialchars($owner['username']) ?>
        </a>
    </p>
<?php endif; ?>

<p><a href="<?= Utils::url('books','index') ?>">← Retour à la liste</a></p>
