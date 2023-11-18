<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $titre ?> - ChezMamy</title>
    <link rel="icon" href="<?= SCRIPTS ?>img/logo.ico">
    <link rel="stylesheet" href="<?= SCRIPTS ?>css/main.css">
    <script src="<?= SCRIPTS ?>js/script.js"></script>
</head>
<body>
<header>
    <a href="accueil">
        <img alt="" src="<?= SCRIPTS ?>img/logo.png">
    </a>
    <div>
        <div class="menuBurger" ></div>
        <nav id="menu">
            <div class="closeMenu" ></div>
            <ul id="menu_list">
                <li id="logo_burger"><img alt="" src="<?= SCRIPTS ?>img/logo.png"></li>
                <li id="ac_li"><a id="ac" href="accueil"><?=$traductions["nav_home"]?></a></li>
                <li id="search_bar">
                    <div>
                        <form action="#" method="GET">
                            <input placeholder="<?=$traductions["nav_searchHolder"]?>" type="text" name="searchPost">
                            <button>
                                <svg viewBox="0 0 30 29" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M27.1885 24.1516L19.9182 17.1494C21.0898 15.599 21.7201 13.7304 21.7182 11.8129C21.7182 6.79401 17.4777 2.71063 12.2658 2.71063C7.05391 2.71063 2.81348 6.79401 2.81348 11.8129C2.81348 16.8318 7.05391 20.9152 12.2658 20.9152C14.2571 20.917 16.1975 20.3101 17.8076 19.1818L25.0791 26.1829L27.1885 24.1516ZM12.2658 18.0404C10.9866 18.0405 9.73608 17.6753 8.67241 16.991C7.60873 16.3067 6.77967 15.334 6.29008 14.196C5.8005 13.0579 5.67237 11.8056 5.9219 10.5974C6.17143 9.38926 6.78742 8.27948 7.69197 7.40844C8.59651 6.5374 9.74898 5.94422 11.0036 5.70393C12.2583 5.46364 13.5587 5.58702 14.7405 6.05848C15.9224 6.52993 16.9325 7.32828 17.6431 8.35257C18.3537 9.37685 18.7329 10.5811 18.7328 11.8129C18.7308 13.4639 18.0488 15.0468 16.8364 16.2142C15.6241 17.3817 13.9804 18.0384 12.2658 18.0404V18.0404Z" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </li>
                <li id="contact"><a href="contact"><?=$traductions["nav_contact"]?></a></li>
                <?php if($infoUtilisateur == null){ ?>
                    <li id="connect"><a href="connexion"><?=$traductions["nav_connection"]?></a></li>
                    <li id="inscri"><a class="bouton" href="inscription"><?=$traductions["nav_register"]?></a></li>
                <?php } else { ?>
                    <li class="submenu">
                        <a href="#">
                            <?= "{$infoUtilisateur->getPrenom()} {$infoUtilisateur->getNom()}" ?>
                            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3.67822 5.96658L8.1792 10.4676L12.6802 5.96658" stroke="black" stroke-width="1.00189" stroke-miterlimit="10" stroke-linecap="square"/>
                            </svg>
                        </a>
                        <ul>
                            <?php if($isSenior) { ?><li><a href="posterOffres"><?= $traductions["nav_post_offers"] ?></a></li><?php } ?>
                            <li><a href="deco"><?=$traductions["nav_disconnect"]?></a></li>
                        </ul>
                    </li>
                <?php } ?>
                <form action="changeLanguage" method="POST" id="languageSelectionForm">
                    <select name="language" id="languageSelection">
                        <option value="fr"<?= ($_GET['lang'] ?? "fr") == "fr" ? " selected" : "" ?>>Français</option>
                        <option value="en"<?= ($_GET['lang'] ?? "fr") == "en" ? " selected" : "" ?>>English</option>
                    </select>
                    <input type="hidden" name="action" value="<?= $_GET['action'] ?? "accueil" ?>">
                </form>
            </ul>
        </nav>
    </div>
</header>

<main id="contenu">
    <?= $contenu ?>
</main>

<?php include('vueFaq.php'); ?>

<div id="penche">
    <svg viewBox="0 0 1920 89" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M1920 89H0V0L1920 60.6592V89Z" fill="#460B4A"/>
    </svg>
</div>
<footer>
    <nav>
        <ul>
            <li><p><?=$traductions["footer_nav"]?></p>
                <ul>
                    <li><a id="accueilFooter" href="accueil"><?=$traductions["footer_home"]?></a></li>
                    <li><a id="rechercherFooter" href="#"><?=$traductions["footer_search"]?></a></li>
                    <li><a id="contactFooter" href="contact"><?=$traductions["footer_contact"]?></a></li>
                    <li><a id="connexionFooter" href="connexion"><?=$traductions["footer_connection"]?></a></li>
                    <li><a id="inscriptionFooter" href="inscription"><?=$traductions["footer_register"]?></a></li>
                </ul>
            </li>
            <li><p><?=$traductions["footer_legality"]?></p>
                <ul>
                    <li><a id="mentionFooter" href="#"><?=$traductions["footer_legal"]?></a></li>
                    <li><a id="cookiesFooter" href="#"><?=$traductions["footer_cookies"]?></a></li>
                    <li><a id="cguFooter" href="#"><?=$traductions["footer_terms"]?></a></li>
                </ul>
            </li>
            <li><p><?=$traductions["footer_socials"]?></p>
                <div>
                    <ul>
                        <li><a id="twitterFooter" href="#"><img src="<?= SCRIPTS ?>img/twitter.png" alt="Twitter"></a></li>
                        <li><a id="facebookFooter" href="#"><img src="<?= SCRIPTS ?>img/facebook.png" alt="Facebook"></a></li>
                        <li><a id="snapchatFooter" href="#"><img src="<?= SCRIPTS ?>img/snapchat.png" alt="Snapchat"></a></li>
                    </ul>
                </div>
            </li>
        </ul>
        <div><p><?=$traductions["footer_rights"]?></p></div>
    </nav>
</footer>
<script src="<?= SCRIPTS ?>js/burger.js"></script>
</body>
</html>