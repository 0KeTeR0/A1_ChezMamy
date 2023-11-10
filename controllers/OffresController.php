<?php

namespace App\ChezMamy\controllers;

use App\ChezMamy\helpers\Message;
use App\ChezMamy\models\SBesoinsManager;
use App\ChezMamy\models\TokensManager;
use App\ChezMamy\models\TypeLogementManager;
use App\ChezMamy\models\UtilisateurManager;
use App\ChezMamy\Views\View;

/**
 * Class contrôleur des offres
 * @author Louis Demeocq
 */
class OffresController
{
    /**
     * Vérifie que l'utilisateur soit connecté et est un senior pour accéder au formulaire de poste d'offres
     * Redirige sur l'accueil si l'utilisateur n'est pas connecté ou n'est pas un senior
     * @return void
     * @author Romain Card
     */
    private function userIsSenior(): void
    {
        $res = false;

        if (!empty($_SESSION['auth_token'])) {
            $tokenManager = new TokensManager();
            $tokenOk = $tokenManager->checkToken($_SESSION['auth_token']);

            if($tokenOk) {
                $token = $tokenManager->getByToken($_SESSION['auth_token']);
                $idUtilisateur = $token->getIdUtilisateur();

                $utilisateurManager = new UtilisateurManager();
                $res = $utilisateurManager->isSenior($idUtilisateur);
            }
        }

        if(!$res) {
            header('Location: accueil');
            return;
        }
    }

    /**
     * Affiche la page des offres
     * @param Message|null $message Message éventuel à afficher
     * @return void
     * @author Louis Demeocq
     */
    public function displayPosterOffres(?Message $message = null): void
    {
        // Vérifie que l'utilisateur puisse accéder à cette fonctionnalité
        $this->userIsSenior();

        // ensembles des types de logement contre services proposé
        $typeLogement = new TypeLogementManager();
        // ensembles des besoins des Seniors
        $sbesoins = new SBesoinsManager();

        $PosterOffres = new View("PosterOffres");
        $PosterOffres->generer([
            "message" => $message,
            "type_logement" => $typeLogement->getAll(),
            "SBesoin" => $sbesoins->getAll()
        ]);
    }


    /**
     * Execute l'envoie de l'offre
     * @param array $data Données du formulaire
     * @return void
     * @author Louis Demeocq
     */
    public function posterOffres(array $data): void
    {
        $nbrFiles = count($_FILES['upload']['name']);
        $chemins = array();
        for( $i=0 ; $i < $nbrFiles ; $i++ )
        {
            // recupère le path temp
            $tmpFilePath = $_FILES['imagesOffre']['tmp_name'][$i];

            // check si on a un path
            if ($tmpFilePath != "") {
                // crée le nouveau path
                $newFilePath = "public/img/offres/".date('d-m-Y_H:i:s', time())."_{$i}_{$_FILES['imagesOffre']['name'][$i]}";

                // copie le fichier dans le dossier
                if (copy($_FILES['imagesOffre']['tmp_name'], $newFilePath))
                {
                    $chemins[] = $newFilePath;
                }

            }
        }

        // Vérifie que l'utilisateur puisse accéder à cette fonctionnalité
        $this->userIsSenior();

    }
}