<div class="register-container">

    <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <div class="register-content">

        <form method="post" action="<?= Utils::url('user','register') ?>">

            <h1><?= htmlspecialchars($title) ?></h1>

            <div class="register-field">
                <label>Nom d’utilisateur :</label>
                <input type="text" name="username" minlength="3" maxlength="16" required>
            </div>

            <div class="register-field">
                <label>Email :</label>
                <input type="email" name="email" required>
            </div>

            <div class="register-field">
                <label>Mot de passe :</label>
                <input type="password" name="password" minlength="10" maxlength="64" required>
            </div>

            <div class="register-field">
                <label>Confirmer le mot de passe :</label>
                <input type="password" name="password2" required>
            </div>

            <button class="register-submit" type="submit">S’inscrire</button>

            <a class="register-login" href="<?= Utils::url('user', 'login') ?>">Déjà inscrit ? Connectez-vous</a>

        </form>

        <img class="register-image" src="../assets/images/login_page.jpg" alt="Librairie">

    </div>


</div>