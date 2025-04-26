<h1><?= htmlspecialchars($book['title']) ?></h1>
<p><strong>Auteur :</strong> <?= htmlspecialchars($book['author']) ?></p>
<?php if (!empty($book['imageUrl'])): ?>
    <img src="<?= htmlspecialchars($book['imageUrl']) ?>" alt="Image de <?= htmlspecialchars($book['title']) ?>">
<?php endif; ?>
<p><?= nl2br(htmlspecialchars($book['description'])) ?></p>
<p><em>Status : <?= htmlspecialchars($book['status']) ?></em></p>

<p><a href="/TomTroc/books/index">← Retour à la liste</a></p>
