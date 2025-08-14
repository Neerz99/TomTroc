<div class="conversation-container">
    <?php if (empty($conversations)): ?>
        <p>Vous n’avez aucune conversation.</p>
    <?php else: ?>
        <ul class="conversation-list">
            <?php foreach ($conversations as $c): ?>
                <!-- Verifies if a conversation is selected -->
                <?php $isActive = ($c['id'] == ($selectedId ?? null)); ?>
                <li class="<?= $isActive ? 'active' : '' ?>">
                    <a href="<?= Utils::url('conversation','index', [$c['id']]) ?>">
                        <!-- Display name of the other user -->
                        <img
                                class="conversation-avatar"
                                src="<?= htmlspecialchars($c['otherAvatarUrl'] ?? '/TomTroc/assets/images/default-book.jpg') ?>"
                                alt="Avatar de <?= htmlspecialchars($c['otherUsername'] ?? '') ?>"
                        />
                        <?= htmlspecialchars(htmlspecialchars_decode($c['otherUsername'])) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <div class="conversation-item">
        <h1><?= htmlspecialchars($title) ?></h1>
        <div class="conversation-messages">
            <?php if (empty($messages)): ?>
                <p>Aucun message pour l’instant.</p>
            <?php else: ?>
                <?php foreach ($messages as $m): ?>
                    <?php $isSent = ($m['senderId'] === $_SESSION['user_id']); ?>
                    <div class="conversation-message <?= $isSent ? 'sent' : 'received' ?>">
                        <p class="conversation-message-content">
                            <?= nl2br(htmlspecialchars(htmlspecialchars_decode($m['content']))) ?>
                        </p>
                        <small class="conversation-message-time">
                            <?= htmlspecialchars($m['timestamp']) ?>
                        </small>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <?php if (isset($selectedId)): ?>
            <form
                    class="conversation-form"
                    method="post"
                    action="<?= Utils::url('conversation','send', [$selectedId]) ?>"
            >
            <textarea
                    class="conversation-input"
                    name="content"
                    required
                    placeholder="Votre message…"
            ></textarea>
                <button class="conversation-send" type="submit">Envoyer</button>
            </form>
        <?php endif; ?>
    </div>
</div>