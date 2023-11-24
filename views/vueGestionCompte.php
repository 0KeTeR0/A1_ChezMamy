<?php include('menuBackoffice.php'); ?>
<section class="main_content">
    <?php include('message.php'); ?>
    <div class="contactBox">
        <h2 class="section-title"><?= $traductions['titre_page_gerer_compte'] ?></h2>
        <div class="tableau">
            <table class="styled-tab">
                <thead>
                    <tr>
                        <th>#</th>
                        <th><?= $traductions['gérer_compte_tab_header_identité'] ?></th>
                        <th><?= $traductions['gérer_compte_tab_header_type'] ?></th>
                        <th><?= $traductions['gérer_compte_tab_header_role'] ?></th>
                        <th><?= $traductions['gérer_compte_tab_header_etat'] ?></th>
                        <th><?= $traductions['gérer_compte_tab_header_action'] ?></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($utilisateurs as $objet): ?>
                    <tr>
                        <td class="idUserTab"><strong> <?= $objet['utilisateur']->getIdUtilisateur() ?> </strong></td>
                        <td class="nomPrenomUserTab"><?= $objet['infosUtilisateur']->getPrenom()." ".$objet['infosUtilisateur']->getNom() ?></td>
                        <td class="typeUserTab">
                            <?php if($objet['isSenior']) echo $traductions['juste_Senior'];
                                else if($objet['isEtudiant']) echo $traductions['juste_Etudiant'];
                            ?>
                        </td>
                        <td class="roleUserTab">
                            <?php if($objet['role'] == "utilisateur") echo $traductions['juste_role_utilisateur'];
                            else if($objet['role'] == "moderateur") echo $traductions['juste_role_moderateur'];
                            else if($objet['role'] == "admin") echo $traductions['juste_role_administrateur'];
                            else echo $objet['role'];
                            ?>
                        </td>
                        <?php if($objet['bloque']): ?>
                            <td class="estBloquerUserTab"><strong><?= $traductions['gérer_compte_tab_bloqué'] ?></strong></td>
                            <td class="estPasBloquerUserTabAction">
                                <form action="" method="post">
                                    <?php if($objet['isAdmin']): ?>
                                        <?php if($objet['role'] == "utilisateur"): ?>
                                            <button class="tabFormPasserModoButton"><?= $traductions['gérer_compte_tab_form_passer_mod'] ?></button>
                                            <input type="hidden" name="idUserPasserModo" value="<?=$objet['utilisateur']->getIdUtilisateur() ?>">
                                        <?php elseif ($objet['role'] == "moderateur"): ?>
                                            <button class="tabFormPasserUtilisateurButton"><?= $traductions['gérer_compte_tab_form_passer_utilisateur'] ?></button>
                                            <input type="hidden" name="idUserPasserUtilisateur value="<?=$objet['utilisateur']->getIdUtilisateur() ?>">
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <button class="tabFormDebloquerButton"><?= $traductions['gérer_compte_tab_form_debloquer'] ?></button>
                                    <input type="hidden" name="idUserADebloquer" value="<?=$objet['utilisateur']->getIdUtilisateur() ?>">
                                </form>
                            </td>
                        <?php else: ?>
                            <td class="estPasBloquerUserTab"><?= $traductions['gérer_compte_tab_pas_bloqué'] ?></td>
                            <td class="estBloquerUserTabAction">
                                <form action="" method="post">
                                    <?php if($objet['isAdmin']): ?>
                                        <?php if($objet['role'] == "utilisateur"): ?>
                                            <button class="tabFormPasserModoButton"><?= $traductions['gérer_compte_tab_form_passer_mod'] ?></button>
                                            <input type="hidden" name="idUserPasserModo" value="<?=$objet['utilisateur']->getIdUtilisateur() ?>">
                                        <?php elseif ($objet['role'] == "moderateur"): ?>
                                            <button class="tabFormPasserUtilisateurButton"><?= $traductions['gérer_compte_tab_form_passer_utilisateur'] ?></button>
                                            <input type="hidden" name="idUserPasserUtilisateur value="<?=$objet['utilisateur']->getIdUtilisateur() ?>">
                                        <?php endif; ?>

                                    <?php endif; ?>
                                    <button class="tabFormBloquerButton"><?= $traductions['gérer_compte_tab_form_bloquer'] ?></button>
                                    <input type="hidden" name="idUserABloquer" value="<?=$objet['utilisateur']->getIdUtilisateur() ?>">
                                </form>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</section>