<?php global $title; ?>

<h1><?= htmlspecialchars($title) ?></h1>

<?php if (!empty($error)): ?>
    <p class="error"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post" action="<?= Utils::url('books','add') ?>" enctype="multipart/form-data">
    <div>
        <label>Titre :</label>
        <input type="text" name="title" required>
    </div>
    <div>
        <label>Auteur :</label>
        <input type="text" name="author" required>
    </div>
    <div>
        <label>Image du livre :</label>
        <input type="file" size="5000000" name="image" accept=".jpg,.jpeg,.png,.gif">
    </div>
    <div>
        <label>Description :</label>
        <textarea name="description"></textarea>
    </div>
    <button type="submit">Créer</button>
</form>

<p><a href="<?= Utils::url('books','index') ?>">← Retour à la liste</a></p>
