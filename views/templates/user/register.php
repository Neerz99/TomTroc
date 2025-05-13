<h1><?= htmlspecialchars($title) ?></h1>

<?php if (!empty($error)): ?>
    <p class="error"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post" action="<?= Utils::url('user','register') ?>">
    <div>
        <label>Nom d’utilisateur :</label>
        <input type="text" name="username" minlength="3" maxlength="16" required>
    </div>
    <div>
        <label>Email :</label>
        <input type="email" name="email" required>
    </div>
    <div>
        <label>Mot de passe :</label>
        <input type="password" name="password" minlength="10" maxlength="64" required>
    </div>
    <div>
        <label>Confirmer le mot de passe :</label>
        <input type="password" name="password2" required>
    </div>
    <button type="submit">S’inscrire</button>
</form>
