<section class="loginForm">
    <div class="image-connexion"></div>
    <div class="loginBox">
        <div class="logo">
            <img src="public/img/logo.png" alt="">
        </div>
        <div>
            <form id="login_form" action="" method="post">
                <?php include('message.php'); ?>
                <div class="form-group">
                    <div class="form-pair">
                        <label for="login">Identifiant</label>
                        <input type="text" name="login" id="login"<?= ($login !== null) ? " value='{$login}'" : '' ?>>
                    </div>
                    <div>
                        <label for="mdp">Mot de passe</label>
                        <input type="password" name="password" id="mdp">
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" id="login" class="bouton" value="Me connecter">
                </div>
                <div class="form-group">
                    <small>Je n'ai pas encore de compte, <a href="inscription">j'en crée un.</a></small>
                </div>
            </form>
        </div>
    </div>
</section>