<h1><?= htmlspecialchars($title) ?></h1>

<?php if (!empty($error)): ?>
    <p class="error"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post" action="/TomTroc/books/add">
    <div>
        <label>Titre :</label>
        <input type="text" name="title" required>
    </div>
    <div>
        <label>Auteur :</label>
        <input type="text" name="author" required>
    </div>
    <div>
        <label>URL de l’image :</label>
        <input type="text" name="imageUrl">
    </div>
    <div>
        <label>Description :</label>
        <textarea name="description"></textarea>
    </div>
    <button type="submit">Créer</button>
</form>

<p><a href="/TomTroc/books/index">← Retour à la liste</a></p>
