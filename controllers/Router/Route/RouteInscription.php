<?php

namespace App\ChezMamy\controllers\Router\Route;

use App\ChezMamy\controllers\UtilisateurController;
use App\ChezMamy\controllers\Router\Route;
use App\ChezMamy\helpers\Message;
use App\ChezMamy\models\ComptesEtudiantsManager;
use App\ChezMamy\models\ComptesSeniorsManager;
use App\ChezMamy\models\InfoUtilisateursManager;
use App\ChezMamy\models\UtilisateurManager;
use DateInterval;
use DateTime;

/**
 * Classe RouteInscription
 * Route pour la page d'inscription
 */
class RouteInscription extends Route
{
    private UtilisateurController $controller;

    /**
     * Prépare l'affichage de la page
     * @param UtilisateurController $controller
     * @author Romain Card
     */
    public function __construct(UtilisateurController $controller)
    {
        parent::__construct();
        $this->controller = $controller;
    }

    /**
     * Affiche la page d'inscription
     * @param array $params Paramètres à passer à la page
     * @return void
     * @author Romain Card
     */
    protected function get(array $params = []): void
    {
        $this->controller->displayInscription();
    }

    /**
     * Exécute une action
     * @param array $params Paramètres à passer à l'exécution
     * @return void
     * @author Romain Card
     */
    protected function post(array $params = []): void
    {
        $error=null;
        try {
            //Vérification des données en rapport avec Utilisateur et InfoUtilisateur
            $data = [
                "typeCompte"=>$this->getParam($params,"typeCompte",false),
                "login"=>$this->getParam($params,"login",false),
                "password"=>$this->getParam($params,"password",false),
                "mail"=>$this->getParam($params,"email"),
                "numero"=>$this->getParam($params,"phone"),
                "nom"=>$this->getParam($params,"last_name",false),
                "prenom"=>$this->getParam($params,"first_name",false),
                "dateDeNaissance"=>date('Y-m-d',strtotime($this->getParam($params,"date_of_birth",false))),
                "ville"=>$this->getParam($params,"city",false),
                "codePostal"=>$this->getParam($params,"postal_code",false),
                "fumeur"=>$this->getParam($params,"is_smoking",false),
                "interets"=>$this->getParam($params,"interests"),
                "raison"=>$this->getParam($params,"why"),
                "idConnaissanceAssociation"=>$this->getParam($params,"know_association"),
                "idTypeLogement"=>$this->getParam($params,"housing",false)
            ];

            //Si le compte est un compte étudiant, vérification des données en rapport
            //avec CompteEtudiant pour l'ajout dans la BDD
            if($this->getParam($params,"typeCompte")=="etudiant"){

                $data["niveauEtude"]=$this->getParam($params,"education_level",false);
                $data["stages"]=$this->getParam($params,"internships");
                $data["etablissementEtude"]=$this->getParam($params,"establishment",false);
                $data["dateFinEtude"]=(new DateTime())->setTimestamp(time() + ($this->getParam($params, "end_of_studies") ?? '0') * 365 * 24 * 60 * 60)->format("Y-m-d");
                $data["dateArriveeRegion"]=date('Y-m-d',strtotime($this->getParam($params,"date_of_arrival")));
                $data["motivations"]=$this->getParam($params,"motivation");
                $data["permisDeConduire"]=$this->getParam($params,"can_drive",false);
                $data["allergique"]=$this->getParam($params,"is_allergic",false);
                $data["allergies"]=$this->getParam($params,"allergies");
                $data["moyenLocomotion"]=$this->getParam($params,"means_of_locomotion");
                $data["f3BudgetMax"]=$this->getParam($params,"housing_3_budget", false);
                $data["idDomaineEtude"]=$this->getParam($params,"idDomaineEtude");

                //On vérifie les cas particuliers
                if($this->getParam($params,"date_of_arrival")!="" and strtotime($this->getParam($params,"date_of_arrival"))>time()){
                    throw new \Exception("La date d'arrivée n'est pas valide.");
                }
            }//Sinon même chose mais avec les données de CompteSenior
            else{
                $data["animal"]=implode(",",$this->getParam($params,"animal"));
                $data["transportPlusProche"]=$this->getParam($params,"public_transport_distance",false);
                $data["resterEnEte"]=$this->getParam($params,"can_stay_summer",false);
                $data["passionAPartager"]=$this->getParam($params,"passion_to_share");
                $data["professionExercee"]=$this->getParam($params,"profession");
                $data["avantagesCohabitation"]=$this->getParam($params,"advantages_with_you");
                $data["accordFamille"]=$this->getParam($params,"is_family_ok");
                $data["surfaceChambre"]=$this->getParam($params,"room_surface",false);
                $data["meublee"]=$this->getParam($params,"has_furniture",false);
                $data["appareilsDeLavage"]=$this->getParam($params,"can_clean",false);
                $data["internet"]=$this->getParam($params,"has_internet",false);
                $data["idSituation"]=$this->getParam($params,"marital_status",false);
                $data["idFamillePresente"]=$this->getParam($params,"is_family_present",false);
                $data["idPropriete"]=$this->getParam($params,"is_landlord",false);
                $data["idLogement"]=$this->getParam($params,"is_house",false);
                $data["enfants"]=$this->getParam($params,"has_kids",false);
                $data["petitsEnfants"]=$this->getParam($params,"has_grandkids",false);
            }

            if(($this->getParam($params,"email")==null and $this->getParam($params,"phone")==null)){
                throw new \Exception("Email et numéro de téléphone sont vides, au moins l'un des deux doit être complété afin de pouvoir vous contacter.");
            }
            else if($this->getParam($params,"password")!=$this->getParam($params,"password_repeat")){
                throw new \Exception("Les deux mots de passe ne correspondent pas.");
            }

        }//Renvoi une erreur si quelque chose n'est pas correct
        catch (\Exception $e){
            $error=$e->getMessage();
        }
        if ($error!=null){
        $this->controller->displayInscription(new Message("Erreur : ".$error, "Erreur d'inscription", "danger"));
        }
        else{
            $this->controller->Inscription($data);
        }
    }
}