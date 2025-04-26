<h1><?= htmlspecialchars($title) ?></h1>

<?php if (!empty($error)): ?>
    <p class="error"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post" action="/TomTroc/user/register">
    <div>
        <label>Nom :</label>
        <input type="text" name="name" required>
    </div>
    <div>
        <label>Email :</label>
        <input type="email" name="email" required>
    </div>
    <div>
        <label>Mot de passe :</label>
        <input type="password" name="password" required>
    </div>
    <button type="submit">S'inscrire</button>
</form>

<p><a href="/TomTroc/user/login">Déjà inscrit ? Connectez-vous ici</a></p>
