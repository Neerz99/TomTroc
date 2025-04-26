<?php
$title = $title ?? 'Bienvenue sur TomTroc';
$books = $books ?? [];
?>
<div class="home-cta">
    <div class="home-cta-left">
        <h1><?= htmlspecialchars($title) ?></h1>
        <p>Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux de la lecture. Nous croyons en la magie du partage de connaissances et d'histoires à travers les livres. </p>
        <a href="/TomTroc/books"><button>Découvrir</button></a>
    </div>
    <div class="home-cta-right">
        <img src="https://picsum.photos/200/300" alt="Image aléatoire">
    </div>
</div>