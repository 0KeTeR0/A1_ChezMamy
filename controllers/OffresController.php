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
use App\ChezMamy\models\Utilisateurs\InfoUtilisateursManager;
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
     * Vérifie que l'utilisateur soit connecté et est un étudiant pour pouvoir postuler aux offres
     * Redirige sur l'accueil si l'utilisateur n'est pas connecté ou n'est pas un étudiant
     * @return void
     * @author Louis Demeocq
     */
    private function userIsEtudiant(): void
    {
        $res = false;

        if (!empty($_SESSION['auth_token'])) {
            $tokenManager = new TokensManager();
            $tokenOk = $tokenManager->checkToken($_SESSION['auth_token']);

            if($tokenOk) {
                $token = $tokenManager->getByToken($_SESSION['auth_token']);
                $idUtilisateur = $token->getIdUtilisateur();

                $utilisateurManager = new UtilisateurManager();
                $res = $utilisateurManager->isEtudiant($idUtilisateur);
            }
        }

        if(!$res) {
            header('Location: accueil');
            return;
        }
    }

    /**
     * Vérifie que l'utilisateur soit connecté et est un admin pour pouvoir supprimer les offres
     * Redirige sur l'accueil si l'utilisateur n'est pas connecté ou n'est pas un admin
     * @return bool vrai si admin ou modérateur faux sinon
     * @author Louis Demeocq
     */
    private function userIsStaff(): bool
    {
        $res = false;

        if (!empty($_SESSION['auth_token'])) {
            $tokenManager = new TokensManager();
            $tokenOk = $tokenManager->checkToken($_SESSION['auth_token']);

            if($tokenOk) {
                $token = $tokenManager->getByToken($_SESSION['auth_token']);
                $idUtilisateur = $token->getIdUtilisateur();

                $utilisateurManager = new UtilisateurManager();
                $res = $utilisateurManager->isStaff($idUtilisateur);
            }
        }

        if(!$res) {
            header('Location: accueil');
        }
        return $res;
    }

    /**
     * Inscrit dans la bdd un étudiant à une offre
     * @param array $data données de l'offre
     * @return void
     * @author Louis Demeocq
     */
    public function postulerOffres(array $data): Message
    {
        // Vérifie que l'utilisateur puisse accéder à cette fonctionnalité
        $this->userIsEtudiant();
        $error = null;
        $res = new Message("");

        $tokenManager = new TokensManager();
        if ($tokenManager->checkToken($_SESSION["auth_token"])) {
            //On crée l'offrePostuler en récupérant l'IdUtilisateur de l'utilisateur connecté
            $idUtilisateur = $tokenManager->getByToken($_SESSION["auth_token"])->getIdUtilisateur();
            $offresPostulerManager = new OffresPostulerManager();
            if($offresPostulerManager->creationPostulerOffres($idUtilisateur, $data["idPostulerOffre"]))
            {
                $res = new Message("Vous avez postulé à l'annonce", "Succès", "success");
            }
            else $res = new Message("Vous avez déjà postulé à cette annonce", "Erreur");
        }
        return $res;
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
     * Supprime l'offre de la bdd
     * @param array $data données de l'offre
     * @return Message message affiché en cas d'échec ou de réussite
     * @author Louis Demeocq
     */
    public function supprimerOffres(array $data): Message
    {
        $res = new Message("");
        // Vérifie que l'utilisateur puisse accéder à cette fonctionnalité
        if($this->userIsStaff())
        {
            $tokenManager = new TokensManager();
            if ($tokenManager->checkToken($_SESSION["auth_token"])) {
                //On crée l'OffresSignaleesManager en récupérant l'IdUtilisateur de l'utilisateur connecté
                $idUtilisateur = $tokenManager->getByToken($_SESSION["auth_token"])->getIdUtilisateur();
                $OffresSignaleesManager = new OffresManager();
                if($OffresSignaleesManager->deleteByIdOffre($data["idOffreToDelete"]))
                {
                    $res = new Message("L'Offre a bien été supprimé", "Succès", "success");
                }
                else $res = new Message("L'Offre n'a pas pu être supprimé", "Erreur");
            }
        }


        return $res;
    }

    /**
     * Supprime un signalement de la bdd
     * @param array $data données de l'offre
     * @return Message message affiché en cas d'échec ou de réussite
     * @author Louis Demeocq
     */
    public function supprimerSignalement(array $data): Message
    {
        $res = new Message("");
        // Vérifie que l'utilisateur puisse accéder à cette fonctionnalité
        if($this->userIsStaff())
        {
            $tokenManager = new TokensManager();
            if ($tokenManager->checkToken($_SESSION["auth_token"])) {
                //On crée l'OffresSignaleesManager en récupérant l'IdUtilisateur de l'utilisateur connecté
                $idUtilisateur = $tokenManager->getByToken($_SESSION["auth_token"])->getIdUtilisateur();
                $OffresSignaleesManager = new OffresSignaleesManager();
                if($OffresSignaleesManager->deleteByIdOffre($data["idReportToDelete"]))
                {
                    $res = new Message("Le signalement a bien été supprimé", "Succès", "success");
                }
                else $res = new Message("Le signalement n'a pas pu être supprimé", "Erreur");
            }
        }

        return $res;
    }


    /**
     * Génére la vue SignalementAdmin et affiche les offres correspondantes
     * @return void
     * @authors Louis Demeocq, Valentin Colindre
     */
    public function displaySignalement(): void
    {
        $this->userIsStaff();
        $sigView = new View('SignalementAdmin');
        $offreManager = new OffresManager();
        $offreSignaler = new OffresSignaleesManager();
        $offresSignaler = array();
        $offres = array();
        foreach ($offreSignaler->getAll() as $signalement)
            $offresSignaler[] = $offreManager->getByIdOffre($signalement->getIdOffre());
        //On récupère les infos des différentes offres
        foreach ($offresSignaler as $offre) {
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
            if($listeBesoins!=null&&$besoinsOffres!=null) {
                foreach ($listeBesoins as $bs)
                    foreach ($besoinsOffres as $besoinsOffre)
                        if ($bs->getIdBesoin() == $besoinsOffre->getIdBesoin()) $besoins[] = $bs;
            }


            //On récupère les infos complémentaires
            $infosComplementairesManager = new InfosComplementairesManager();
            $infoComp = $infosComplementairesManager->getByIdInfosOffre($infoOffre->getIdInfosOffre());


            //On récupère les dates des offres
            $datesOffresManager = new DatesOffreManager();
            $datesOffre = $datesOffresManager->getByIdInfosOffre($infoOffre->getIdInfosOffre());


            //On récupère l'image
            $imagesOffresManager = new ImagesOffresManager();
            $image = ($imagesOffresManager->getOneByIdOffres($idOffre))->getLienImage() ?? "public/img/offres/defaut.png";

            $utilisateurMangager = new UtilisateurManager();
            $signalerPar = $utilisateurMangager->getByID($offre->getIdUtilisateur())->getLogin();

            //On ajoute tout ça à une entrée de la liste de retour.
            $offres[] = [
                "offre" => $offre,
                "infoOffre" => $infoOffre,
                "typeLogement" => $typeLogement,
                "besoins" => $besoins,
                "infosComplementaires" => $infoComp,
                "datesOffre" => $datesOffre,
                "imageOffre" => $image,
                "signalerPar" => $signalerPar
            ];
        }
        $sigView->generer(["offres" => $offres]);
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
                //On crée l'offre en récupérant l'IdUtilisateur de l'utilisateur connecté
                $idUtilisateur = $tokenManager->getByToken($_SESSION["auth_token"])->getIdUtilisateur();
                $offresManager = new OffresManager();
                if($offresManager->creationOffres($idUtilisateur, $data["TitreDeLoffre"])) {
                    //On crée ensuite les images dans la base de donnée
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
    public function chercherOffres(array $data, ?Message $message = null): void
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
            if($listeBesoins!=null&&$besoinsOffres!=null) {
                foreach ($listeBesoins as $bs)
                    foreach ($besoinsOffres as $besoinsOffre)
                        if ($bs->getIdBesoin() == $besoinsOffre->getIdBesoin()) $besoins[] = $bs;
            }
            

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
        $view->generer(["offres" => $offres, "message" => $message]);
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
            $link = $image->getLienImage();
            $imageOffreManager->deleteByLink($link);
            unlink($link);
        }

        //On supprime l'offre (cascade)
        (new OffresManager())->deleteByIdOffre($idOffre);

        $this->gererDemandesSenior();
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
                    if($listeBesoins!=null&&$besoinsOffres!=null) {
                        foreach ($listeBesoins as $bs)
                            foreach ($besoinsOffres as $besoinsOffre)
                                if ($bs->getIdBesoin() == $besoinsOffre->getIdBesoin()) $besoins[] = $bs;
                    }


                    //On récupère les infos complémentaires
                    $infosComplementairesManager = new InfosComplementairesManager();
                    $infoComp = $infosComplementairesManager->getByIdInfosOffre($infoOffre->getIdInfosOffre());


                    //On récupère les dates des offres
                    $datesOffresManager = new DatesOffreManager();
                    $datesOffre = $datesOffresManager->getByIdInfosOffre($infoOffre->getIdInfosOffre());


                    //On récupère l'image
                    $imagesOffresManager = new ImagesOffresManager();
                    $image=$imagesOffresManager->getOneByIdOffres($idOffre);
                    if($image!=null){
                        $image = $image->getLienImage();
                    }
                    else{
                        $image="public/img/offres/defaut.png";
                    }

                    $offresPostuleesManager = new OffresPostulerManager();
                    $postules = $offresPostuleesManager->getAllByIdOffre($idOffre);
                    $demandes = array();
                    if($postules!=null){
                        $infoUtilisateurManager = new InfoUtilisateursManager();
                        foreach ($postules as $postule){
                            $demandes[] = $infoUtilisateurManager->getByIdUtilisateur($postule->getIdUtilisateur());
                        }
                    }


                    //On ajoute tout ça à une entrée de la liste de retour.
                    $offres[] = [
                        "offre" => $offre,
                        "infoOffre" => $infoOffre,
                        "typeLogement" => $typeLogement,
                        "besoins" => $besoins,
                        "infosComplementaires" => $infoComp,
                        "datesOffre" => $datesOffre,
                        "imageOffre" => $image,
                        "demandes"=> $demandes
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
