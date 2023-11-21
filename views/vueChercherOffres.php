<section class="chercher-offres">
    <h2 class="section-title"><?= $traductions['search_title'] ?></h2>
    <div class="filtres-offres">
        <form action="#" method="GET">

        </form>
    </div>
    <div class="offres">
        <?php foreach($offres as $offre): ?>
            <article class="offre">
                <div class="offre-image">
                    <img src="<?= SCRIPTS ?><?= $offre["imageOffre"] ?>" alt="">
                </div>
                <div class="offre-infos">
                    <h3 class="offre-titre"><?= $offre['offre']->getTitreDeLoffre() ?></h3>
                    <p class="offre-dates">Du <?= $offre['datesOffre']->getDateDebut()->format("d/m/Y") ?> au <?= $offre['datesOffre']->getDateFin()->format("d/m/Y") ?></p>
                    <p class="offre-description"><?= $offre['infosComplementaires']->getDescription() ?></p>
                </div>
                <div class="offre-besoins">
                    <ul>
                        <li>Adresse : <?php if(!empty($offre['infosComplementaires']->getAdresse())) echo $offre['infosComplementaires']->getAdresse(); else echo 'Non renseignée'; ?></li>
                        <li><?= $offre['typeLogement']->getType() ?></li>
                        <li><?= $offre['infoOffre']->getSuperficieDeLaChambre() ?>m²</li>
                    </ul>
                    <p>Besoins :</p>
                    <ul>
                        <?php foreach($offre['besoins'] as $besoin): ?>
                            <li><?= $besoin->getBesoin() ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="offre-actions">
                    <form action="postulerOffre">
                        <input type="hidden" name="searchPost" value="<?= $_GET['searchPost'] ?? '' ?>">
                        <input type="hidden" name="idPostulerOffre" value="<?= $offre['offre']->getIdOffre() ?>">
                        <button class="bouton offre-postuler"><?= $traductions['offer_apply'] ?></button>
                    </form>
                </div>
            </article>
        <?php endforeach; ?>
        <?php if(count($offres) == 0): ?>
            <p class="no-offre"><?= $traductions['no_offer'] ?></p>
        <?php endif; ?>
    </div>
</section>
