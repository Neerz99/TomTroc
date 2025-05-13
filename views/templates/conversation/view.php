<h1><?= htmlspecialchars($title) ?></h1>

<div class="messages">
    <?php if (empty($messages)): ?>
        <p>Aucun message pour l’instant.</p>
    <?php else: ?>
        <?php foreach ($messages as $m): ?>
            <div class="msg <?= $m['senderName'] === $_SESSION['username'] ? 'sent' : 'received' ?>">
                <strong><?= htmlspecialchars_decode($m['senderName']) ?> :</strong>
                <p><?= nl2br(htmlspecialchars_decode($m['content'])) ?></p>
                <small><?= htmlspecialchars($m['timestamp']) ?></small>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<form method="post" action="<?= Utils::url('conversation','send',[$conversationId]) ?>">
    <textarea name="content" required placeholder="Votre message…"></textarea>
    <button type="submit">Envoyer</button>
</form>
