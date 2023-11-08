<section class="registerForm">
    <?php include('message.php'); ?>
    <div class="registerBox">
        <div>
            <h1 class="section-title"><?= $traductions['register_title'] ?></h1>
            <small class="registerStep"><?= $traductions['register_step'] ?> <span>1</span>/5</small>
        </div>
        <div>
            <div id="registerChoice">
                <label><?= $traductions['register_type_p'] ?></label><br>
                <div id="jeSuisEtudiant" class="bouton"><?= $traductions['register_type_student'] ?></div>
                <div id="jeSuisSenior" class="bouton"><?= $traductions['register_type_senior'] ?></div>
            </div>
            <!-- Formulaire de création de profil étudiant -->
            <form id="student_form" action="" method="post">
                <div>
                    <h1><?= $traductions['register_student_title'] ?></h1>
                </div>
                <input type="hidden" name="typeCompte" value="etudiant">
                <div id="Etudiant_etape1" class="form-group">
                    <h2><?= $traductions['register_student_category1'] ?></h2>
                    <div class="form-pair">
                        <label for="fname"><?= $traductions['register_student_firstname'] ?></label>
                        <input type="text" id="fname" name="first_name" minlength="2" maxlength="40" required>
                    </div>
                    <div class="form-pair">
                        <label for="lname"><?= $traductions['register_student_lastname'] ?></label>
                        <input type="text" id="lname" name="last_name" minlength="2" maxlength="50" required>
                    </div>
                    <div class="form-pair">
                        <label for="bdate"><?= $traductions['register_student_birthdate'] ?></label>
                        <input type="date" id="bdate" name="date_of_birth" max="<?= ((new DateTime())->sub(new DateInterval('P18Y')))->format("Y/m/d") ?>" required>
                    </div>
                    <div class="form-pair">
                        <label for="nationalité"><?= $traductions['register_student_nationality'] ?></label>
                        <input type="text" name="nationality" id="nationalité" required>
                    </div>
                    <div class="form-pair">
                        <label for="num_etudiant"><?= $traductions['register_student_phone'] ?></label>
                        <input type="tel" id="num_etudiant" name="phone" placeholder="<?= $traductions['register_student_phone_placeholder'] ?> 0601020304" pattern="[0-9]{10}">
                    </div>
                    <div class="form-pair">
                        <label for="mail_etudiant"><?= $traductions['register_student_email'] ?></label>
                        <input type="email" id="mail_etudiant" name="email" placeholder="exemple@gmail.com">
                    </div>
                    <div class="form-pair">
                        <label for="residence"><?= $traductions['register_student_city'] ?></label>
                        <input type="text" id="residence" name="city" minlength="2" required>
                    </div>
                    <div class="form-pair">
                        <label for="postal_e"><?= $traductions['register_student_postal_code'] ?></label>
                        <input type="text" id="postal_e" name="postal_code" title="<?= $traductions['register_student_postal_code_placeholder'] ?>" pattern="[0-9]{5}" required>
                    </div>

                    <div class="form-pair">
                        <label for="notoriety"><?= $traductions['register_student_know'] ?></label>
                        <select id="notoriety" name="know_association">
                            <?php
                            foreach($option_connaissances as $objet){
                                echo "<option value=\""
                                    .$objet->getIdConnaissanceAssociation()
                                    ."\">".$objet->getMoyen()
                                    ."</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-pair">
                        <label for="motivation"><?= $traductions['register_student_motivations'] ?></label>
                        <textarea name="motivation" id="motivation"></textarea>
                    </div>
                    <div>
                        <div class="bouton btn-gray registerPreviousStep"><?= $traductions['register_prev_step'] ?></div>
                        <div class="bouton registerNextStep"><?= $traductions['register_next_step'] ?></div>
                    </div>
                </div>

                <div id="Etudiant_etape2" class="form-group">
                    <div>
                        <h2><?= $traductions['register_student_category2'] ?></h2>
                    </div>
                    <div class="form-pair">
                        <label for="idDomaineEtude"><?= $traductions['register_student_domain'] ?></label>
                        <select name="idDomaineEtude" id="idDomaineEtude">
                            <?php
                            foreach($EdomaineEtudes as $objet){
                                echo "<option value=\""
                                    .$objet->getIdDomaineEtude()
                                    ."\">".$objet->getDomaine()
                                    ."</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-pair">
                        <label for="education_level"><?= $traductions['register_student_studies_lvl'] ?></label>
                        <input type="number" name="education_level" id="education_level" min="2" max="100" required>
                    </div>
                    <div class="form-pair">
                        <label for="stages"><?= $traductions['register_student_internships'] ?></label>
                        <input type="text" name="internships" id="stages" placeholder="<?= $traductions['register_student_internships_placeholder'] ?>">
                    </div>
                    <div class="form-pair">
                        <label for="etablissement"><?= $traductions['register_student_school'] ?></label>
                        <input type="text" name="establishment" id="etablissement" minlength="2" required>
                    </div>
                    <div class="form-pair">
                        <label for="end_of_studies"><?= $traductions['register_student_years'] ?></label>
                        <input type="number" name="end_of_studies" id="end_of_studies" value="0" min="0" max="12" required>
                    </div>
                    <div class="form-pair">
                        <label for="date_of_arrival"><?= $traductions['register_student_foreign'] ?></label>
                        <input type="date" name="date_of_arrival" id="date_of_arrival" > <!-- mettre la date actuelle en PHP pour min-->
                    </div>
                    <div>
                        <div class="bouton btn-gray registerPreviousStep"><?= $traductions['register_prev_step'] ?></div>
                        <div class="bouton registerNextStep"><?= $traductions['register_next_step'] ?></div>
                    </div>
                </div>

                <div id="Etudiant_etape3" class="form-group">
                    <div>
                        <h2><?= $traductions['register_student_category3'] ?></h2>
                    </div>
                    <div class="radio-group-1">
                        <div class="form-pair">
                            <label for="fumeur"><?= $traductions['register_student_smoker'] ?></label>
                            <input type="radio" id="fumeur_oui" name="is_smoking" value="1">
                            <label for="fumeur_oui"><?= $traductions['register_yes'] ?></label>
                            <input type="radio" id="fumeur_non" name="is_smoking" value="0" checked>
                            <label for="fumeur_non"><?= $traductions['register_no'] ?></label>
                        </div>
                        <div class="form-pair">
                            <label for="allergie"><?= $traductions['register_student_allergy'] ?></label>
                            <input type="radio" id="allergie_oui" name="is_allergic" value="1">
                            <label for="allergie_oui"><?= $traductions['register_yes'] ?></label>
                            <input type="radio" id="allergie_non" name="is_allergic" value="0" checked>
                            <label for="allergie_non"><?= $traductions['register_no'] ?></label>
                        </div>
                    </div>
                    <div class="form-pair" id="allergies_champ">
                        <label for="allergique"><?= $traductions['register_student_precise'] ?></label>
                        <input type="search" name="allergies" id="allergique" placeholder="<?= $traductions['register_student_precise_placeholder'] ?>">
                    </div>
                    <div class="form-pair">
                        <label for="permis"><?= $traductions['register_student_licence'] ?></label>
                        <input type="radio" id="oui" name="can_drive" value="1">
                        <label for="oui"><?= $traductions['register_yes'] ?></label>
                        <input type="radio" id="non" name="can_drive" value="0" checked>
                        <label for="non"><?= $traductions['register_no'] ?></label>
                    </div>

                    <div class="form-pair">
                        <label for="locomotion"><?= $traductions['register_student_locomotion'] ?></label>
                        <input type="text" name="means_of_locomotion" id="locomotion">
                    </div>
                    <div class="form-pair">
                        <label for="centresInteret"><?= $traductions['register_student_interests'] ?></label>
                        <input type="text" name="interests" id="centresInteret">
                    </div>
                    <div class="form-pair">
                        <label for="but"><?= $traductions['register_student_why'] ?></label>
                        <input type="text" name="why" id="but">
                    </div>
                    <div>
                        <div class="bouton btn-gray registerPreviousStep"><?= $traductions['register_prev_step'] ?></div>
                        <div class="bouton registerNextStep"><?= $traductions['register_next_step'] ?></div>
                    </div>
                </div>

                <div id="Etudiant_etape4" class="form-group">
                    <div>
                        <h2><?= $traductions['register_student_category4'] ?></h2>
                    </div>

                    <div>
                        <label for="housing"><?= $traductions['register_student_room_type'] ?></label>
                        <select name="housing" id="housing">
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

                    <div>
                        <div>
                            <h3><?= $traductions['register_student_subcategory1'] ?></h3>
                        </div>
                        <div class="form-pair" id="housing2">
                            <label for="housing_2_availabilities"><?= $traductions['register_student_availability'] ?></label>
                            <div class="form-pair">
                                <label for="housing2_start"><?= $traductions['register_student_begin'] ?></label>
                                <input type="time" id="housing2_start" name="housing2_start" required>
                            </div>
                            <div class="form-pair">
                                <label for="housing2_end"><?= $traductions['register_student_end'] ?></label>
                                <input type="time" id="housing2_end" name="housing2_end" required>
                            </div>
                        </div>
                        <div class="form-pair" id="housing3">
                            <label for="housing_3_budget"><?= $traductions['register_student_budget'] ?></label>
                            <input type="number" id="housing_3_budget" name="housing_3_budget" min="0" value="0" required>
                        </div>
                    </div>

                    <div>
                        <div class="bouton btn-gray registerPreviousStep"><?= $traductions['register_prev_step'] ?></div>
                        <div class="bouton registerNextStep"><?= $traductions['register_next_step'] ?></div>
                    </div>
                </div>

                <div id="Etudiant_etape5" class="form-group">
                    <div>
                        <h2><?= $traductions['register_student_category5'] ?></h2>
                    </div>
                    <div>
                        <div class="form-pair">
                            <label for="flogin"><?= $traductions['register_student_login'] ?></label>
                            <input type="text" id="flogin" name="login" minlength="2" maxlength="80" required>
                        </div>
                        <div class="form-pair">
                            <label for="password"><?= $traductions['register_student_password'] ?></label>
                            <input type="password" id="password" name="password" minlength="8" required>
                        </div>
                        <div class="form-pair">
                            <label for="password_repeat"><?= $traductions['register_student_password_repeat'] ?></label>
                            <input type="password" id="password_repeat" name="password_repeat" minlength="8" required>
                        </div>
                    </div>
                    <div>
                        <div class="bouton btn-gray registerPreviousStep"><?= $traductions['register_prev_step'] ?></div>
                        <input type="submit" class="bouton" name="registerStudent" value="<?= $traductions['register_student_create'] ?>">
                    </div>
                </div>
            </form>

            <form id="senior_form" action="" method="post">
                <div>
                    <h1><?= $traductions['register_senior_title'] ?></h1>
                </div>

                <input type="hidden" name="typeCompte" value="senior">
                <div id="Senior_etape1" class="form-group" >
                    <div>
                        <h2><?= $traductions['register_senior_category1'] ?></h2>
                    </div>
                    <div class="form-pair">
                        <label for="first_name"><?= $traductions['register_senior_firstname'] ?></label>
                        <input type="text" id="first_name" name="first_name" autofocus required>
                    </div>
                    <div class="form-pair">
                        <label for="last_name"><?= $traductions['register_senior_lastname'] ?></label>
                        <input type="text" id="last_name" name="last_name" required>
                    </div>
                    <div class="form-pair">
                        <label for="date_of_brith"><?= $traductions['register_senior_birthdate'] ?></label>
                        <input type="date" id="date_of_brith" name="date_of_birth" max="2008-01-01" required>
                    </div>

                    <div class="form-pair">
                        <label for="marital_status"><?= $traductions['register_senior_living'] ?></label>
                        <select name="marital_status" id="marital_status">
                            <?php
                            foreach($SSistuation as $objet){
                                echo "<option value=\""
                                    .$objet->getIdSituation()
                                    ."\">".$objet->getType()
                                    ."</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-pair">
                        <label for="city"><?= $traductions['register_senior_city'] ?></label>
                        <input type="text" id="city" name="city" required>
                    </div>
                    <div class="form-pair">
                        <label for="postal_s"><?= $traductions['register_senior_postal_code'] ?></label>
                        <input type="text" id="postal_s" name="postal_code" maxlength="5" minlength="5" title="<?= $traductions['register_senior_postal_code_placeholder'] ?>" pattern="[0-9]{5}" required>
                    </div>
                    <div class="form-pair">
                        <label for="num_senior"><?= $traductions['register_senior_phone'] ?></label>
                        <input type="tel" id="num_senior" name="phone" placeholder="<?= $traductions['register_senior_phone_placeholder'] ?> 0601020304" pattern="[0-9]{10}">
                    </div>
                    <div class="form-pair">
                        <label for="mail_senior"><?= $traductions['register_senior_email'] ?></label>
                        <input type="email" id="mail_senior" name="email" placeholder="exemple@gmail.com">
                    </div>

                    <div class="radio-group-2">
                        <label for="is_house"><?= $traductions['register_senior_house_type'] ?></label>
                        <select name="is_house" id="is_house">
                            <?php
                            foreach($SLogement as $objet){
                                echo "<option value=\""
                                    .$objet->getIdLogement()
                                    ."\">".$objet->getType()
                                    ."</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-pair">
                        <label for="is_landlord"><?= $traductions['register_senior_owner'] ?></label>
                        <select name="is_landlord" id="is_landlord">
                            <?php
                            foreach($SProprietes as $objet){
                                echo "<option value=\""
                                    .$objet->getIdPropriete()
                                    ."\">".$objet->getType()
                                    ."</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-pair Select-animal">
                        <label for="Animaux"><?= $traductions['register_senior_pets'] ?></label>
                        <select name="animal[]" id="Animaux" multiple>
                            <option value="Chien"><?= $traductions['register_senior_pets1'] ?></option>
                            <option value="Chat"><?= $traductions['register_senior_pets2'] ?></option>
                            <option value="Furet"><?= $traductions['register_senior_pets3'] ?></option>
                            <option value="Equins"><?= $traductions['register_senior_pets4'] ?></option>
                            <option value="Rongeurs"><?= $traductions['register_senior_pets5'] ?></option>
                            <option value="Mouton"><?= $traductions['register_senior_pets6'] ?></option>
                            <option value="Chévre"><?= $traductions['register_senior_pets7'] ?></option>
                            <option value="Oiseaux"><?= $traductions['register_senior_pets8'] ?></option>
                            <option value="Reptiles"><?= $traductions['register_senior_pets9'] ?></option>
                            <option value="Poissons"><?= $traductions['register_senior_pets10'] ?></option>
                            <option value="Insectes"><?= $traductions['register_senior_pets11'] ?></option>
                            <option value="autres"><?= $traductions['register_senior_pets12'] ?></option>
                        </select>
                    </div>

                    <div class="form-pair radio-group-5">
                        <label><?= $traductions['register_senior_smoker'] ?></label>
                        <div>
                            <input type="radio" id="fumeur_senior_oui" name="is_smoking" value="1">
                            <label for="fumeur_senior_oui"><?= $traductions['register_yes'] ?></label>
                        </div>
                        <div>
                            <input type="radio" id="fumeur_senior_non" name="is_smoking" value="0" checked>
                            <label for="fumeur_senior_non"><?= $traductions['register_no'] ?></label>
                        </div>
                    </div>

                    <div class="form-pair">
                        <label for="distanceTransport"><?= $traductions['register_senior_public_transport'] ?></label>
                        <input type="number" id="distanceTransport" name="public_transport_distance" min="0" value="0" >
                    </div>

                    <div class="form-pair">
                        <div>
                            <label for="notoriety"><?= $traductions['register_senior_know'] ?></label>
                            <select id="notoriety" name="know_association">
                                <?php
                                foreach($option_connaissances as $objet){
                                    echo "<option value=\""
                                        .$objet->getIdConnaissanceAssociation()
                                        ."\">".$objet->getMoyen()
                                        ."</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div>
                        <div class="bouton btn-gray registerPreviousStep"><?= $traductions['register_prev_step'] ?></div>
                        <div class="bouton registerNextStep"><?= $traductions['register_next_step'] ?></div>
                    </div>
                </div>

                <div id="Senior_etape2" class="form-group">
                    <div>
                        <h2><?= $traductions['register_senior_category2'] ?></h2>
                    </div>
                    <div class="form-pair">
                        <label for="needs"><?= $traductions['register_senior_needs'] ?></label>
                        <select name="needs[]" id="needs" multiple>
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
                        <div class="bouton btn-gray registerPreviousStep"><?= $traductions['register_prev_step'] ?></div>
                        <div class="bouton registerNextStep"><?= $traductions['register_next_step'] ?></div>
                    </div>
                </div>

                <div id="Senior_etape3" class="form-group">
                    <div>
                        <h2><?= $traductions['register_senior_category3'] ?></h2>
                    </div>
                    <div class="form-pair radio-group-6">
                        <label for="housing"><?= $traductions['register_senior_room_type'] ?></label>
                        <select name="housing" id="housing">
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
                    <div class="form-pair radio-group-7">
                        <label><?= $traductions['register_senior_summer'] ?></label>
                        <div>
                            <input type="radio" id="oui_ete" name="can_stay_summer" value="1">
                            <label for="oui_ete"><?= $traductions['register_yes'] ?></label>
                        </div>
                        <div>
                            <input type="radio" id="non_ete" name="can_stay_summer" value="0" checked>
                            <label for="non_ete"><?= $traductions['register_no'] ?></label>
                        </div>
                    </div>
                    <div>
                        <div class="bouton btn-gray registerPreviousStep"><?= $traductions['register_prev_step'] ?></div>
                        <div class="bouton registerNextStep"><?= $traductions['register_next_step'] ?></div>
                    </div>
                </div>


                <div id="Senior_etape4" class="form-group">
                    <div>
                        <h2><?= $traductions['register_senior_category4'] ?></h2>
                    </div>

                    <div class="textarea-group-1">
                        <div class="form-pair">
                            <label for="textInteret"><?= $traductions['register_senior_interests'] ?></label>
                            <textarea id="textInteret" name="interests"></textarea>
                        </div>
                        <div class="form-pair">
                            <label for="textPassion"><?= $traductions['register_senior_passion'] ?></label>
                            <textarea id="textPassion" name="passion_to_share"></textarea>
                        </div>
                        <div class="form-pair">
                            <label for="textProfession"><?= $traductions['register_senior_professional'] ?></label>
                            <textarea id="textProfession" name="profession"></textarea>
                        </div>
                        <div class="form-pair">
                            <label for="textCohabitation"><?= $traductions['register_senior_why'] ?></label>
                            <textarea id="textCohabitation" name="why"></textarea>
                        </div>
                        <div class="form-pair">
                            <label for="textAvantage"><?= $traductions['register_senior_advantages'] ?></label>
                            <textarea id="textAvantage" name="advantages_with_you"></textarea>
                        </div>
                    </div>
                    <div>
                        <div class="bouton btn-gray registerPreviousStep"><?= $traductions['register_prev_step'] ?></div>
                        <div class="bouton registerNextStep"><?= $traductions['register_next_step'] ?></div>
                    </div>
                </div>

                <div id="Senior_etape5" class="form-group">
                    <div>
                        <h2><?= $traductions['register_senior_category5'] ?></h2>
                    </div>
                    <div class="form-pair radio-group-8">
                        <label for="enfants"><?= $traductions['register_senior_kids'] ?></label>
                        <div class="form-pair">
                            <input type="radio" id="oui_enfants" name="has_kids" value="1">
                            <label for="oui_enfants"><?= $traductions['register_yes'] ?></label>
                        </div>
                        <div class="form-pair">
                            <input type="radio" id="non_enfants" name="has_kids" value="0" checked>
                            <label for="non_enfants"><?= $traductions['register_no'] ?></label>
                        </div>
                        <label class="grand-kids"><?= $traductions['register_senior_grandkids'] ?></label>
                        <div class="form-pair grand-kids">
                            <input type="radio" id="oui_enfants++" name="has_grandkids" value="1">
                            <label for="oui_enfants++"><?= $traductions['register_yes'] ?></label>
                        </div>
                        <div class="form-pair grand-kids">
                            <input type="radio" id="non_enfants++" name="has_grandkids" value="0" checked>
                            <label for="non_enfants++"><?= $traductions['register_no'] ?></label>
                        </div>
                        <div class="form-pair">
                            <label for="is_family_present"><?= $traductions['register_senior_family_presence'] ?></label>
                            <select name="is_family_present" id="is_family_present">
                                <?php
                                foreach($SPresenceFamilles as $objet){
                                    echo "<option value=\""
                                        .$objet->getIdFamillePresente()
                                        ."\">".$objet->getType()
                                        ."</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-pair">
                        <label for="textFamille"><?= $traductions['register_senior_family_agreement'] ?></label>
                        <div class="form-pair">
                            <input type="radio" id="non_accord" name="is_family_ok" value="1" checked>
                            <label for="non_accord"><?= $traductions['register_yes'] ?></label>
                        </div>
                        <div class="form-pair">
                            <input type="radio" id="oui_accord" name="is_family_ok" value="0">
                            <label for="oui_accord"><?= $traductions['register_no'] ?></label>
                        </div>
                    </div>
                    <div>
                        <div class="bouton btn-gray registerPreviousStep"><?= $traductions['register_prev_step'] ?></div>
                        <div class="bouton registerNextStep"><?= $traductions['register_next_step'] ?></div>
                    </div>
                </div>

                <div id="Senior_etape6" class="form-group">
                    <div>
                        <h2><?= $traductions['register_senior_category6'] ?></h2>
                    </div>

                    <div class="form-pair">
                        <label for="Surface"><?= $traductions['register_senior_room_size'] ?></label>
                        <div class="form-pair">
                            <input type="number" name="room_surface" id="Surface" value="9" min="9" max="99">
                        </div>

                    </div>

                    <div class="form-pair radio-group-9">
                        <div>
                            <label for="Meubles"><?= $traductions['register_senior_room_furnished'] ?></label>
                        </div>
                        <div class="form-pair">
                            <label for="oui_Meubles"><?= $traductions['register_yes'] ?></label>
                            <input type="radio" id="oui_Meubles" name="has_furniture" value="1" checked>
                        </div>
                        <div class="form-pair">
                            <label for="non_Meubles"><?= $traductions['register_no'] ?></label>
                            <input type="radio" id="non_Meubles" name="has_furniture" value="0">
                        </div>
                        <div>
                            <label for="lavage"><?= $traductions['register_senior_room_equipment'] ?></label>
                        </div>
                        <div class="form-pair">
                            <label for="oui_lavage"><?= $traductions['register_yes'] ?></label>
                            <input type="radio" id="oui_lavage" name="can_clean" value="1">
                        </div>
                        <div class="form-pair">
                            <label for="non_lavage"><?= $traductions['register_no'] ?></label>
                            <input type="radio" id="non_lavage" name="can_clean" value="0" checked>
                        </div>
                        <div>
                            <label for="internet"><?= $traductions['register_senior_internet'] ?></label>
                        </div>
                        <div class="form-pair">
                            <label for="oui_internet"><?= $traductions['register_yes'] ?></label>
                            <input type="radio" id="oui_internet" name="has_internet" value="1" checked>
                        </div>
                        <div class="form-pair">
                            <label for="non_internet"><?= $traductions['register_no'] ?></label>
                            <input type="radio" id="non_internet" name="has_internet" value="0">
                        </div>
                    </div>
                    <div>
                        <div class="bouton btn-gray registerPreviousStep"><?= $traductions['register_prev_step'] ?></div>
                        <div class="bouton registerNextStep"><?= $traductions['register_next_step'] ?></div>
                    </div>
                </div>


                <div id="Senior_etape7" class="form-group">
                    <div>
                        <h2><?= $traductions['register_senior_category7'] ?></h2>
                    </div>
                    <div>
                        <div class="form-pair">
                            <label for="flogin"><?= $traductions['register_senior_login'] ?></label>
                            <input type="text" id="flogin" name="login" minlength="2" maxlength="80" required>
                        </div>
                        <div class="form-pair">
                            <label for="password"><?= $traductions['register_senior_password'] ?></label>
                            <input type="password" id="password" name="password" minlength="8" required>
                        </div>
                        <div class="form-pair">
                            <label for="password_repeat"><?= $traductions['register_senior_password_repeat'] ?></label>
                            <input type="password" id="password_repeat" name="password_repeat" minlength="8" required>
                        </div>
                    </div>
                    <div>
                        <div class="bouton btn-gray registerPreviousStep"><?= $traductions['register_prev_step'] ?></div>
                        <input type="submit" class="bouton" value="<?= $traductions['register_senior_create'] ?>">
                    </div>
                </div>

            </form>
        </div>
    </div>
</section>

<script src="<?= SCRIPTS ?>js/register.js"></script>