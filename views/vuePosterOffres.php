<section class="posterOffres">
    <div class="contactBox">
        <div>
            <form id="offres_form" action="" method="post" enctype="multipart/form-data">
                <?php include('message.php'); ?>
                <div class="form-group registerBox">
                    <h2 class="section-title">Faire une offre de logement</h2>
                    <div class="form-pair">
                        <label for="TitreDeLoffre">Titre de l'offre</label>
                        <input type="text" name="TitreDeLoffre" id="TitreDeLoffre" required>
                    </div>
                    <div class="form-pair">
                        <label for="housing">Type de logement</label>
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
                        <label for="needs">Quels sont vos besoins ?</label>
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
                            <h3>Date de disponibilité du logement</h3>
                        </div>
                        <div class="form-pair">
                            <label for="date_debut_offre">Date début</label>
                            <input type="date" id="date_debut_offre" name="date_debut_offre" required>
                        </div>
                        <div>
                            <label for="date_fin_offre">Date de fin</label>
                            <input type="date" id="date_fin_offre" name="date_fin_offre" required>
                        </div>
                    </div>
                    <div class="form-pair">
                        <label for="adresse">Adresse</label>
                        <input type="text" id="adresse" name="adresseLogement">
                    </div>
                    <div class="form-pair">
                        <label for="Surface">Superficie de la chambre (en m²)</label>
                        <div class="form-pair">
                            <input type="number" name="room_surface" id="Surface" value="9" min="9" max="99" required>
                        </div>
                    </div>
                    <div>
                        <label for="descriptionOffre">Description</label>
                        <textarea name="descriptionOffre" id="descriptionOffre" required></textarea>
                    </div>
                    <div class="img_file_article">
                        <div>
                            <label for="file-input" class="drop-container">
                                <span class="drop-title">Déposer votre fichier ici</span>
                                ou
                                <input type="file" accept="image/*" id="file-input" required>
                            </label>
                        </div>
                        <div class="input_file_titre">
                            <span>Images de l'offre</span>
                        </div>
                    </div>
                    <div>
                        <input type="submit" id="envoyer" class="bouton" value="Poster l'offre">
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>