<div class="book-edition-container">
    <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars_decode($error) ?></p>
    <?php endif; ?>

    <form method="post" enctype="multipart/form-data">
        <h1><?= htmlspecialchars_decode($title) ?></h1>

        <div class="book-edition-image">
            <label for="imageUrl">Image du livre :</label>
            <input type="file" name="imageUrl" accept="image/*">
        </div>

        <div class="book-edition-field">
            <label for="title">Titre :</label>
            <input
                type="text"
                id="title"
                name="title"
                value="<?= htmlspecialchars_decode($book['title']) ?>"
                required
            >
        </div>

        <div class="book-edition-field">
            <label for="author">Auteur :</label>
            <input
                type="text"
                id="author"
                name="author"
                value="<?= htmlspecialchars_decode($book['author']) ?>"
                required
            >
        </div>

        <div class="book-edition-field">
            <label for="description">Description :</label>
            <textarea
                id="description"
                name="description"
                rows="4"
            ><?= htmlspecialchars_decode($book['description']) ?></textarea>
        </div>

        <div class="book-edition-status">
            <label for="status">Statut :</label>
            <select id="status" name="status" required>
                <option value="Disponible"
                    <?= $book['status'] === 'Disponible' ? 'selected' : '' ?>>
                    Disponible
                </option>
                <option value="Indisponible"
                    <?= $book['status'] === 'Indisponible' ? 'selected' : '' ?>>
                    Indisponible
                </option>
            </select>
        </div>


        <button type="submit" class="book-edition-submit">Enregistrer les modifications</button>
    </form>
</div>
