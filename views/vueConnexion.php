<section class="loginForm">
    <div class="image-connexion"></div>
    <div class="loginBox">
        <div class="logo">
            <img src="<?= SCRIPTS ?>img/logo.png" alt="">
        </div>
        <div>
            <form id="login_form" action="" method="post">
                <?php include('message.php'); ?>
                <div class="form-group">
                    <div class="form-pair">
                        <label for="login"><?=$traductions["login_id"]?></label>
                        <input type="text" name="login" id="login"<?= ($login !== null) ? " value='{$login}'" : '' ?>>
                    </div>
                    <div>
                        <label for="mdp"><?=$traductions["login_password"]?></label>
                        <input type="password" name="password" id="mdp">
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" id="login" class="bouton" value="<?=$traductions["login_connect"]?>">
                </div>
                <div class="form-group">
                    <small><?= $traductions["login_no_account"] ?></small>
                </div>
            </form>
        </div>
    </div>
</section>