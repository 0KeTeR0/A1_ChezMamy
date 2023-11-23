<section class="">
    <?php include('message.php'); ?>
    <div class="contactBox">
        <h2 class="section-title"><?= $traductions['titre_page_gerer_compte'] ?></h2>
        <div class="tableau">
            <table class="tab">
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
                        <td class="idUserTab"><?= $objet['utilisateur']->getIdUtilisateur() ?></td>
                        <td class="nomPrenomUserTab"><?= $objet['infosUtilisateur']->getPrenom()." ".$objet['infosUtilisateur']->getNom() ?></td>
                        <td class="typeUserTab">
                            <?php if($objet['isSenior']) echo $traductions['juste_Senior'];
                                else if($objet['isEtudiant']) echo $traductions['juste_Etudiant'];
                                else echo "none";
                            ?>
                        </td>
                        <td class="roleUserTab">
                            <?php if($objet['role'] == "utilisateur") echo $traductions['juste_role_utilisateur'];
                            else if($objet['role'] == "moderateur") echo $traductions['juste_role_moderateur'];
                            else echo $objet['role'];
                            ?>
                        </td>
                        <?php if($objet['estBloque']): ?>
                            <td class="estBloquerUserTab"><?= $traductions['gérer_compte_tab_bloqué'] ?></td>
                            <td class="estBloquerUserTabAction">
                                <form action="" method="post">
                                    <button class="tabFormBloquer"><?= $traductions['gérer_compte_tab_form_bloquer'] ?></button>
                                </form>
                            </td>
                        <?php else: ?>
                            <td class="estPasBloquerUserTab"><?= $traductions['gérer_compte_tab_pas_bloqué'] ?></td>
                            <td class="estPasBloquerUserTabAction">
                                <form action="" method="post">
                                    <button class="tabFormDebloquer"><?= $traductions['gérer_compte_tab_form_debloquer'] ?></button>
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