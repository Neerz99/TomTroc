<div class="account-container">
    <div class="account-header">
        <div class="account-user">
            <h1><?= htmlspecialchars($title) ?></h1>

            <img class="account-image"
                 src="<?= htmlspecialchars($avatarUrl) ?>"
                 alt="Avatar de <?= htmlspecialchars_decode($username) ?>"
            >
            <p class="account-name">Bonjour <?= htmlspecialchars_decode($username) ?> !</p>
            <p class="account-bio"><?= htmlspecialchars_decode($bio) ?></p>
            <p class="account-date"><i class="fa-solid fa-cake-candles"></i> Membre depuis le <?= htmlspecialchars(Utils::formatDateFr($createdAt)) ?></p>

            <hr>
            <p class="account-bookshelf">Bibliothèque</p>
            <p class="account-books-count"><i class="fa-solid fa-book"></i> <?= Utils::booksCount($books) ?> livres</p>
        </div>

        <div class="account-info">
            <h2>Vos informations personnelles</h2>
            <form
                  class="account-info-form"
                  method="post"
                  action="<?= Utils::url('account', 'update') ?>"
                  enctype="multipart/form-data"
            >
                <div class="account-info-edit-avatar" >
                    <label for="avatar">Modifier avatar :</label><br>
                    <input type="file" name="avatar" id="avatar" accept="image/*">
                </div>

                <div class="account-info-edit-bio" >
                    <label for="bio">Modifier la bio :</label><br>
                    <textarea name="bio"
                              id="bio"
                              rows="3"
                              placeholder="Votre bio…"
                                maxlength="800"
                    ><?= htmlspecialchars($bio) ?></textarea>
                </div>

                <div class="account-info-edit-username" >
                    <label for="username">Nom d'utilisateur :</label><br>
                    <input type="text"
                           name="username"
                           id="username"
                           minlength="3"
                           maxlength="16"
                           value="<?= htmlspecialchars($username) ?>"
                           required>
                </div>

                <div class="account-info-edit-email" >
                    <label for="email">Email :</label><br>
                    <input type="email"
                           name="email"
                           id="email"
                           value="<?= htmlspecialchars($email) ?>"
                           required>
                </div>

                <div class="account-info-edit-password" >
                    <label for="password">Mot de passe :</label><br>
                    <input type="password"
                           name="password"
                           id="password"
                            minlength="10"
                            maxlength="64"
                           placeholder="Laissez vide pour ne pas changer">
                </div>

                <button class="account-info-edit-submit" type="submit">Mettre à jour</button>
            </form>
        </div>
    </div>

    <a class="account-add-book" href="<?= Utils::url('books','add') ?>">Ajouter un livre</a>

    <?php if (empty($books)): ?>
        <p>Vous n’avez pas encore de livre à l’échange.</p>
    <?php else: ?>
        <ul class="account-book-list">
            <?php foreach ($books as $b): ?>
                <li class="account-book-list-item">
                    <img class="account-book-list-item-image"
                         src="<?= htmlspecialchars($b['imageUrl']) ?>"
                         alt="<?= htmlspecialchars_decode($b['title']) ?>">
                    <p class="account-book-list-item-title"><?= htmlspecialchars_decode($b['title']) ?></p>
                    <p class="account-book-list-item-author"><?= htmlspecialchars_decode($b['author']) ?></p>
                    <p class="account-book-list-item-status"><?= htmlspecialchars($b['status']) ?></p>
                    <p class="account-book-list-item-description"><?= htmlspecialchars_decode(Utils::truncate($b['description'])) ?></p>
                    <a class="account-book-list-item-edit" href="<?= Utils::url('books', 'edit', [$b['id']]) ?>">Éditer</a>
                    <a class="account-book-list-item-delete"
                       href="<?= Utils::url('books','delete',[$b['id']]) ?>">
                        Supprimer
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <a href="<?= Utils::url('books','add') ?>"></a>
</div>
