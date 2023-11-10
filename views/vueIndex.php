<section class="page-accueil">
    <div class="texte-accueil">
        <h1><?= $traductions['index_title'] ?></h1>
        <p><?= $traductions['index_presentation'] ?></p>
    </div>
    <div class="bouton-group">
        <div class="bouton">
            <p><?= $traductions['index_button1'] ?></p>
        </div>
        <a href="<?= $isSenior ? 'posterOffres' : 'inscription' ?>" class="bouton">
            <p><?= $traductions['index_button2'] ?></p>
        </a>
    </div>

    <svg viewBox="0 0 1920 89" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M0 89H1920V0L0 60.6592V89Z" fill="white"/>
    </svg>
</section>
<section class="presentation">
    <h2 class="section-title"><?= $traductions['index_pres_assoc_title'] ?></h2>
    <div class="presentation-list">
        <div>
            <div class="imgPres"  id="img_right_Pres">
                <img src="<?= SCRIPTS ?>img/bob-joie.png" alt="">
            </div>
            <div>
                <h3><?= $traductions['index_pres_assoc_subtitle'] ?></h3>
                <ul>
                    <li><?= $traductions['index_pres_assoc_p1'] ?></li>
                    <li><?= $traductions['index_pres_assoc_p2'] ?></li>
                    <li><?= $traductions['index_pres_assoc_p3'] ?></li>
                    <li><?= $traductions['index_pres_assoc_p4'] ?></li>
                    <li><?= $traductions['index_pres_assoc_p5'] ?></li>
                </ul>
            </div>
        </div>
        <div>
            <div>
                <h3><?= $traductions['index_pres_assoc_subtitle'] ?></h3>
                <ul>
                    <li><?= $traductions['index_pres_assoc_p6'] ?></li>
                    <li><?= $traductions['index_pres_assoc_p7'] ?></li>
                    <li><?= $traductions['index_pres_assoc_p8'] ?></li>
                    <li><?= $traductions['index_pres_assoc_p9'] ?></li>
                    <li><?= $traductions['index_pres_assoc_p10'] ?></li>
                </ul>
            </div>
            <div class="imgPres">
                <img src="<?= SCRIPTS ?>img/alice-joie.png" alt="">
            </div>
        </div>
    </div>
</section>
