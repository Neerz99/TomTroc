<div class="account-container">
    <div class="account-header">
        <div class="account-user">
            <h1><?= htmlspecialchars($title) ?></h1>

            <img class="account-image"
                 src="<?= htmlspecialchars($avatarUrl) ?>"
                 alt="Avatar de <?= htmlspecialchars_decode($username) ?>"
            ><!--Add field to modify-->
            <p class="account-name" >Bonjour <?= htmlspecialchars_decode($username) ?> !</p>
            <p class="account-date" >Compte créé le <?= htmlspecialchars(Utils::formatDateFr($createdAt)) ?></p>
            <p class="account-bio" ><?= htmlspecialchars_decode($bio) ?></p> <!--Add field to modify-->
        </div>
        <div class="account-info">
        <h2>Vos informations personnelles</h2>
            <form method="post" action="<?= Utils::url('account', 'update') ?>">
                <div>
                    <label for="username">Nom d'utilisateur :</label>
                    <input type="text" name="username" id="username" value="<?= htmlspecialchars($username) ?>" required>
                </div>
                <div>
                    <label for="email">Email :</label>
                    <input type="email" name="email" id="email" value="<?= htmlspecialchars($email) ?>" required>
                </div>
                <div for="password">
                    <label for="password">Mot de passe :</label>
                    <input
                            type="password"
                           name="password"
                           id="password"
                           placeholder="Laissez vide si vous ne souhaitez pas changer le mot de passe"
                    >
                </div>
                <button type="submit">Mettre à jour</button>
            </form>
        </div>
    </div>

    <a class="account-add-book" href="/TomTroc/books/add">Ajouter un livre</a>

    <?php if (empty($books)): ?>
        <p>Vous n’avez pas encore de livre à l’échange.</p>
    <?php else: ?>
        <ul class="account-book-list">
            <?php foreach ($books as $b): ?>
                <li class="account-book-list-item">
                    <img class="account-book-list-item-image" src="<?= htmlspecialchars($b['imageUrl']) ?>" alt="<?= htmlspecialchars_decode($b['title']) ?>">
                    <p class="account-book-list-item-title"><?= htmlspecialchars_decode($b['title']) ?></p>
                    <p class="account-book-list-item-author"><?= htmlspecialchars_decode($b['author']) ?></p>
                    <p class="account-book-list-item-description"><?= htmlspecialchars_decode($b['description']) ?></p>
                    <p class="account-book-list-item-status"><?= htmlspecialchars($b['status']) ?></p>
                    <a class="account-book-list-item-edit" href="/">Éditer</a>
                    <a class="account-book-list-item-delete" href="<?= Utils::url('books', 'delete', ($b['id'])) ?>">Supprimer</a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <a href="<?= Utils::url('books','add') ?>">
</div>