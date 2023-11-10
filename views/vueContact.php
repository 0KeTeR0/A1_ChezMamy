<section class="contactForm">
    <div class="contactBox">

        <h2 class="section-title">Nous Contacter</h2>
        <div>
            <form id="contact_form" action="" method="post">
                <?php include('message.php'); ?>
                <div class="form-group">
                    <div class="form-pair">
                        <label for="prenom">Prénom</label>
                        <input type="text" name="prenom" id="prenom" required>
                    </div>
                    <div>
                        <label for="nom">Nom</label>
                        <input type="text" name="nom" id="nom" required>
                    </div>
                    <div>
                        <label for="mail">Adresse email</label>
                        <input type="email" name="mail" id="mail"  placeholder="exemple@gmail.com" required>
                    </div>
                    <div>
                        <label for="tel">Numéro de téléphone <i>(facultatif)</i></label>
                        <input type="tel" name="tel" id="tel"  placeholder="Au format 0601020304"pattern="[0-9]{10}">
                    </div>
                    <div>
                        <label for="sujet">Sujet</label>
                        <input type="text" name="sujet" id="sujet"  placeholder="Sujet du message" maxlength="50" required>
                    </div>
                    <div>
                        <label for="message">Message</label>
                        <textarea name="message" id="message" required></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" id="envoyer" class="bouton" value="Envoyer">
                </div>
            </form>
        </div>
    </div>
</section>