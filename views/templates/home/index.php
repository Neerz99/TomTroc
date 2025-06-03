<?php
$title = $title ?? 'Bienvenue sur TomTroc';
$books = $books ?? [];
?>
<div class="home-container">
    <div class="home-cta">
        <div class="home-cta-left">
            <h1><?= htmlspecialchars($title) ?></h1>
            <p>Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux de la lecture. Nous croyons en la magie du partage de connaissances et d'histoires à travers les livres. </p>
            <a href="/TomTroc/books">Découvrir</a>
        </div>
        <div class="home-cta-right">
            <img src="assets/images/home-cta-right.jpg" alt="Image aléatoire">
        </div>
    </div>
    <div class="home-latest-books">
        <h2>Les derniers livres ajoutés</h2>
        <div class="book-list-wrapper">
            <ul class="book-list">
                <?php foreach ($latestBooks as $b): ?>
                    <li class="book-list-item">
                        <a class="book-list-item-container" href="/TomTroc/books/detail/<?= $b['id'] ?>">
                            <img class="book-list-item-image" src="<?= htmlspecialchars($b['imageUrl']) ?>" alt="<?= htmlspecialchars_decode($b['title']) ?>">
                            <?php if ($b['status'] === 'Indisponible'): ?>
                                <p class="book-list-item-status">
                                    <?= htmlspecialchars('Indisponible') ?>
                                </p>
                            <?php endif; ?>
                        </a>

                        <div class="book-list-item-info">
                            <p class="book-list-item-title"><?= htmlspecialchars_decode($b['title']) ?></p>
                            <p class="book-list-item-author"><?= nl2br(htmlspecialchars_decode($b['author'])) ?></p>
                            <p class="book-list-item-owner"><em>Vendu par : <a href="<?= Utils::url('member', 'detail', [(int)$b['ownerId']]) ?>"><?=htmlspecialchars_decode($b['ownerName']) ?></a></em></p>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
    <div class="home-faq">
        <h2>Comment ca marche ?</h2>
        <p>Échanger des livres avec TomTroc c'est simple et amusant ! Suivez ces étapes pour commncer :</p>
            <ul class="home-faq-list">
                <li class="home-faq-list-item">Inscrivez-vous gratuitement sur notre plateforme.</li>
                <li class="home-faq-list-item">Ajoutez les livres que vous souhaitez échanger à votre profil.</li>
                <li class="home-faq-list-item">Parcourez les livres disponibles chez d'autres membres.</li>
                <li class="home-faq-list-item">Proposez un échange et discutez avec d'autres passionnés de lecture.</li>
            </ul>
        <a href="/TomTroc/books">Voir tous les livres</a>
    </div>
    <img class="home-image" src="./assets/images/a13999bc4c3f0a4a254acb5010dd96d3fb7321e4.jpg" alt="Librairie">
    <div class="home-values">
        <h2>Nos valeurs</h2>
        <p>Chez Tom Troc, nous mettons l'accent sur le partage, la découverte et la communauté. Nos valeurs sont ancrées dans notre passion pour les livres et notre désir de créer des liens entre les lecteurs. Nous croyons en la puissance des histoires pour rassembler les gens et inspirer des conversations enrichissantes.</p>
        <p>Notre association a été fondée avec une conviction profonde : chaque livre mérite d'être lu et partagé. </p>
        <p>Nous sommes passionnés par la création d'une plateforme conviviale qui permet aux lecteurs de se connecter, de partager leurs découvertes littéraires et d'échanger des livres qui attendent patiemment sur les étagères.</p>
        <p class="home-values-team">L'équipe Tom Troc</p>
        <img src="./assets/images/heart.svg">
    </div>
</div>