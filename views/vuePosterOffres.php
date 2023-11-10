<section class="posterOffres">
    <div class="contactBox">
        <div>
            <form id="offres_form" action="" method="post" enctype="multipart/form-data">
                <?php include('message.php'); ?>
                <div class="form-group registerBox">
                    <h2 class="section-title"><?= $traductions['offer_main_title'] ?></h2>
                    <div class="form-pair">
                        <label for="TitreDeLoffre"><?= $traductions['offer_title'] ?></label>
                        <input type="text" name="TitreDeLoffre" id="TitreDeLoffre" required>
                    </div>
                    <div class="form-pair">
                        <label for="housing"><?= $traductions['offer_housing'] ?></label>
                        <select name="housing" id="housing" required>
                            <?php
                            foreach($type_logement as $objet){
                                echo "<option value=\""
                                    .$objet->getIdTypeLogement()
                                    ."\">".$objet->getType()
                                    ."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-pair">
                        <label for="needs"><?= $traductions['offer_needs'] ?></label>
                        <select name="needs[]" id="needs" multiple required>
                            <?php
                            foreach($SBesoin as $objet){
                                echo "<option value=\""
                                    .$objet->getIdBesoin()
                                    ."\">".$objet->getBesoin()
                                    ."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <div>
                            <h3><?= $traductions['offer_availability_dates'] ?></h3>
                        </div>
                        <div class="form-pair">
                            <label for="date_debut_offre"><?= $traductions['offer_begin'] ?></label>
                            <input type="date" id="date_debut_offre" name="date_debut_offre" required>
                        </div>
                        <div>
                            <label for="date_fin_offre"><?= $traductions['offer_end'] ?></label>
                            <input type="date" id="date_fin_offre" name="date_fin_offre" required>
                        </div>
                    </div>
                    <div class="form-pair">
                        <label for="adresse"><?= $traductions['offer_address'] ?></label>
                        <input type="text" id="adresse" name="adresseLogement">
                    </div>
                    <div class="form-pair">
                        <label for="Surface"><?= $traductions['offer_surface'] ?></label>
                        <div class="form-pair">
                            <input type="number" name="room_surface" id="Surface" value="9" min="9" max="99" required>
                        </div>
                    </div>
                    <div>
                        <label for="descriptionOffre"><?= $traductions['offer_description'] ?></label>
                        <textarea name="descriptionOffre" id="descriptionOffre" required></textarea>
                    </div>
                    <div class="img_file_article">
                        <div>
                            <label for="file-input" class="drop-container">
                                <span class="drop-title"><?= $traductions['offer_drop_files'] ?></span>
                                ou
                                <input type="file" id="file-input" name="imagesOffre[]" accept="image/png, image/jpeg, image/jpg" required>
                            </label>
                        </div>
                        <div class="input_file_titre">
                            <span><?= $traductions['offer_images'] ?></span>
                        </div>
                    </div>
                    <div>
                        <input type="submit" id="envoyer" class="bouton" value="<?= $traductions['offer_submit'] ?>">
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>