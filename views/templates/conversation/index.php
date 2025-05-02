<h1><?= htmlspecialchars($title) ?></h1>

<?php if (empty($conversations)): ?>
    <p>Vous n’avez aucune conversation.</p>
<?php else: ?>
    <ul>
        <?php foreach ($conversations as $c): ?>
            <li>
                <a href="<?= Utils::url('conversation','view',[$c['id']]) ?>">
                    Conversation avec <?= htmlspecialchars($c['otherUsername']) ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
