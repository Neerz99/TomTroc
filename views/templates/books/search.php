<h1><?= htmlspecialchars($title) ?></h1>

<form method="GET" action="/TomTroc/books/search">
    <input type="text" name="search" placeholder="Rechercher un livre">
    <input type="submit" value="Rechercher">
</form>

<ul class="book-list">
    <?php foreach ($books as $b): ?>
        <li class="book-list-item">
            <a href="/TomTroc/books/detail/<?= $b['id'] ?>">
                <img class="book-list-item-image" src="<?= htmlspecialchars($b['imageUrl']) ?>" alt="<?= htmlspecialchars_decode($b['title']) ?>">
            </a>
            <div class="book-list-item-info">
                <p class="book-list-item-title"><?= htmlspecialchars_decode($b['title']) ?></p>
                <p class="book-list-item-author"><?= nl2br(htmlspecialchars_decode($b['author'])) ?></p>
                <p class="book-list-item-owner"><em>Vendu par : <a href="<?= Utils::url('member', 'detail', [(int)$b['ownerId']]) ?>"><?=htmlspecialchars_decode($b['ownerName']) ?></a></em></p>
            </div>
        </li>
    <?php endforeach; ?>
    <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
    <?php endif; ?>

</ul>
