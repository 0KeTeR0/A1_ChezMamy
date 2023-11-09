<section class="contactForm">
    <div class="contactBox">

        <h2 class="section-title">Nous Contacter</h2>
        <div>
            <form id="contact_form" action="" method="post">
                <?php include('message.php'); ?>
                <div class="form-group">
                    <div class="form-pair">
                        <label for="prenom">Prénom</label>
                        <input type="text" name="prenom" id="prenom">
                    </div>
                    <div>
                        <label for="nom">Nom</label>
                        <input type="text" name="nom" id="nom">
                    </div>
                    <div>
                        <label for="mail">Mail</label>
                        <input type="email" name="mail" id="mail"  placeholder="exemple@gmail.com">
                    </div>
                    <div>
                        <label for="message">Message</label>
                        <textarea name="message" id="message" ></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <input type="submit" id="envoyer" class="bouton" value="Envoyer">
                </div>
            </form>
        </div>
    </div>
</section>