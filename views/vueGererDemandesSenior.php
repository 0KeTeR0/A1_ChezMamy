<section class="gerer-offres">
    <h2 class="section-title"><?= $traductions['management_title']?></h2>
    <div class="offres">

        <?php foreach ($offres as $offre): ?>
        <article class="offre">
            <div class="offre-image">
                <img src="<?= SCRIPTS ?><?= $offre["imageOffre"] ?>" alt="">
            </div>
            <div class="offre-infos">
                <h3 class="offre-titre"><?= $offre['offre']->getTitreDeLoffre() ?></h3>
                <p class="offre-dates">Du <?= $offre['datesOffre']->getDateDebut()->format("d/m/Y") ?> au <?= $offre['datesOffre']->getDateFin()->format("d/m/Y") ?></p>
                <p class="offre-description"><?= $offre['infosComplementaires']->getDescription() ?></p>
                <form action="" method="post">
                    <button class="bouton-supprimer">Supprimer</button>
                    <input type="hidden" name="idOffreToDelete" value="<?=$offre['offre']->getIdOffre() ?>">
                </form>
            </div>
            <div class="offre-besoins">
                <ul>
                    <li><?= $offre['infosComplementaires']->getAdresse() ?></li>
                    <li><?= $offre['typeLogement']->getType() ?></li>
                    <li><?= $offre['infoOffre']->getSuperficieDeLaChambre() ?>m²</li>
                    <?php foreach($offre['besoins'] as $besoin): ?>
                        <li><?= $besoin->getBesoin() ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div>
                <ul>
                    <li>Nom Prénom</li>
                    <li>Adresse@cnul.com</li>
                    <li>06 06 06 06 06</li>
                </ul>
            </div>
        </article>


        <?php endforeach;?>


        <!-- CODE HTML DUR
        <article class="offre">
            <div class="offre-image">
                <img src="" alt="">
            </div>
            <div class="offre-infos">
                <h3 class="offre-titre">TITRE</h3>
                <p class="offre-dates">Du 1/01/2023 au 2/01/2023</p>
                <p class="offre-description">Description</p>
                <form action="#" method="post">
                    <button class="bouton-supprimer" type="button">Supprimer</button>
                </form>
            </div>
            <div class="offre-besoins">
                <ul>
                    <li>250 Quelquepart ruduchen</li>
                    <li>Maison</li>
                    <li>5m²</li>
                    <li>Besoin de voitur</li>
                    <li>Besoin de manguer</li>
                </ul>
            </div>
        </article>
        <div>
            <ul>
                <li>Nom Prénom</li>
                <li>Adresse@cnul.com</li>
                <li>06 06 06 06 06</li>
            </ul>
            <ul>
                <li>Nom2 Prénom2</li>
                <li>Adresse2@cnul2.com2</li>
                <li>07 07 07 07 07</li>
            </ul>
        </div>
        -->
    </div>
</section>