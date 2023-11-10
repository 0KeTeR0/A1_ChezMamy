<?php
namespace App\ChezMamy\controllers;

use App\ChezMamy\models\TokensManager;
use App\ChezMamy\models\UtilisateurManager;
use App\ChezMamy\Views\View;

/**
 * Classe MainController
 * Contrôleur principal
 */
class MainController
{
    /**
     * Affiche la page d'accueil
     * @return void
     * @author Romain Card
     */
    public function Index(): void
    {
        $isSenior = false;

        if (!empty($_SESSION['auth_token'])) {
            $tokenManager = new TokensManager();
            $tokenOk = $tokenManager->checkToken($_SESSION['auth_token']);

            if($tokenOk) {
                $idUtilisateur = (new TokensManager())->getByToken($_SESSION['auth_token'])->getIdUtilisateur();
                $isSenior = (new UtilisateurManager())->isSenior($idUtilisateur);
            }
        }

        // affichage de la vue
        $indexView = new View('Index');
        $indexView->generer(['isSenior' => $isSenior]);
    }

    /**
     * Affiche la page d'exception
     * @param array|null $params Paramètres à passer à la page
     * @return void
     * @author Romain Card
     */
    public function Exception(?array $params = null): void
    {
        $notFoundView = new View('Exception');
        $notFoundView->generer($params);
    }
}