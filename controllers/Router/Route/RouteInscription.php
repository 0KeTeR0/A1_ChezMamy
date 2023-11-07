<?php

namespace App\ChezMamy\controllers\Router\Route;

use App\ChezMamy\controllers\UtilisateurController;
use App\ChezMamy\controllers\Router\Route;
use App\ChezMamy\models\ComptesEtudiantsManager;
use App\ChezMamy\models\ComptesSeniorsManager;
use App\ChezMamy\models\InfoUtilisateursManager;
use App\ChezMamy\models\UtilisateurManager;

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
                "interets"=>$this->getParam($params,"interests",false),
                "raison"=>$this->getParam($params,"why",false),
                "idConnaissanceAssociation"=>$this->getParam($params,"know_association",false),
                "idTypeLogement"=>$this->getParam($params,"housing",false)
            ];

            //Si le compte est un compte étudiant, vérification des données en rapport
            //avec CompteEtudiant pour l'ajout dans la BDD
            if($this->getParam($params,"typeCompte")=="0"){

                $data["niveauEtude"]=$this->getParam($params,"education_level",false);
                $data["stages"]=$this->getParam($params,"internships");
                $data["etablissementEtude"]=$this->getParam($params,"end_of_studies",false);
                $data["dateArriveeRegion"]=date('Y-m-d',strtotime($this->getParam($params,"date_of_arrival")));
                $data["motivations"]=$this->getParam($params,"motivation");
                $data["permisDeConduire"]=$this->getParam($params,"can_drive",false);
                $data["allergique"]=$this->getParam($params,"is_allergic",false);
                $data["allergies"]=$this->getParam($params,"allergies");
                $data["moyenLocomotion"]=$this->getParam($params,"means_of_locomation");
                $data["f3BudgetMax"]=$this->getParam($params,"housing_3_budget");
                $data["idDomaineEtude"]=$this->getParam($params,"idDomaineEtude");
            }//Sinon même chose mais avec les données de CompteSenior
            else{
                $data["animal"]=$this->getParam($params,"animal[]");
                $data["transportPlusProche"]=$this->getParam($params,"public_transport_distance",false);
                $data["resterEnEte"]=$this->getParam($params,"can_stay_summer",false);
                $data["passionAPartager"]=$this->getParam($params,"passion_to_share",false);
                $data["professionExercee"]=$this->getParam($params,"profession",false);
                $data["avantagesCohabitation"]=$this->getParam($params,"advantages_with_you");
                $data["accordFamille"]=$this->getParam($params,"is_family_ok",false);
                $data["surfaceChambre"]=$this->getParam($params,"room_surface",false);
                $data["meublee"]=$this->getParam($params,"has_furniture",false);
                $data["appareilsDeLavage"]=$this->getParam($params,"can_clean",false);
                $data["internet"]=$this->getParam($params,"has_internet",false);
                $data["idSituation"]=$this->getParam($params,"marital_status",false);
                $data["idFamillePresente"]=$this->getParam($params,"is_family_present",false);
                $data["idPropriete"]=$this->getParam($params,"is_landlord",false);
                $data["idLogement"]=$this->getParam($params,"is_house",false);
            }

        }//Renvoi des erreurs si quelque chose n'est pas correct
        catch (\Exception $e){
            $error=$e->getMessage();
        }
        if ($error!=null){
        $this->controller->displayInscription("Erreur : ".$error);
        }
        else if(($this->getParam($params,"email")==null and $this->getParam($params,"phone")==null)){
            $this->controller->displayInscription("Email et numéro de téléphone sont vides, l'un des deux doit être complété afin de pouvoir vous contacter.");
        }
        else if($this->getParam($params,"date_of_arrival")!="" and strtotime($this->getParam($params,"date_of_arrival"))>time()){
            $this->controller->displayInscription("La date d'arrivée n'est pas valide");
        }
        else if($this->getParam($params,"password")!=$this->getParam($params,"password_repeat")){
            $this->controller->displayInscription("Le mot de passe ne correspond pas à la répétition");
        }//Sinon on procède à l'inscription
        else{
            $this->controller->Inscription($data);
        }
    }
}