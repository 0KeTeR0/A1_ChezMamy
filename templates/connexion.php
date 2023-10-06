<?php $title = "Connexion à mon compte"; ?>
<?php ob_start(); ?>

<main>
    <section class="loginForm">
        <div class="image1"></div>
        <div class="loginBox">
            <div class="logo">
                <img src="../assets/img/logo.png" alt="">
            </div>
            <div>
                <form id="login_form" action="" method="post">
                    <div class="form-group">
                        <div class="form-pair">
                            <label for="email">Adresse email</label>
                            <input type="email" name="email" id="email">
                        </div>
                        <div>
                            <label for="mdp">Mot de passe</label>
                            <input type="password" name="password" id="mdp">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="login" id="submit" class="bouton" value="Me connecter">
                        <!--<p>Mot de passe oublié</p> -->
                    </div>
                </form>
            </div>
        </div>
    </section>
</main>


<?php $content = ob_get_clean(); ?>
<?php require('layout.php'); ?>
