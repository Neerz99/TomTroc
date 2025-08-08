<div class="profile-container">
    <aside class="profile-card">
        <img
                class="profile-avatar"
                src="<?= htmlspecialchars($user['avatarUrl'], ENT_COMPAT) ?>"
                alt="Avatar de <?= htmlspecialchars_decode($user['username']) ?>"
        >
        <h1 class="profile-name"><?= htmlspecialchars_decode($title) ?></h1>
        <p class="profile-field">
            <strong>Nom d’utilisateur :</strong> <?= htmlspecialchars_decode($user['username']) ?>
        </p>
        <p class="profile-field">
            Membre depuis : <?= htmlspecialchars(Utils::calculateDuration($user['createdAt'])) ?>
        </p>
        <?php if (!empty($user['bio'])): ?>
            <p class="profile-field">
                <strong>Bio :</strong> <?= htmlspecialchars_decode($user['bio']) ?>
            </p>
        <?php endif; ?>

            <p class="profile-field">
                <strong>Bibliothèque : </strong><?= Utils::booksCount($books) ?> Livres
            </p>
        <a href="<?= Utils::url('conversation','start',[$user['id']]) ?>" class="profile-button">
            Écrire un message
        </a>
    </aside>

    <section class="books-section">
        <?php if (!empty($books)): ?>
            <h2 class="books-title">Livres de <?= htmlspecialchars_decode($user['username']) ?></h2>
            <table class="books-table">
                <thead>
                <tr>
                    <th>Photo</th>
                    <th>Titre</th>
                    <th>Auteur</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($books as $b): ?>
                    <tr>
                        <td>
                            <img
                                    src="<?= htmlspecialchars($b['imageUrl'], ENT_COMPAT) ?>"
                                    alt="<?= htmlspecialchars_decode($b['title']) ?>"
                                    class="book-thumb"
                            >
                        </td>
                        <td>
                            <a href="<?= Utils::url('books','detail',[$b['id']]) ?>">
                                <?= htmlspecialchars_decode($b['title']) ?>
                            </a>
                        </td>
                        <td><?= htmlspecialchars_decode($b['author']) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="no-books">Aucun livre à afficher.</p>
        <?php endif; ?>
    </section>
</div>
