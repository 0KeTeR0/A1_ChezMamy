<section class="gerer-offres">
    <?php include("message.php"); ?>
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

            </div>
            <div class="offre-besoins">
                <form action="" method="post">
                    <button class="boutons-supprimer"><?= $traductions['delete_offer'] ?></button>
                    <input type="hidden" name="idOffreToDelete" value="<?=$offre['offre']->getIdOffre() ?>">
                </form>
                <ul>
                    <?php if($offre['approbation']):?>
                    <li class="approbation_green"><?= $traductions['yes_approbation'] ?></li>
                    <?php else:?>
                    <li class="approbation_red"><?= $traductions['no_approbation'] ?></li>
                    <?php endif; ?>
                    <li><?= $traductions['address'] ?><?= $offre['infosComplementaires']->getAdresse() ?></li>
                    <li><?= $offre['typeLogement']->getType() ?></li>
                    <li><?= $offre['infoOffre']->getSuperficieDeLaChambre() ?>m²</li>
                    <?php foreach($offre['besoins'] as $besoin): ?>
                        <li><?= $besoin->getBesoin() ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <form action="" method="post">
                <button class="bouton-supprimer">Supprimer</button>
                <input type="hidden" name="idOffreToDelete" value="<?=$offre['offre']->getIdOffre() ?>">
            </form>
        </article>
            <div class="offre-demande-block">
                <ul class="offre-demande-liste">
                    <?php if(isset($offre['demandes']))foreach($offre['demandes'] as $demande):?>
                    <li class="offre-demande-etudiant">
                        <p><?= $traductions['Name-and-surname'].$demande->getPrenom()." ".$demande->getNom()?> </p>
                        <p><?= $traductions['Email-address'].$demande->getMail() ?></p>
                        <p><?= $traductions['Phone-number'].$demande->getNumero()?></p>
                    </li>
                    <?php endforeach;?>
                </ul>
            </div>


        <?php endforeach;?>

    </div>
</section>