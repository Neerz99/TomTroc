<div class="book-details-container">

    <?php if (!empty($book['imageUrl'])): ?>
        <img class="book-details-image" src="<?= htmlspecialchars($book['imageUrl']) ?>" alt="Image de <?= htmlspecialchars_decode($book['title']) ?>">
    <?php endif; ?>

    <div class="book-details-info">
        <h1><?= htmlspecialchars_decode($book['title']) ?></h1>
        <p><strong>Auteur :</strong> <?= htmlspecialchars($book['author']) ?></p>
        <p><?= nl2br(htmlspecialchars_decode($book['description'])) ?></p>
        <p><em>Status : <?= htmlspecialchars($book['status']) ?></em></p>

        <?php if (!empty($owner)): ?>
            <p>
                <a href="<?= Utils::url('conversation','start', [(int)$owner['id']]) ?>">
                    <button>Démarrer une discussion avec <?= htmlspecialchars_decode($owner['username']) ?></button>
                </a>
            </p>
        <?php endif; ?>
    </div>
</div>