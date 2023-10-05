<?php $title = "Page d'inscription"; ?>
<?php ob_start() ?>

    <main>
        <section id="error_message" class="alert">
            <h3><?php echo $message; ?></h3>
        </section>

        <section class="registerForm">
            <div class="registerBox">
                <div>
                    <h1 class="section-title">Création de profil</h1>
                    <small class="registerStep">Etape <span>1</span>/5</small>
                </div>
                <div>
                    <div id="registerChoice">
                        <label>Je suis...</label><br>
                        <div id="jeSuisEtudiant" class="bouton">Étudiant à la recherche d’un logement</div>
                        <div id="jeSuisSenior" class="bouton">Sénior avec un logement à partager</div>
                    </div>
                    <!-- Formulaire de création de profil étudiant -->
                    <form id="student_form" action="" method="post">
                        <div>
                            <h1>Profil Etudiant</h1>
                        </div>

                        <div id="Etudiant_etape1" class="form-group">
                            <h2>Identité</h2>
                            <div class="form-pair">
                                <label for="fname">Prénom</label>
                                <input type="text" id="fname" name="first_name" minlength="2" maxlength="40" required>
                            </div>
                            <div class="form-pair">
                                <label for="lname">Nom</label>
                                <input type="text" id="lname" name="last_name" minlength="2" maxlength="50" required>
                            </div>
                            <div class="form-pair">
                                <label for="bdate">Date de naissance</label>
                                <input type="date" id="bdate" name="date_of_birth" max="<?= ((new DateTime())->sub(new DateInterval('P18Y')))->format("Y/m/d") ?>" required>
                            </div>
                            <div class="form-pair">
                                <label for="nationalité">Nationalité</label>
                                <input type="text" name="nationality" id="nationalité" required>
                            </div>
                            <div class="form-pair">
                                <label for="num_etudiant">Téléphone</label>
                                <input type="tel" id="num_etudiant" name="phone" placeholder="Au format 0601020304" pattern="[0-9]{10}" required>
                            </div>
                            <div class="form-pair">
                                <label for="mail_etudiant">Adresse email <i>(identifiant de connexion)</i></label>
                                <input type="email" id="mail_etudiant" name="email" placeholder="exemple@gmail.com" required>
                            </div>
                            <div class="form-pair">
                                <label for="AdressePrt">Adresse des parents</label>
                                <input type="text" name="parents_address" id="AdressePrt" minlength="2" required>
                            </div>
                            <div class="form-pair">
                                <label for="residence">Ville</label>
                                <input type="text" id="residence" name="city" minlength="2" required>
                            </div>
                            <div class="form-pair">
                                <label for="postal_e">Code postal</label>
                                <input type="text" id="postal_e" name="postal_code" title="doit comporter 5 chiffres" pattern="[0-9]{5}" required>
                            </div>

                            <div class="form-pair">
                                <label for="knowAssociation">Comment avez-vous connu notre association ?</label>
                                <input type="text" id="knowAssociation" name="know_association">
                            </div>

                            <div class="form-pair">
                                <label for="motivation">Vos motivations pour choisir ce mode de logement</label>
                                <textarea name="motivation" id="motivation"></textarea>
                            </div>
                            <div>
                                <div class="bouton btn-gray registerPreviousStep">Étape précédente</div>
                                <div class="bouton registerNextStep">Étape suivante</div>
                            </div>
                        </div>

                        <div id="Etudiant_etape2" class="form-group">
                            <div>
                                <h2>Etudes / stages</h2>
                            </div>
                            <div class="form-pair">
                                <label for="education_level">Collégiale et cycle supérieur</label>
                                <input type="text" name="education_level" id="education_level" minlength="2" required>
                            </div>
                            <div class="form-pair">
                                <label for="stages">Stages, préciser</label>
                                <input type="text" name="internships" id="stages" placeholder="Aucun stage">
                            </div>
                            <div class="form-pair">
                                <label for="etablissement">Etablissement d'enseignement</label>
                                <input type="text" name="establishment" id="etablissement" minlength="2" required>
                            </div>
                            <div class="form-pair">
                                <label for="end_of_studies">Durée d'étude restante</label>
                                <input type="number" name="end_of_studies" id="end_of_studies" value="0" min="0" max="12" required>
                            </div>
                            <div class="form-pair">
                                <label for="date_of_arrival">Si vous êtes nouveau venu dans notre région, précisez votre date d'arrivée</label>
                                <input type="date" name="date_of_arrival" id="date_of_arrival" > <!-- mettre la date actuelle en PHP pour min-->
                            </div>
                            <div>
                                <div class="bouton btn-gray registerPreviousStep">Étape précédente</div>
                                <div class="bouton registerNextStep">Étape suivante</div>
                            </div>
                        </div>

                        <div id="Etudiant_etape3" class="form-group">
                            <div>
                                <h2>Mieux vous connaître</h2>
                            </div>
                            <div class="radio-group-1">
                                <div class="form-pair">
                                    <label for="fumeur">Êtes-vous fumeur ?</label>
                                    <input type="radio" id="fumeur_oui" name="is_smoking" value="oui">
                                    <label for="fumeur_oui">Oui</label>
                                    <input type="radio" id="fumeur_non" name="is_smoking" value="non" checked>
                                    <label for="fumeur_non">Non</label>
                                </div>
                                <br>
                                <div class="form-pair">
                                    <label for="allergie">Avez-vous des allergies ?</label>
                                    <input type="radio" id="allergie_oui" name="is_allergic" value="1">
                                    <label for="allergie_oui">Oui</label>
                                    <input type="radio" id="allergie_non" name="is_allergic" value="0" checked>
                                    <label for="allergie_non">Non</label>
                                </div>
                            </div>
                            <br>
                            <div class="form-pair" id="allergies_champ">
                                <label for="allergique">Précisez</label>
                                <input type="search" name="allergies" id="allergique" placeholder="Aucune allergie">
                            </div>
                            <div class="form-pair">
                                <label for="permis">Êtes-vous titulaire d'un permis de conduire ?</label>
                                <input type="radio" id="oui" name="can_drive" value="1">
                                <label for="oui">Oui</label>
                                <input type="radio" id="non" name="can_drive" value="0" checked>
                                <label for="non">Non</label>
                            </div>

                            <div class="form-pair">
                                <label for="locomotion">Si vous avez un moyen de locomotion, précisez: </label>
                                <input type="text" name="means_of_locomotion" id="locomotion">
                            </div>
                            <div class="form-pair">
                                <label for="centresInteret">Vos centres d'intérêts majeurs</label>
                                <input type="text" name="interests" id="centresInteret">
                            </div>
                            <div class="form-pair">
                                <label for="but">Qu'est-ce qui vous pousse à rechercher la cohabitation avec une personne âgée ?</label>
                                <input type="text" name="why" id="but">
                            </div>
                            <div>
                                <div class="bouton btn-gray registerPreviousStep">Étape précédente</div>
                                <div class="bouton registerNextStep">Étape suivante</div>
                            </div>
                        </div>

                        <div id="Etudiant_etape4" class="form-group">
                            <div>
                                <h2>Logement</h2>
                            </div>

                            <div>
                                <div class="form-pair">
                                    <input type="radio" name="housing" id="lgmtGratuit" value="1" checked>
                                    <label for="lgmtGratuit">1-logement gratuit, en échange de présence soirs et nuits.</label>
                                    <span>Vos journées sont libres. Vous êtes présent le soir à l'heure du repas excepté une soirée par semaine, deux week-ends par mois du vendredi soir au dimanche soir et trois semaines de vacances entre septembre et juin.</span>
                                </div>
                                <div class="form-pair">
                                    <input type="radio" name="housing" id="lgmtEco+" value="2">
                                    <label for="lgmtEco+">2-Logement économique, avec une participation aux frais d'usage et d'échange de services</label>
                                    <span>Vous avez du temps et de la disponibilité au cœur de votre horaire de cours pour assurer ponctuellement des services en journée (sorties, theatre, lecture,...) ainsi qu'une présence régulière. Vous versez une participation mensuelle entre 125$ et 225$, selon les services offerts et les services utilisés.</span>
                                </div>
                                <div class="form-pair">
                                    <input type="radio" name="housing" id="lgmtSolid" value="3">
                                    <label for="lgmtSolid">3-Logement solidaire, en échange de loyer et veille passive</label>
                                    <span>Vos études ne vous permettent pas de donner du temps, mais vous assurez une veille passive et des services spontanés. Vous versez une indemnité d'occupation mensuelle entre 300$ et 425$, selon les caractéristiques du logement</span>
                                </div>
                            </div>

                            <div>
                                <div>
                                    <h3>Précision selon votre choix de logement</h3>
                                </div>
                                <div class="form-pair" id="housing2">
                                    <label for="housing_2_availabilities">Vos disponibilités</label>
                                    <input type="text" id="housing_2_availabilities" name="housing_2_availabilities">
                                </div>
                                <div class="form-pair" id="housing3">
                                    <label for="housing_3_budget">Votre budget maximum pour le loyer</label>
                                    <input type="number" id="housing_3_budget" name="housing_3_budget" min="0">
                                </div>
                                <div class="form-pair">
                                    <label for="preferencesQuartier">* Si vous avez des préférences de quartier d'habitation (pour Montréal), précisez</label>
                                    <input type="text" id="preferencesQuartier" name="preferences">
                                </div>
                            </div>

                            <div>
                                <div class="bouton btn-gray registerPreviousStep">Étape précédente</div>
                                <div class="bouton registerNextStep">Étape suivante</div>
                            </div>
                        </div>

                        <div id="Etudiant_etape5" class="form-group">
                            <div>
                                <h2>Mot de passe</h2>
                            </div>
                            <div>
                                <div class="form-pair">
                                    <label for="password">Mot de passe</label>
                                    <input type="password" id="password" name="password" minlength="8" required>
                                </div>
                                <div class="form-pair">
                                    <label for="password_repeat">Répéter le mot de passe</label>
                                    <input type="password" id="password_repeat" name="password_repeat" minlength="8" required>
                                </div>
                            </div>
                            <div>
                                <div class="bouton btn-gray registerPreviousStep">Étape précédente</div>
                                <input type="submit" class="bouton" name="registerStudent" value="Créer mon compte étudiant">
                            </div>
                        </div>
                    </form>

                    <form id="senior_form" action="" method="post">
                        <div>
                            <h1>Profil Sénior</h1>
                        </div>

                        <div id="Senior_etape1" class="form-group" >
                            <div>
                                <h2>Identité</h2>
                            </div>
                            <div>
                                <label for="first_name">Prénom</label>
                                <input type="text" id="first_name" name="first_name" autofocus required>
                            </div>
                            <div>
                                <label for="last_name">Nom</label>
                                <input type="text" id="last_name" name="last_name" required>
                            </div>
                            <div>
                                <label for="date_of_brith">Date de naissance</label>
                                <input type="date" id="date_of_brith" name="date_of_birth" max="2008-01-01" required>
                            </div>

                            <div class="radio-group-1">
                                <div>
                                    <label for="vitSeul">Vit seul</label>
                                    <input type="radio" id="vitSeul" value="1" name="marital_status" checked>
                                </div>
                                <div>
                                    <label for="enCouple">En couple</label>
                                    <input type="radio" id="enCouple" value="2" name="marital_status">
                                </div>
                                <div>
                                    <label for="Autres">Autres</label>
                                    <input type="radio" id="Autres" value="3" name="marital_status">
                                </div>
                            </div>

                            <div>
                                <label for="city">Ville</label>
                                <input type="text" id="city" name="city">
                            </div>
                            <div>
                                <label for="postal_s">Code postal</label>
                                <input type="text" id="postal_s" name="postal_code" maxlength="5" minlength="5" title="doit comporter 5 chiffres" pattern="[0-9]{5}" required>
                            </div>
                            <div>
                                <label for="num_senior">Numéro de telephone</label>
                                <input type="tel" id="num_senior" name="phone" placeholder="Au format 0601020304" pattern="[0-9]{10}" required>
                            </div>

                            <div class="radio-group-2">
                                <div>
                                    <input type="radio" id="Maison" name="is_house" value="1">
                                    <label for="Maison">Maison</label>
                                </div>
                                <div>
                                    <input type="radio" id="Appartement" name="is_house" value="2" checked>
                                    <label for="Appartement">Appartement</label>
                                </div>
                            </div>

                            <div class="radio-group-3">
                                <div>
                                    <input type="radio" id="Propriétaire" name="is_landlord" value="1" checked>
                                    <label for="Propriétaire">Propriétaire</label>
                                </div>
                                <div>
                                    <input type="radio" id="Locataire" name="is_landlord" value="2">
                                    <label for="Locataire">Locataire</label>
                                </div>
                            </div>

                            <div>
                                <label for="mail_senior">Adresse courriel (identifiant de connexion)</label>
                                <input type="email" id="mail_senior" name="email" placeholder="exemple@gmail.com" required>
                            </div>

                            <div class="radio-group-4">
                                <label>avez-vous un animal ?</label>
                                <div>
                                    <input type="radio" id="animal_oui" name="have_animal" value="1">
                                    <label for="animal_oui">Oui</label>
                                </div>
                                <div>
                                    <input type="radio" id="animal_non" name="have_animal" value="0" checked>
                                    <label for="animal_non">Non</label>
                                </div>
                            </div>

                            <div class="Select-animal">
                                <label for="Animaux">Choisir</label>
                                <select name="animal" id="Animaux" multiple>
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
                            </div>

                            <div class="radio-group-5">
                                <label>Êtes-vous fumeur ?</label>
                                <div>
                                    <input type="radio" id="fumeur_senior_oui" name="is_smoking" value="1">
                                    <label for="fumeur_senior_oui">Oui</label>
                                </div>
                                <div>
                                    <input type="radio" id="fumeur_senior_non" name="is_smoking" value="0" checked>
                                    <label for="fumeur_senior_non">Non</label>
                                </div>
                            </div>

                            <div>
                                <label for="distanceTransport">Transport en commun les plus proches (distance en Km)</label>
                                <input type="number" id="distanceTransport" name="public_transport_distance" min="0" max="99" value="0" >
                            </div>

                            <div>
                                <div>
                                    <label for="notoriety">Comment avez-vous connu notre association ?</label>
                                    <input type="text" id="notoriety" name="know_association">
                                </div>
                            </div>

                            <div>
                                <div class="bouton btn-gray registerPreviousStep">Étape précédente</div>
                                <div class="bouton registerNextStep">Étape suivante</div>
                            </div>
                        </div>

                        <div id="Senior_etape2" class="form-group">
                            <div>
                                <h2>Nature des services ou présence</h2>
                            </div>
                            <div>
                                <label for="textBesoin">Votre besoin</label><br>
                                <textarea class="textarea-1" id="textBesoin" name="needs"></textarea>
                            </div>
                            <div>
                                <div class="bouton btn-gray registerPreviousStep">Étape précédente</div>
                                <div class="bouton registerNextStep">Étape suivante</div>
                            </div>
                        </div>

                        <div id="Senior_etape3" class="form-group">
                            <div>
                                <h2>Logement</h2>
                            </div>
                            <div class="radio-group-6">
                                <div>
                                    <input type="radio" name="housing" id="gratuit" value="1" checked>
                                    <label for="gratuit">1 - Logement gratuit, en échange de présence soirs et nuits.</label>
                                </div>
                                <div>
                                    <input type="radio" name="housing" id="economique" value="2">
                                    <label for="economique">2 - Logement économique, avec une participation aux frais d'usage et d'échange de services.</label><br><br>
                                </div>
                                <div>
                                    <input type="radio" name="housing" id="solidaire" value="3">
                                    <label for="solidaire">3 - Logement solidaire, en échange de loyer et veille passive.</label>
                                </div>

                            </div>
                            <div class="radio-group-7">
                                <label >L'étudiant peut-il demeurer pendant la session d'été ?</label>
                                <div>
                                    <label for="oui_ete">Oui</label>
                                    <input type="radio" id="oui_ete" name="can_stay_summer" value="1">
                                </div>
                                <div>
                                    <label for="non_ete">Non</label>
                                    <input type="radio" id="non_ete" name="can_stay_summer" value="0" checked>
                                </div>
                            </div>
                            <div>
                                <div class="bouton btn-gray registerPreviousStep">Étape précédente</div>
                                <div class="bouton registerNextStep">Étape suivante</div>
                            </div>
                        </div>


                        <div id="Senior_etape4" class="form-group">
                            <div>
                                <h2>Mieux vous connaître</h2>
                            </div>

                            <div class="textarea-group-1">
                                <div>
                                    <label for="textInteret">Vos centres d'intérêts :</label>
                                    <textarea id="textInteret" name="interests"></textarea>
                                </div>
                                <div>
                                    <label for="textPassion">Votre passion a partagé :</label>
                                    <textarea id="textPassion" name="passion_to_share"></textarea>
                                </div>
                                <div>
                                    <label for="textProfession">Avez-vous exercé une profession ? Si oui, laquelle ?</label>
                                    <textarea id="textProfession" name="profession"></textarea>
                                </div>
                                <div>
                                    <label for="textCohabitation">Qu'est-ce qui vous pousse à rechercher la cohabitation avec un étudiant ?</label>
                                    <textarea id="textCohabitation" name="why"></textarea>
                                </div>
                                <div>
                                    <label for="textAvantage">Quel avantage aurait un étudiant à cohabiter avec vous ?</label>
                                    <textarea id="textAvantage" name="advantages_with_you"></textarea>
                                </div>
                            </div>
                            <div>
                                <div class="bouton btn-gray registerPreviousStep">Étape précédente</div>
                                <div class="bouton registerNextStep">Étape suivante</div>
                            </div>
                        </div>

                        <div id="Senior_etape5" class="form-group">
                            <div>
                                <h2>Votre entourage</h2>
                            </div>
                            <div class="radio-group-8">
                                <label for="enfants">Avez-vous des enfants ?</label>
                                <div>
                                    <label for="oui_enfants">oui</label>
                                    <input type="radio" id="oui_enfants" name="has_kids" value="1">
                                </div>
                                <div>
                                    <label for="non_enfants">non</label>
                                    <input type="radio" id="non_enfants" name="has_kids" value="0" checked>
                                </div>
                                <div class="grand-kids">
                                    <label for="enfants++">Des petits enfants :</label>
                                </div>
                                <div class="grand-kids">
                                    <label for="oui_enfants++">oui</label>
                                    <input type="radio" id="oui_enfants++" name="has_grandkids" value="1">
                                </div>
                                <div class="grand-kids">
                                   <label for="non_enfants++">non</label>
                                   <input type="radio" id="non_enfants++" name="has_grandkids" value="0" checked>
                                </div>
                                <div>
                                    <label for="Presence_fml">Famille très présente</label>
                                    <input type="radio" id="Presence_fml" name="is_family_present" value="3">
                                </div>
                                <div>
                                    <label for="presence">Présente</label>
                                    <input type="radio" id="presence" name="is_family_present" value="2" checked>
                                </div>
                                <div>
                                    <label for="peu">Peu présente</label>
                                    <input type="radio" id="peu" name="is_family_present" value="1">
                                </div>
                            </div>
                            <div>
                                <label for="textFamille">Votre famille est-elle en accord avec votre décision ?</label><br>
                                <textarea id="textFamille" name="is_family_ok"></textarea> <!--Pourquoi c'est textarea pour une question fermer (remplacer par radio oui non) -->
                            </div>
                            <div>
                                <div class="bouton btn-gray registerPreviousStep">Étape précédente</div>
                                <div class="bouton registerNextStep">Étape suivante</div>
                            </div>
                        </div>

                        <div id="Senior_etape6" class="form-group">
                            <div>
                                <h2>Caractéristique de la chambre</h2>
                            </div>

                            <div>
                                <label for="Surface">Surface de la chambre :</label>
                                <div>
                                    <input type="number" name="room_surface" id="Surface" value="5" min="5" max="99">
                                    <label for="Surface">m²</label>
                                </div>

                            </div>

                            <div class="radio-group-9">
                                <div>
                                    <label for="Meubles">Meublée</label>
                                </div>
                                <div>
                                    <label for="oui_Meubles">oui</label>
                                    <input type="radio" id="oui_Meubles" name="has_furniture" value="1" checked>
                                </div>
                                <div>
                                    <label for="non_Meubles">non</label>
                                    <input type="radio" id="non_Meubles" name="has_furniture" value="0">
                                </div>
                                <div>
                                    <label for="lavage">Appareils pour lavage disponible ?</label>
                                </div>
                                <div>
                                    <label for="oui_lavage">oui</label>
                                    <input type="radio" id="oui_lavage" name="can_clean" value="1">
                                </div>
                               <div>
                                   <label for="non_lavage">non</label>
                                   <input type="radio" id="non_lavage" name="can_clean" value="0" checked>
                               </div>
                                <div>
                                    <label for="internet">Internet disponible ?</label>
                                </div>
                                <div>
                                    <label for="oui_internet">oui</label>
                                    <input type="radio" id="oui_internet" name="has_internet" value="1" checked>
                                </div>
                                <div>
                                    <label for="non_internet">non</label>
                                    <input type="radio" id="non_internet" name="has_internet" value="0">
                                </div>
                            </div>
                            <div>
                                <div class="bouton btn-gray registerPreviousStep">Étape précédente</div>
                                <div class="bouton registerNextStep">Étape suivante</div>
                            </div>
                        </div>


                        <div id="Senior_etape7" class="form-group">
                            <div>
                                <h2>Mot de passe</h2>
                            </div>
                            <div>
                                <div class="form-pair">
                                    <label for="password">Mot de passe</label>
                                    <input type="password" id="password" name="password" minlength="8" required>
                                </div>
                                <div class="form-pair">
                                    <label for="password_repeat">Répéter le mot de passe</label>
                                    <input type="password" id="password_repeat" name="password_repeat" minlength="8" required>
                                </div>
                            </div>
                            <div>
                                <div class="bouton btn-gray registerPreviousStep">Étape précédente</div>
                                <input type="submit" class="bouton" name="registerSenior" value="Créer mon compte sénior">
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </section>
    </main>
    <script src="../assets/js/register.js"></script>


<?php $content = ob_get_clean(); ?>
<?php require('layout.php'); ?>