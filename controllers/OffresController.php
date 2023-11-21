<?php

namespace App\ChezMamy\controllers;

use App\ChezMamy\helpers\Message;
use App\ChezMamy\models\Offres\BesoinsOffresManager;
use App\ChezMamy\models\Offres\DatesOffreManager;
use App\ChezMamy\models\Offres\ImagesOffresManager;
use App\ChezMamy\models\Offres\InfosComplementairesManager;
use App\ChezMamy\models\Offres\InfosOffresManager;
use App\ChezMamy\models\Offres\OffresManager;
use App\ChezMamy\models\Offres\OffresPostulerManager;
use App\ChezMamy\models\Offres\OffresSignaleesManager;
use App\ChezMamy\models\Offres\TypeLogementManager;
use App\ChezMamy\models\Utilisateurs\Seniors\SBesoinsManager;
use App\ChezMamy\models\Utilisateurs\TokensManager;
use App\ChezMamy\models\Utilisateurs\UtilisateurManager;
use App\ChezMamy\Views\View;
use DateTime;

/**
 * Class contrôleur des offres
 * @authors Louis Demeocq, Romain Card, Valentin Colindre
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
     * @author Valentin Colindre
     */
    public function posterOffres(array $data): void
    {
        // Vérifie que l'utilisateur puisse accéder à cette fonctionnalité
        $this->userIsSenior();
        $error=null;

        try{
            $tokenManager = new TokensManager();
            if($tokenManager->checkToken($_SESSION["auth_token"])) {
                //On créer l'offre en récupérant l'IdUtilisateur de l'utilisateur connecté
                $idUtilisateur = $tokenManager->getByToken($_SESSION["auth_token"])->getIdUtilisateur();
                $offresManager = new OffresManager();
                if($offresManager->creationOffres($idUtilisateur, $data["TitreDeLoffre"])) {
                    //On créer ensuite les images dans la base de donnée
                    $idOffre = $offresManager->getLast()->getIdOffre();
                    $imgManager = new ImagesOffresManager();
                    foreach ($data["imagesOffre"] as $image) {
                        $imgManager->creationImagesOffres($image, $idOffre);
                    }
                    //Puis les informations principales
                    $infosManager = new InfosOffresManager();
                    $infosManager->creationInfosOffres($idOffre, $data["surfaceChambre"], $data["Housing"]);
                    $idInfo = $infosManager->getByIdOffres($idOffre)->getIdInfosOffre();
                    //Puis les besoins
                    $besoinManager = new BesoinsOffresManager();
                    foreach ($data["needs"] as $need) {
                        $besoinManager->creationBesoinsOffre($need, $idInfo);
                    }
                    //Puis les informations complémentaires
                    $infosComplManager = new InfosComplementairesManager();
                    $infosComplManager->creationInfosComplementaires($data["adresseLogement"], $idInfo, $data["descriptionOffre"]);
                    //Puis les dates
                    $datesOffreManager = new DatesOffreManager();
                    $dateDeb = DateTime::createFromFormat('Y-m-d', $data["date_debut_offre"]);
                    $dateFin = DateTime::createFromFormat('Y-m-d', $data["date_fin_offre"]);
                    $datesOffreManager->creationDatesOffre($dateDeb, $idInfo, $dateFin);
                }
                else $error = "Vous avez déjà 5 offres en cours, veuillez en retirer une pour en ajouter une nouvelle.";
            }
            else{
                $error="Session invalide";
            }

        }
        catch (\Exception $e){
            $error=$e->getMessage();
        }

        if ($error!=null){
            $this->displayPosterOffres(new Message("Erreur : ".$error, "Erreur d'envoi", "danger"));
        }
        else{
            $this->displayPosterOffres(new Message("L'offre a été envoyée avec succès. Elle sera vérifiée ultérieurement pour être validée.", "Offre envoyée", "success"));
        }
    }

    /**
     * Génère la vueChercherOffres en affichant les offres correspondant
     * à la recherche
     * @param array $data données de la recherche
     * @return void
     * @author Valentin Colindre
     */
    public function chercherOffres(array $data): void
    {
        $offreManager = new OffresManager();
        $offres = array();
        //On récupère les infos des différentes offres
        foreach ($offreManager->getByName($data['searchPost']) as $offre) {
            $idOffre = $offre->getIdOffre();
            
            $infoManager = new InfosOffresManager();
            $infoOffre = $infoManager->getByIdOffres($idOffre);
            $typesLogement = (new TypeLogementManager())->getAll();
            $typeLogement = "None";
            
            foreach ($typesLogement as $tl)
                if ($tl->getIdTypeLogement() == $infoOffre->getIdTypeLogement()) $typeLogement = $tl;

            //On récupère les besoins en lien avec l'offre
            $besoinManager = new BesoinsOffresManager();
            $besoinsOffres = $besoinManager->GetAllByIdInfosOffre($infoOffre->getIdInfosOffre());
            

            //On compare ça avec les besoins de la table SBesoin
            $SBesoinsManager = new SBesoinsManager();
            $listeBesoins = $SBesoinsManager->getAll();

            //On créer la liste des besoins
            $besoins = array();
            foreach ($listeBesoins as $bs)
                foreach ($besoinsOffres as $besoinsOffre)
                    if ($bs->getIdBesoin() == $besoinsOffre->getIdBesoin()) $besoins[] = $bs;
            

            //On récupère les infos complémentaires
            $infosComplementairesManager = new InfosComplementairesManager();
            $infoComp = $infosComplementairesManager->getByIdInfosOffre($infoOffre->getIdInfosOffre());
            

            //On récupère les dates des offres
            $datesOffresManager = new DatesOffreManager();
            $datesOffre = $datesOffresManager->getByIdInfosOffre($infoOffre->getIdInfosOffre());
            

            //On récupère l'image
            $imagesOffresManager = new ImagesOffresManager();
            $image = ($imagesOffresManager->getOneByIdOffres($idOffre))->getLienImage() ?? "public/img/offres/defaut.png";
            

            //On ajoute tout ça à une entrée de la liste de retour.
            $offres[] = [
                "offre" => $offre,
                "infoOffre" => $infoOffre,
                "typeLogement" => $typeLogement,
                "besoins" => $besoins,
                "infosComplementaires" => $infoComp,
                "datesOffre" => $datesOffre,
                "imageOffre" => $image
            ];
        }

        $view = new View("ChercherOffres");
        $view->generer(["offres" => $offres]);
    }


    /**
     * Supprime la demande de logement d'un senior à partir
     * de l'id offre.
     * @param int $idOffre id de l'offre
     * @return void
     * @author Valentin Colindre
     */
    public function supprimerDemandeSenior(int $idOffre):void
    {
        //On supprime les images de l'offre
        $imageOffreManager = new ImagesOffresManager();
        while(($image = $imageOffreManager->getOneByIdOffres($idOffre))!=null){
            unlink($image->getLienImage());
        }
        $imageOffreManager->deleteByIdOffre($idOffre);

        //On supprime les signalements de l'offre
        $offreSignalees = new OffresSignaleesManager();
        $offreSignalees->deleteByIdOffre($idOffre);

        //On supprime les entrées de la table OFFRES_POSTULEES en rapport avec l'offre
        $offrePostulee = new OffresPostulerManager();
        $offrePostulee->getAllByIdOffre($idOffre);

        //On récupère l'idInfoOffre
        $infoOffresManager = new InfosOffresManager();
        $idInfoOffre = $infoOffresManager->getByIdOffres($idOffre)->getIdInfosOffre();

        //On supprime les infos complémentaires de l'offre
        $infoComplementaireManager = new InfosComplementairesManager();
        $infoComplementaireManager->deleteByIdOffre($idInfoOffre);

        //On supprime les dates de l'offre
        $dateOffreManager = new DatesOffreManager();
        $dateOffreManager->deleteByIdOffre($idInfoOffre);

        //On supprime les besoins liés à l'offre
        $besoinOffreManager = new BesoinsOffresManager();
        $besoinOffreManager->deleteByIdOffre($idInfoOffre);

        //On supprime l'infoOffre de l'offre
        $infoOffresManager->deleteByIdOffre($idOffre);

        //On supprime l'offre
        (new OffresManager())->deleteByIdOffre($idOffre);

    }

    /**
     * Génère la vueGérerDemandesSenior en affichant les offres correspondant
     * au senior
     * @return void
     * @author Valentin Colindre
     */
    public function gererDemandesSenior():void{


        // Vérifie que l'utilisateur puisse accéder à cette fonctionnalité
        $this->userIsSenior();
        $error=null;
        $offres = array();

        try{
            $tokenManager = new TokensManager();
            if($tokenManager->checkToken($_SESSION["auth_token"])) {

                $offreManager = new OffresManager();
                //On récupère les infos des différentes offres
                foreach ($offreManager->getAllByIdUtilisateur($tokenManager->getByToken($_SESSION["auth_token"])->getIdUtilisateur()) as $offre) {
                    $idOffre = $offre->getIdOffre();

                    $infoManager = new InfosOffresManager();
                    $infoOffre = $infoManager->getByIdOffres($idOffre);
                    $typesLogement = (new TypeLogementManager())->getAll();
                    $typeLogement = "None";

                    foreach ($typesLogement as $tl)
                        if ($tl->getIdTypeLogement() == $infoOffre->getIdTypeLogement()) $typeLogement = $tl;

                    //On récupère les besoins en lien avec l'offre
                    $besoinManager = new BesoinsOffresManager();
                    $besoinsOffres = $besoinManager->GetAllByIdInfosOffre($infoOffre->getIdInfosOffre());


                    //On compare ça avec les besoins de la table SBesoin
                    $SBesoinsManager = new SBesoinsManager();
                    $listeBesoins = $SBesoinsManager->getAll();


                    //On créer la liste des besoins
                    $besoins = array();
                    foreach ($listeBesoins as $bs)
                        foreach ($besoinsOffres as $besoinsOffre)
                            if ($bs->getIdBesoin() == $besoinsOffre->getIdBesoin()) $besoins[] = $bs;


                    //On récupère les infos complémentaires
                    $infosComplementairesManager = new InfosComplementairesManager();
                    $infoComp = $infosComplementairesManager->getByIdInfosOffre($infoOffre->getIdInfosOffre());


                    //On récupère les dates des offres
                    $datesOffresManager = new DatesOffreManager();
                    $datesOffre = $datesOffresManager->getByIdInfosOffre($infoOffre->getIdInfosOffre());


                    //On récupère l'image
                    $imagesOffresManager = new ImagesOffresManager();
                    $image = ($imagesOffresManager->getOneByIdOffres($idOffre))->getLienImage() ?? "public/img/offres/defaut.png";


                    //On ajoute tout ça à une entrée de la liste de retour.
                    $offres[] = [
                        "offre" => $offre,
                        "infoOffre" => $infoOffre,
                        "typeLogement" => $typeLogement,
                        "besoins" => $besoins,
                        "infosComplementaires" => $infoComp,
                        "datesOffre" => $datesOffre,
                        "imageOffre" => $image
                    ];
                }
            }
        }
        catch (\Exception $e){
            $error=$e->getMessage();
        }
        if ($error!=null){
            $error= new Message("Erreur : ".$error, "Erreur d'envoi", "danger");
        }

        $view = new View("GererDemandesSenior");
        if($error!=null) $view->generer(["offres" => $offres,"message" => $error]);
        else $view->generer(["offres" => $offres]);
    }

}
