<h1><?= htmlspecialchars_decode($book['title']) ?></h1>
<p><strong>Auteur :</strong> <?= htmlspecialchars($book['author']) ?></p>

<?php if (!empty($book['imageUrl'])): ?>
    <img src="<?= htmlspecialchars($book['imageUrl']) ?>"
         alt="Image de <?= htmlspecialchars_decode($book['title']) ?>">
<?php endif; ?>

<p><?= nl2br(htmlspecialchars_decode($book['description'])) ?></p>
<p><em>Status : <?= htmlspecialchars($book['status']) ?></em></p>

<?php if (!empty($owner)): ?>
    <p>
        <a href="<?= Utils::url('conversation','start', [(int)$owner['id']]) ?>">
            Démarrer une discussion avec <?= htmlspecialchars_decode($owner['username']) ?>
        </a>
    </p>
<?php endif; ?>

<p><a href="<?= Utils::url('books','index') ?>">← Retour à la liste</a></p>
