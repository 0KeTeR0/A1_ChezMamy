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