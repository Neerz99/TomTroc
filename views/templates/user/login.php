<div class="login-container">

    <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <div class="login-content">

        <form method="post" action="<?= Utils::url('user', 'login') ?>">

            <h1><?= htmlspecialchars($title) ?></h1>

            <div class="login-field">
                <label>Email :</label>
                <input type="email" name="email" required>
            </div>
            <div class="login-field">
                <label>Mot de passe :</label>
                <input type="password" name="password" required>
            </div>

            <button class="login-submit" type="submit">Se connecter</button>

            <a class="login-register" href="<?= Utils::url('user', 'register') ?>">Pas encore inscrit ?</a>

        </form>

        <img class="login-image" src="../assets/images/login_page.jpg" alt="Librairie">

    </div>

</div>