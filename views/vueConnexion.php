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
                        <label for="login"><?=$traductions["register_id"]?></label>
                        <input type="text" name="login" id="login"<?= ($login !== null) ? " value='{$login}'" : '' ?>>
                    </div>
                    <div>
                        <label for="mdp"><?=$traductions["register_password"]?></label>
                        <input type="password" name="password" id="mdp">
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" id="login" class="bouton" value="<?=$traductions["register_connect"]?>">
                    <!--<p>Mot de passe oublié</p> -->
                </div>
            </form>
        </div>
    </div>
</section>