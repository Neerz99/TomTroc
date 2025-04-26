<h1><?= htmlspecialchars($title) ?></h1>

<?php if (!empty($error)): ?>
    <p class="error"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post" action="/TomTroc/user/login">
    <div>
        <label>Email :</label>
        <input type="email" name="email" required>
    </div>
    <div>
        <label>Mot de passe :</label>
        <input type="password" name="password" required>
    </div>
    <button type="submit">Se connecter</button>
</form>

<p><a href="/TomTroc/user/register">Pas encore inscrit ?</a></p>