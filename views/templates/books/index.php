<h1><?= htmlspecialchars($title) ?></h1>

<ul class="book-list">
    <?php foreach ($books as $b): ?>
        <li class="book-list-item">
            <a href="/TomTroc/books/detail/<?= $b['id'] ?>">
                <img class="book-list-item-image" src="<?= htmlspecialchars($b['imageUrl']) ?>" alt="<?= htmlspecialchars($b['title']) ?>">
            </a>
            <p class="book-list-item-title"><?= htmlspecialchars($b['title']) ?></p>
            <p class="book-list-item-author"><?= nl2br(htmlspecialchars($b['author'])) ?></p>
            <p class="book-list-item-owner"><em>Vendu par : <a href="<?= Utils::url('member', 'detail', [(int)$b['ownerId']]) ?>"><?=htmlspecialchars($b['ownerName']) ?></a></em></p>
        </li>
    <?php endforeach; ?>
</ul>
