<?php $title = "Page d'accueil"; ?>
<?php ob_start() ?>

    <main>
        <section class="registerForm">
            <div class="registerBox">
                <div>
                    <h1 class="section-title">Création de profil</h1>
                    <small class="registerStep">Etape <span>1</span>/5</small>
                </div>
                <div>
                    <div id="registerChoice">
                        <p><b>Je suis...</b></p>
                        <div id="jeSuisEtudiant" class="bouton">Étudiant à la recherche d’un logement</div>
                        <div id="jeSuisSenior" class="bouton">Sénior avec un logement à partager</div>
                    </div>
                    <!-- Formulaire de création de profil étudiant -->
                    <form action="" method="post">
                        <div>
                            <h1>Profil Etudiant</h1>
                        </div>

                        <div id="Etudiant_etape1" class="form-group">
                            <h2>Identité</h2>
                            <div>
                                <label for="fname">Prénom :</label>
                                <input type="text" id="fname" name="first_name" autofocus required>
                            </div>
                            <div>
                                <label for="lname">Nom :</label>
                                <input type="text" id="lname" name="last_name" required>
                            </div>
                            <div>
                                <label for="bdate">Date de naissance :</label>
                                <input type="date" id="bdate" name="date_of_birth" max="2008-01-01" required>
                            </div>
                            <div>
                                <label for="nationalité">Nationalité :</label>
                                <input type="text" name="nationality" id="nationalité" required>
                            </div>
                            <div>
                                <label for="num">Téléphone :</label>
                                <input type="tel" id="num" name="phone" placeholder="Au format 00-00-00-00-00" pattern="[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}" required>
                            </div>
                            <div>
                                <label for="mail">Adresse email <i>(identifiant de connexion)</i> :</label>
                                <input type="email" id="mail" name="email" placeholder="exemple@gmail.com" required>
                            </div>
                            <div>
                                <label for="AdressePrt">Adresse des parents :</label>
                                <input type="text" name="parents_address" id="AdressePrt" required>
                            </div>
                            <div>
                                <label for="residence">Ville :</label>
                                <input type="text" id="residence" name="city" required>
                            </div>
                            <div>
                                <label for="postal">Code postal :</label>
                                <input type="text" id="postal" name="postal_code" title="doit comporter 5 chiffres" pattern="[0-9]{5}" required>
                            </div>

                            <div>
                                <label for="knowAssociation">Comment avez-vous connu notre association ?</label>
                                <input type="text" id="knowAssociation" name="know_association" required>
                            </div>

                            <div>
                                <label for="motivation">Vos motivations pour choisir ce mode de logement</label>
                                <textarea name="motivation" id="motivation" cols="4" rows="2" required></textarea>
                            </div>
                            <div>
                                <div class="bouton">Étape suivante</div>
                            </div>
                        </div>

                        <div id="Etudiant_etape2" class="form-group">
                            <div>
                                <h2>Etudes / stages</h2>
                            </div>
                            <div>
                                <label for="education_level">Collégiale et cycle supérieur :</label>
                                <input type="text" name="education_level" id="education_level">
                            </div>
                            <div>
                                <label for="stages">Stages, préciser :</label>
                                <input type="text" name="internships" id="stages">
                            </div>
                            <div>
                                <label for="etablissement">Etablissement d'enseignement :</label>
                                <input type="text" name="establishment" id="etablissement">
                            </div>
                            <div>
                                <label for="end_of_studies">Durée d'étude restante :</label>
                                <input type="number" name="end_of_studies" id="end_of_studies" value="0" min="0" max="12">
                            </div>
                            <div>
                                <label for="date_of_arrival">Si vous êtes nouveau venu dans notre région, précisez votre date d'arrivée :</label>
                                <input type="date" name="date_of_arrival" id="date_of_arrival" min="<?= date('Y/m/d') ?>" > <!-- mettre la date actuelle en PHP pour min-->
                            </div>
                            <div>
                                <div class="bouton">Étape suivante</div>
                            </div>
                        </div>

                        <div id="Etudiant_etape3" class="form-group">
                            <div>
                                <h2>Mieux vous connaître</h2>
                            </div>
                            <div class="radio-group-1">
                                <label for="fumeur">Êtes-vous fumeur ?</label>
                                <div>
                                    <input type="radio" id="fumeur_oui" name="is_smoking" value="oui">
                                    <label for="fumeur_oui">Oui</label>
                                </div>
                                <div>
                                    <input type="radio" id="fumeur_non" name="is_smoking" value="non">
                                    <label for="fumeur_non">Non</label>
                                </div>

                                <label for="allergie">Avez-vous des allergies ?</label>
                                <input type="radio" id="allergie_oui" name="is_allergic" value="oui">
                                <label for="allergie_oui">Oui</label>
                                <input type="radio" id="allergie_non" name="is_allergic" value="non">
                                <label for="allergie_non">Non</label>
                            </div>
                            <div>
                                <label for="allergique">Si oui, précisé :</label>
                                <input type="search" name="allergies" id="allergique">
                            </div>
                            <div>
                                <label for="permis">Êtes-vous titulaire d'un permis de conduire ?</label>
                                <input type="radio" id="oui" name="can_drive" value="oui">
                                <label for="oui">Oui</label>
                                <input type="radio" id="non" name="can_drive" value="non">
                                <label for="non">Non</label>
                            </div>

                            <div>
                                <label for="locomotion">Si vous avez un moyen de locomotion, précisez: </label>
                                <input type="text" name="means_of_locomotion" id="locomotion">
                            </div>
                            <div>
                                <label for="centresInteret">Vos centres d'intérêts majeurs :</label>
                                <input type="text" name="interests" id="centresInteret">
                            </div>
                            <div>
                                <label for="but">Qu'est-ce qui vous pousse à rechercher la cohabitation avec une personne âgée ?</label>
                                <input type="text" name="why" id="but">
                            </div>
                            <div>
                                <div class="bouton">Étape suivante</div>
                            </div>
                        </div>

                        <div id="Etudiant_etape4">
                            <div>
                                <h2>Logement</h2>
                            </div>

                            <div class="form-group">
                                <div>
                                    <input type="radio" name="housing" id="lgmtGratuit" required>
                                    <label for="lgmtGratuit">1-logement gratuit, en échange de présence soirs et nuits.</label>
                                    <span>Vos journées sont libres. Vous êtes présent le soir à l'heure du repas excepté une soirée par semaine, deux week-ends par mois du vendredi soir au dimanche soir et trois semaines de vacances entre septembre et juin.</span>
                                </div>
                                <div>
                                    <input type="radio" name="housing" id="lgmtEco+" required>
                                    <label for="lgmtEco+">2-Logement économique, avec une participation aux frais d'usage et d'échange de services</label>
                                    <span>Vous avez du temps et de la disponibilité au cœur de votre horaire de cours pour assurer ponctuellement des services en journée (sorties, theatre, lecture,...) ainsi qu'une présence régulière. Vous versez une participation mensuelle entre 125$ et 225$, selon les services offerts et les services utilisés.</span>
                                </div>
                                <div>
                                    <input type="radio" name="housing" id="lgmtSolid" required>
                                    <label for="lgmtSolid">3-Logement solidaire, en échange de loyer et veille passive</label>
                                    <span>Vos études ne vous permettent pas de donner du temps, mais vous assurez une veille passive et des services spontanés. Vous versez une indemnité d'occupation mensuelle entre 300$ et 425$, selon les caractéristiques du logement</span>
                                </div>
                            </div>

                            <div class="form-group">
                                <div>
                                    <h3>Précision selon votre choix de logement</h3>
                                </div>
                                <div>
                                    <label for="housing_2_availabilities">Pour la formule 2, vos disponibilités :</label>
                                    <input type="text" id="housing_2_availabilities" name="housing_2_availabilities">
                                </div>
                                <div>
                                    <label for="housing_3_budget">Pour la formule 3, votre budget maximum pour le loyer</label>
                                    <input type="number" id="housing_3_budget" name="housing_3_budget" min="0">
                                </div>
                                <div>
                                    <label for="preferencesQuartier">* Si vous avez des préférences de quartier d'habitation (pour Montréal), précisez :</label>
                                    <input type="text" id="preferencesQuartier" name="preferences">
                                </div>
                            </div>

                            <div>
                                <div class="bouton">Étape suivante</div>
                            </div>
                        </div>

                        <div id="Etudiant_etape5">
                            <div>
                                <h2>Mot de passe</h2>
                            </div>
                            <div>
                                <div>
                                    <label for="password">Mot de passe :</label>
                                    <input type="password" id="password" name="password" required>
                                </div>
                                <div>
                                    <label for="password_repeat">Répéter le mot de passe :</label>
                                    <input type="password" id="password_repeat" name="password_repeat" required>
                                </div>
                            </div>
                            <div>
                                <input type="submit" class="bouton" name="registerStudent" value="Créer mon compte étudiant">
                            </div>
                        </div>
                    </form>

                    <!--<form action="" method="post">
                        <div>
                            <h1>Profil Sénior</h1>
                        </div>

                        <label for="fname">Prénom:</label>
                        <input type="text" id="fname" name="fname" autofocus required><br></br>
                        <label for="lname">Nom:</label>
                        <input type="text" id="lname" name="lname" required><br></br>
                        <label for="bdate">Date de naissance:</label>
                        <input type="date" id="bdate" name="bdate" max="2008-01-01"><br></br>

                        <div class="checkbox-group-1">
                            <label for="checkbox">Vit seul</label>
                            <input type="checkbox">
                            <label for="checkbox">En couple</label>
                            <input type="checkbox">
                            <label for="checkbox">Autres</label>
                            <input type="checkbox">
                        </div><br>

                        <label for="residence">Ville</label>
                        <input type="text" id="residence" name="residence">
                        <label for="postal">Code postal</label>
                        <input type="text" id="postal" name="postal" maxlength="5" minlength="5" title="doit comporter 5 chiffres" pattern="[0-9]{5}" required><br></br>
                        <label for="num">Numéro de telephone</label>
                        <input type="tel" id="num" name="num" placeholder="Au format 00-00-00-00-00" pattern="[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{2}" required><br><br>

                        <div class="radio-group-1">
                            <input type="radio" id="Maison" name="nature de la residence" value="Maison">
                            <label for="Maison">Maison</label>
                            <input type="radio" id="Appartement" name="nature de la residence" value="Appartement">
                            <label for="Appartement">Appartement</label>
                        </div><br>

                        <div class="radio-group-2">
                            <input type="radio" id="Propriétaire" name="type de possesion" value="Propriétaire">
                            <label for="Propriétaire">Propriétaire</label>
                            <input type="radio" id="Locataire" name="type de possesion" value="Locataire">
                            <label for="Locataire">Locataire</label>
                        </div><br>

                        <label for="mail">Adresse courriel :</label>
                        <input type="email" id="mail" name="mail" placeholder="exemple@gmail.com" required><br></br>

                        <div class="radio-group-3">
                            <label>avez-vous un animal ?</label>
                            <input type="radio" id="oui" name="animal de compagnie" value="Oui">
                            <label for="oui">Oui</label>
                            <input type="radio" id="non" name="animal de compagnie" value="non">
                            <label for="non">Non</label>
                        </div><br>

                        <div class="Select-animal">
                            <label>Si oui, choisir :</label>
                            <select name="animaux domestiques" value="">
                                <option value="aucun">Aucun</option>
                                <option value="Chien">Chien</option>
                                <option value="Chat">Chat</option>
                                <option value="Furet">Furet</option>
                                <option value="Equins">Equins (cheval, âne)</option>
                                <option value="Rongeurs">Rongeurs (gerbille, chinchilla, cochon d’inde, hamster, octodon, rat, lapin, souris, …)</option>
                                <option value="Mouton">Mouton</option>
                                <option value="Chévre">Chévre</option>
                                <option value="Oiseaux">Oiseaux (pinsons, perruche, perroquet, poule, caille, canard, tétras, kiwi, ...)</option>
                                <option value="Reptiles">Reptiles (serpent, lézard, tortue, crocodilien, ...)</option>
                                <option value="Poissons">Poissons (poissons rouges, guppy, danio, carpe koï, ...)</option>
                                <option value="Insectes">insectes</option>
                                <option value="autres">Autres</option>
                            </select>
                        </div><br>

                        <div class="radio-group-4">
                            <label>Êtes-vous fumeur ?</label>
                            <input type="radio" id="oui" name="fumeur" value="oui">
                            <label for="oui">Oui</label>
                            <input type="radio" id="non" name="fumeur" value="non">
                            <label for="non">Non</label>
                        </div><br>

                        <div>
                            <label for="distanceTransport">Transport en commun les plus proches (distance en Km) :</label>
                            <input type="number" id="distanceTransport" name="distanceTransport" min="0" max="99" value="0" >
                        </div><br>

                        <div class="checkbox-group-2">
                            <label>Comment avez-vous connu notre association ?</label><br>
                            <label for="checkbox">Bouche/oreille</label>
                            <input type="checkbox">
                            <label for="checkbox">journaux</label>
                            <input type="checkbox">
                            <label for="checkbox">internet</label>
                            <input type="checkbox">
                        </div><br>

                        <div>
                            <label for="notoriéter">Autres :</label>
                            <input type="text" id="notoriéter" name="notoriéter">
                        </div>

                        <div>
                            <h2>Nature des services ou présence</h2>
                        </div>
                        <div>
                            <label for="textBesion">Votre besoin :</label><br>
                            <textarea class="textarea-1" id="textBesion"></textarea>
                        </div>
                        <div class="checkbox-group-3">
                            <label for="checkbox">initiation informatique</label>
                            <input type="checkbox">
                            <label for="checkbox">langue étrangère</label>
                            <input type="checkbox">
                        </div>

                        <div>
                            <h2>Logement</h2>
                        </div>
                        <div class="checkbox-group-4">
                            <input type="checkbox">
                            <label for="checkbox">1 - Logement gratuit, en échange de présence soirs et nuits.</label><br><br>
                            <input type="checkbox">
                            <label for="checkbox">2 - Logement économique, avec une participation aux frais d'usage et d'échange de services.</label><br><br>
                            <input type="checkbox">
                            <label for="checkbox">3 - Logement solidaire, en échange de loyer et veille passive.</label>
                        </div><br>
                        <div class="radio-group-5">
                            <label for="vacances été">L'étudiant peut-il demeurer pendant la session d'été ?</label><br><br>
                            <label for="oui_ete">Oui</label>
                            <input type="radio" id="oui_ete" name="vacances été" value="Oui">
                            <label for="non_ete">Non</label>
                            <input type="radio" id="non_ete" name="vacances été" value="non">
                        </div><br>

                        <div>
                            <h2>Mieux vous connaître</h2>
                        </div>
                        <!--textarea pas forcement nécessaire pour certain->
                        <div class="textarea-group-1">
                            <label for="textInteret">Vos centres d'intérêts :</label><br>
                            <textarea id="textInteret"></textarea><br>
                            <label for="textPassion">Votre passion à partager :</label><br>
                            <textarea id="textPassion"></textarea><br>
                            <label for="textProfession">Avez-vous exercé une profession ? Si oui, laquelle ?</label><br>
                            <textarea id="textProfession"></textarea><br>
                            <label for="textCohabitation">Qu'est-ce qui vous pousse à rechercher la cohabitation avec un étudiant ?</label><br>
                            <textarea id="textCohabitation"></textarea><br>
                            <label for="textAvantage">Quel avantage aurait un étudiant à cohabiter avec vous ?</label><br>
                            <textarea id="textAvantage"></textarea>
                        </div>

                        <div>
                            <h2>Votre entourage</h2>
                        </div>
                        <div class="radio-group-6">
                            <label for="enfants">Avez-vous des enfants ?</label>
                            <label for="oui_enfants">oui</label>
                            <input type="radio" id="oui_enfants" name="enfants" value="oui_enfants">
                            <label for="non_enfants">non</label>
                            <input type="radio" id="non_enfants" name="enfants" value="non_enfants"><br>

                            <label for="enfants++">Des petits enfants :</label>
                            <label for="oui_enfants++">oui</label>
                            <input type="radio" id="oui_enfants++" name="enfants++" value="oui_enfants++">
                            <label for="non_enfants++">non</label>
                            <input type="radio" id="non_enfants++" name="enfants++" value="non_enfants++"><br>

                            <label for="Presence_fml">Famille très présente</label>
                            <input type="radio" id="Presence_fml" name="Presence_fml" value="trés">
                            <label for="presence">Présente</label>
                            <input type="radio" id="presence" name="Presence_fml" value="Présente">
                            <label for="peu">Peu présente</label>
                            <input type="radio" id="peu" name="Presence_fml" value="Peu">
                        </div>
                        <div>
                            <label for="textFamille">Votre famille est-elle en accord avec votre décision ?</label><br>
                            <textarea id="textFamille"></textarea> <!--Pourquoi c'est textarea pour une question fermer (remplacer par radio oui non) ->
                        </div>

                        <div>
                            <h2>Caractéristique de la chambre</h2>
                        </div>

                        <div>
                            <label for="Surface">Surface de la chambre :</label>
                            <input type="number" name="Surface" id="Surface" value="5" min="5" max="99">
                            <label for="Surface">m²</label>
                        </div><br>

                        <div class="radio-group-7">
                            <label for="Meubles">Meublée :</label>
                            <label for="oui_Meubles">oui</label>
                            <input type="radio" id="oui_Meubles" name="Meubles" value="oui_Meubles">
                            <label for="non_Meubles">non</label>
                            <input type="radio" id="non_Meubles" name="Meubles" value="non_Meubles"><br><br>

                            <label for="lavage">Appareils pour lavage disponible ?</label>
                            <label for="oui_lavage">oui</label>
                            <input type="radio" id="oui_lavage" name="lavage" value="oui_lavage">
                            <label for="non_lavage">non</label>
                            <input type="radio" id="non_lavage" name="lavage" value="non_lavage"><br><br>

                            <label for="internet">Internet disponible ?</label>
                            <label for="oui_internet">oui</label>
                            <input type="radio" id="oui_internet" name="internet" value="oui_internet">
                            <label for="non_internet">non</label>
                            <input type="radio" id="non_internet" name="internet" value="non_internet"><br><br>
                        </div>

                        <div>
                            <input type="reset" value="Effacer" class="btn">
                            <input type="submit" value="Valider" class="btn">
                        </div>
                    </div>
                    -->
                </div>
            </div>
        </section>
    </main>


<?php $content = ob_get_clean(); ?>
<?php require('layout.php'); ?>