<?php $title = "Page d'accueil"; ?>
<?php ob_start() ?>

    <main>
        <section class="choix_etudiant_senior">
            <div>
                <div>
                    <h1>Création de profil</h1>
                </div>
                <div>
                    <p>Je suis</p>
                </div>
                <div>
                    <div>

                    </div>
                    <div>

                    </div>
                </div>
            </div>
        </section>

        <section class="Form_etudiant">

        </section>

        <section class="Form_Senior">

        </section>
    </main>


<?php $content = ob_get_clean(); ?>
<?php require('layout.php'); ?>