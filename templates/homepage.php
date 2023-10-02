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
</main>

<?php $content = ob_get_clean(); ?>
<?php require('layout.php'); ?>
