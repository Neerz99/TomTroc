<h1><?= htmlspecialchars($title) ?></h1>

<a href="/TomTroc/books/add" class="btn" style="color: red;">Ajouter un livre A DEGAGER !</a>

<ul class="book-list">
    <?php foreach ($books as $b): ?>
        <li class="book-list-item">
            <a href="/TomTroc/books/detail/<?= $b['id'] ?>">
                <img src="<?= htmlspecialchars($b['imageUrl']) ?>" alt="<?= htmlspecialchars($b['title']) ?>">
            </a>
            <?= htmlspecialchars($b['title']) ?> par <?= htmlspecialchars($b['author']) ?>
            <p>Vendu par : <?=htmlspecialchars($b['ownerId']) ?></p>
        </li>
    <?php endforeach; ?>
</ul>
