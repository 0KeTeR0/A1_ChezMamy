<section class="contactForm">
    <div class="contactBox">

        <h2 class="section-title"><?=$traductions["contact_title"]?></h2>
        <div>
            <form id="contact_form" action="" method="post">
                <?php include('message.php'); ?>
                <div class="form-group">
                    <div class="form-pair">
                        <label for="prenom"><?=$traductions["contact_firstname"]?></label>
                        <input type="text" name="prenom" id="prenom" required>
                    </div>
                    <div>
                        <label for="nom"><?=$traductions["contact_lastname"]?></label>
                        <input type="text" name="nom" id="nom" required>
                    </div>
                    <div>
                        <label for="mail"><?=$traductions["contact_mail"]?></label>
                        <input type="email" name="mail" id="mail"  placeholder="exemple@gmail.com" required>
                    </div>
                    <div>
                        <label for="tel"><?=$traductions["contact_num"]?></label>
                        <input type="tel" name="tel" id="tel"  placeholder="<?=$traductions["contact_numHolder"]?>"pattern="[0-9]{10}">
                    </div>
                    <div>
                        <label for="sujet"><?=$traductions["contact_subject"]?></label>
                        <input type="text" name="sujet" id="sujet"  placeholder="<?=$traductions["contact_subjectHolder"]?>" maxlength="50" required>
                    </div>
                    <div>
                        <label for="message"><?=$traductions["contact_message"]?></label>
                        <textarea name="message" id="message" required></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" id="envoyer" class="bouton" value="<?=$traductions["contact_send"]?>">
                </div>
            </form>
        </div>
    </div>
</section>