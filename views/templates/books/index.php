<h1><?= htmlspecialchars($title) ?></h1>

<ul class="book-list">
    <?php foreach ($books as $b): ?>
        <li class="book-list-item">
            <a href="/TomTroc/books/detail/<?= $b['id'] ?>">
                <img src="<?= htmlspecialchars($b['imageUrl']) ?>" alt="<?= htmlspecialchars($b['title']) ?>">
            </a>
            <?= htmlspecialchars($b['title']) ?> par <?= htmlspecialchars($b['author']) ?>
            <p>Vendu par : <a href="<?= Utils::url('member', 'detail', [(int)$b['ownerId']]) ?>"><?=htmlspecialchars($b['ownerName']) ?></a></p>
        </li>
    <?php endforeach; ?>
</ul>
