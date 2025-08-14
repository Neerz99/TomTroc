<div class="add-book-container">
    <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <div class="add-book-content">

    <img class="add-book-image-current" src="<?= Utils::url('assets', 'images', 'default-book.jpg') ?>" alt="Image par défaut du livre">

    <form class="add-book-form" method="post" action="<?= Utils::url('books','add') ?>" enctype="multipart/form-data">
        <h1><?= htmlspecialchars($title) ?></h1>
        <div class="add-book-image">
            <label for="image">Image du livre :</label>
            <input type="file" size="5000000" name="image" accept="image/*" required>
        </div>
        <div class="add-book-field">
            <label for="title">Titre :</label>
            <input  id="title" type="text" name="title" required>
        </div>
        <div class="add-book-field">
            <label for="author">Auteur :</label>
            <input id="author" type="text" name="author" required>
        </div>
        <div class="add-book-field">
            <label for="description">Description :</label>
            <textarea name="description" id="description" rows="4"></textarea>
        </div>
        <button class="add-book-submit" type="submit">Ajouter le livre</button>
    </form>
    </div>
</div>