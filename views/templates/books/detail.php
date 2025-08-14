<div class="book-details-container">

    <?php if (!empty($book['imageUrl'])): ?>
        <img class="book-details-image" src="<?= htmlspecialchars($book['imageUrl']) ?>" alt="Image de <?= htmlspecialchars_decode($book['title']) ?>">
    <?php endif; ?>

    <div class="book-details-info">
        <h1 class="book-details-info-title"><?= htmlspecialchars_decode($book['title']) ?></h1>
        <em class="book-details-info-author">par <?= htmlspecialchars($book['author']) ?></em>
        <p class="book-details-info-status" style="color: <?= strtolower($book['status']) === 'disponible' ? '#00AC66' : '#FF0000'; ?>;">
            <em><?= htmlspecialchars($book['status']) ?></em>
        </p>
        <p class="book-details-info-description"><?= nl2br(htmlspecialchars_decode($book['description'])) ?></p>


        <div class="book-details-info-owner">
            <a href="<?= Utils::url('member', 'detail', [(int)$owner['id']]) ?>">
                <img class="book-details-info-owner-picture" src="<?= htmlspecialchars($owner['avatarUrl']) ?>" alt="Avatar de <?= htmlspecialchars_decode($owner['username']) ?>">
                <p class="book-details-info-owner-name"><?= htmlspecialchars_decode($owner['username']) ?></p>
            </a>
        </div>

        <?php if (!empty($owner)): ?>
                <a class="book-details-conversation-button" href="<?= Utils::url('conversation','start', [(int)$owner['id']]) ?>">
                    Démarrer une discussion avec <?= htmlspecialchars_decode($owner['username']) ?>
                </a>
        <?php endif; ?>
    </div>
</div>