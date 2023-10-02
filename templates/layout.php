<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= $title ?></title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <header>
        <img src="../assets/img/logo.png">
        <nav>
            <ul>
                <li><a id="ac" href="index.php">Accueil</a></li>
                <li>
                    <div>
                        <form>
                            <input placeholder="Rechercher une offre" type="text" name="search">
                            <button>
                                <svg viewBox="0 0 30 29" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M27.1885 24.1516L19.9182 17.1494C21.0898 15.599 21.7201 13.7304 21.7182 11.8129C21.7182 6.79401 17.4777 2.71063 12.2658 2.71063C7.05391 2.71063 2.81348 6.79401 2.81348 11.8129C2.81348 16.8318 7.05391 20.9152 12.2658 20.9152C14.2571 20.917 16.1975 20.3101 17.8076 19.1818L25.0791 26.1829L27.1885 24.1516ZM12.2658 18.0404C10.9866 18.0405 9.73608 17.6753 8.67241 16.991C7.60873 16.3067 6.77967 15.334 6.29008 14.196C5.8005 13.0579 5.67237 11.8056 5.9219 10.5974C6.17143 9.38926 6.78742 8.27948 7.69197 7.40844C8.59651 6.5374 9.74898 5.94422 11.0036 5.70393C12.2583 5.46364 13.5587 5.58702 14.7405 6.05848C15.9224 6.52993 16.9325 7.32828 17.6431 8.35257C18.3537 9.37685 18.7329 10.5811 18.7328 11.8129C18.7308 13.4639 18.0488 15.0468 16.8364 16.2142C15.6241 17.3817 13.9804 18.0384 12.2658 18.0404V18.0404Z" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </li>
                <li><a href="index.php">Contact</a></li>
                <li><a href="index.php">Connexion</a></li>
                <li>
                    <button class="bouton">Inscription</button>
                </li>
            </ul>
        </nav>
    </header>
    <?= $content ?>

    <footer>
        <nav>
            <ul>
                <li><p>Naviguer </p>
                    <ul>
                        <li><a id="accueilFooter" href="/index.php">Accueil</a></li>
                        <li><a id="rechercherFooter" href="">Rechercher une offre</a></li>
                        <li><a id="contactFooter" href="">Contact</a></li>
                        <li><a id="connexionFooter" href="">Connexion</a></li>
                        <li><a id="inscriptionFooter" href="">Inscription</a></li>
                    </ul>
                </li>
                <li><p>Légalité</p>
                    <ul>
                        <li><a id="mentionFooter" href="">Mention légales</a></li>
                        <li><a id="cookiesFooter" href="">Politique de cookies</a></li>
                        <li><a id="cguFooter" href="">CGU</a></li>
                        <li><a id="cgvFooter" href="">CGV</a></li>
                    </ul>
                </li>
                <li><p>Nos réseaux</p>
                <div>
                    <ul>
                        <li><a id="twitterFooter" href=""><img src="../img/twitter.png"></a></li>
                        <li><a id="facebookFooter" href=""><img src="../img/facebook.png"></a></li>
                        <li><a id="snapchatFooter" href=""><img src="../img/snapchat./png" </a></li>
                    </ul>
                </li>
                </div>
            </ul>
            <div><p>&copy; 2023 Tous droits réservés</p></div>
        </nav>
    </footer>

</body>
</html>