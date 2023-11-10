<?php

namespace App\ChezMamy\controllers;

use App\ChezMamy\helpers\Message;
use App\ChezMamy\models\DatesOffreManager;
use App\ChezMamy\models\ImagesOffresManager;
use App\ChezMamy\models\InfosComplementairesManager;
use App\ChezMamy\models\infosOffre;
use App\ChezMamy\models\InfosOffresManager;
use App\ChezMamy\models\OffresManager;
use App\ChezMamy\models\SBesoinsManager;
use App\ChezMamy\models\TokensManager;
use App\ChezMamy\models\TypeLogementManager;
use App\ChezMamy\models\UtilisateurManager;
use App\ChezMamy\Views\View;
use DateTime;

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
        // Vérifie que l'utilisateur puisse accéder à cette fonctionnalité
        $this->userIsSenior();
        $error=null;

        try{
            $tokenManager = new TokensManager();
            if($tokenManager->checkToken($_SESSION["auth_token"])) {
                $idUtilisateur = $tokenManager->getByToken($_SESSION["auth_token"])->getIdUtilisateur();
                $offresManager = new OffresManager();
                $offresManager->creationOffres($idUtilisateur, $data["TitreDeLoffre"]);
                $idOffre = $offresManager->getLast()->getIdOffre();
                $imgManager = new ImagesOffresManager();
                foreach($data["imagesOffre"] as $image){
                    $imgManager->creationImagesOffres($image,$idOffre);
                }
                //ajouter stockage image
                $infosManager = new InfosOffresManager();
                $infosManager->creationInfosOffres($idOffre,$data["surfaceChambre"]);
                $idInfo=$infosManager->getByIdOffres($idOffre)->getIdInfosOffre();
                $infosComplManager = new InfosComplementairesManager();
                $infosComplManager->creationInfosComplementaires($data["adresseLogement"],$idInfo,$data["descriptionOffre"]);
                $datesOffreManager = new DatesOffreManager();
                $dateDeb= DateTime::createFromFormat('Y-m-d', $data["date_debut_offre"]);
                $dateFin = DateTime::createFromFormat('Y-m-d', $data["date_fin_offre"]);
                $datesOffreManager->creationDatesOffre($dateDeb,$idInfo,$dateFin);
            }
            else{
                $error="Sesssion invalide";
            }

        }
        catch (\Exception $e){
            $error=$e->getMessage();
        }

        if ($error!=null){
            $this->displayPosterOffres(new Message("Erreur : ".$error, "Erreur d'envoie", "danger"));
        }
        else{
            $this->displayPosterOffres(new Message("succès de la publication de l'offre. Elle sera approuvée ou non ultérieurement.", "succès", "success"));
        }

    }
}