<?php $title = "Page d'accueil"; ?>
<?php ob_start() ?>

<main>

    <section class="page-accueil">
        <div class="texte-accueil">
            <h1>Bienvenue sur chezMamy, la première plateforme éthique de services entre générations.</h1>
            <p>Nous connectons les seniors et les étudiants pour favoriser le partage de compétences, d'expériences et d'entraide. Rejoignez-nous pour faire partie de cette belle initiative !</p>
        </div>
        <div class="bouton">
            <p>Je cherche un logement</p>
        </div>
        <svg viewBox="0 0 1920 89" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0 89H1920V0L0 60.6592V89Z" fill="white"/>
        </svg>
    </section>
    <section class="presentation">
        <div>
            <h2>Présentation de l'association</h2>
        </div>
        <div class="presentation-list">
            <div>
                <div class="imgPres"  id="img_right_Pres">
                    <img src="../assets/img/logo.png" alt="">
                </div>
                <div>
                    <h3>Quelques chiffres</h3>
                    <p>• <span>233</span> séniors ont proposé leur logement cette année...</p>
                    <p>• <span>1000</span> séniors qui ont proposé leur logement cette année...</p>
                    <p>• <span>500</span> séniors ont proposé leur logement cette année...</p>
                </div>
            </div>
            <div>
                <div>
                    <h3>Quelques chiffres</h3>
                    <p>• <span>233</span> séniors ont proposé leur logement cette année...</p>
                    <p>• <span>1000</span> séniors qui ont proposé leur logement cette année...</p>
                    <p>• <span>500</span> séniors ont proposé leur logement cette année...</p>
                </div>
                <div class="imgPres">
                    <img src="../assets/img/logo.png" alt="">
                </div>
            </div>
        </div>
    </section>
</main>



<?php $content = ob_get_clean(); ?>
<?php require('layout.php'); ?>
