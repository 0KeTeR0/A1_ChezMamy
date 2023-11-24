<?php
namespace App\ChezMamy\controllers;

use App\ChezMamy\helpers\Message;
use App\ChezMamy\models\Offres\TypeLogementManager;
use App\ChezMamy\models\Utilisateurs\ComptesBloquesManager;
use App\ChezMamy\models\Utilisateurs\ConnaissancesAssociationManager;
use App\ChezMamy\models\Utilisateurs\Etudiants\ComptesEtudiantsManager;
use App\ChezMamy\models\Utilisateurs\Etudiants\EDisposManager;
use App\ChezMamy\models\Utilisateurs\Etudiants\EDomainesEtudeManager;
use App\ChezMamy\models\Utilisateurs\InfoUtilisateursManager;
use App\ChezMamy\models\Utilisateurs\RolesManager;
use App\ChezMamy\models\Utilisateurs\Seniors\CompteSeniorSBesoinManager;
use App\ChezMamy\models\Utilisateurs\Seniors\ComptesSeniorsManager;
use App\ChezMamy\models\Utilisateurs\Seniors\SBesoinsManager;
use App\ChezMamy\models\Utilisateurs\Seniors\SLogementsManager;
use App\ChezMamy\models\Utilisateurs\Seniors\SPresenceFamillesManager;
use App\ChezMamy\models\Utilisateurs\Seniors\SProprietesManager;
use App\ChezMamy\models\Utilisateurs\Seniors\SSituationsManager;
use App\ChezMamy\models\Utilisateurs\TokensManager;
use App\ChezMamy\models\Utilisateurs\UtilisateurManager;
use App\ChezMamy\Views\View;

/**
 * Classe UtilisateurController
 * Contrôleur des utilisateurs
 * @author Romain Card
 */
class UtilisateurController
{


    /**
     * Vérifie que l'utilisateur ne soit pas connecté pour accéder aux inscription et connexion
     * Renvoie sur la page d'accueil si l'utilisateur est déjà connecté
     * @return void
     * @author Romain Card
     */
    private function userNotLogged(): void
    {
        //On vérifie que l'utilisateur n'est pas déjà connecté
        if (!empty($_SESSION['auth_token'])) {
            $token = new TokensManager();
            $res = $token->checkToken($_SESSION['auth_token']);

            // Si le token est valide, on redirige vers l'accueil
            if($res) {
                header('Location: accueil');
                return;
            }
            else unset ($_SESSION['auth_token']);
        }
    }

    /**
     * Affiche la page de connexion
     * @param Message|null $message Message éventuel à afficher
     * @param string|null $login Login éventuel à afficher
     * @return void
     * @author Romain Card
     */
    public function displayConnexion(?Message $message = null, ?string $login = null): void
    {
        //On vérifie que l'utilisateur n'est pas déjà connecté
        $this->userNotLogged();

        // affichage de la vue
        $connexionView = new View('Connexion');
        $connexionView->generer(["message" => $message, "login" => $login ?? null]);
    }

    /**
     * Exécute la connexion de l'utilisateur
     * @param array $data Données du formulaire
     * @return void
     * @author Romain Card
     */
    public function Connexion(array $data): void
    {
        //On vérifie que l'utilisateur n'est pas déjà connecté
        $this->userNotLogged();

        // Manager de l'utilisateur
        $utilisateurManager = new UtilisateurManager();
        $res = $utilisateurManager->checkLogin($data["login"], $data["password"]);

        if (!$res['success']) throw new \Exception($res['message']);

        // Création du token de connexion
        $tokensManager = new TokensManager();
        $token = $tokensManager->createToken($res['utilisateur']->getIdUtilisateur());

        if ($token === null) throw new \Exception("Une erreur est survenue lors de la connexion");
        
        // Connexion
        $_SESSION['auth_token'] = $token->getToken();

        // Redirection
        header('Location: accueil');
    }

    /**
     * Affiche la page d'inscription
     * @param Message|null $message Message éventuel à afficher
     * @return void
     * @author Valentin Colindre
     */
    public function displayInscription(?Message $message = null):void
    {
        //On vérifie que l'utilisateur n'est pas déjà connecté
        $this->userNotLogged();

        // ensembles des manières de connaitre l'association
        $connaissancesAssociation = new ConnaissancesAssociationManager();
        // ensembles des types de logement contre services proposé
        $typeLogement = new TypeLogementManager();
        // ensembles des types d'habitation possibles
        $slogement = new SLogementsManager();
        // ensembles des domaines d'études considérés
        $edomaineEtude = new EDomainesEtudeManager();
        // ensembles des situations familiales considérés
        $ssituations = new SSituationsManager();
        // ensembles des niveaux de la famille
        $spresenceFamilles = new SPresenceFamillesManager();
        // si tes locataires ou si propriétaires
        $spropriete = new SProprietesManager();
        // ensembles des besoins des Seniors
        $sbesoins = new SBesoinsManager();

        // affichage de la vue
        $inscriptionView = new View('Inscription');
        $inscriptionView->generer(["message" => $message,
            "option_connaissances" => $connaissancesAssociation->getAll(),
            "type_logement" => $typeLogement->getAll(),
            "SLogement" => $slogement->getAll(),
            "EdomaineEtudes" => $edomaineEtude->getAll(),
            "SSistuation" => $ssituations->getAll(),
            "SPresenceFamilles" => $spresenceFamilles->getAll(),
            "SProprietes" => $spropriete->getAll(),
            "SBesoin" => $sbesoins->getAll()
        ]);
    }

    /**
     * Exécute l'inscription de l'utilisateur
     * @param array $data Données du formulaire
     * @return void
     * @author Valentin Colindre
     */
    public function Inscription(array $data): void
    {
        //On vérifie que l'utilisateur n'est pas déjà connecté
        $this->userNotLogged();

        //On crée un nouvel Utilisateur
        $UManager = new UtilisateurManager();

        if($UManager->creationUtilisateur($data["login"],$data["password"],1)){

            //On ajoute son id à l'array de donnée
            $data["idUtilisateur"]= $UManager->getByLogin($data["login"])->getIdUtilisateur();
            //Puis on crée un nouvel InfoUtilisateurs à partir de l'id de l'Utilisateur
            // et les données de Data
            $IUManager = new InfoUtilisateursManager();

            $IUManager->creationInfoUtilisateur($data);

            //Si c'est un compte étudiant, on crée aussi un CompteEtudiant à partir de data dans la BDD
            if($data["typeCompte"]=="etudiant"){
                $CompteManager = new ComptesEtudiantsManager();

                $res = $CompteManager->creationCompteEtudiant($data);
                if(!empty($data["housing2_start"])){
                    $dispoManager = new EDisposManager();
                    $dispoArray = ["idCompteEtudiant"=>$CompteManager->getByIdUtilisateur($data["idUtilisateur"])->getIdCompteEtudiant(),
                        "heureDebut"=>$data["housing2_start"],
                        "heureFin"=>$data["housing2_end"]];
                    $dispoManager->creationEDispo($dispoArray);
                }
            }//Sinon on crée un CompteSenior dans la BDD
            else{
                $CompteManager = new ComptesSeniorsManager();

                $besoinsCompteManager = new CompteSeniorSBesoinManager();


                $res = $CompteManager->creationCompteSenior($data);
                foreach ($data["needs"] as $besoin){
                    $besoinParam = ["idCompteSenior"=>$CompteManager->getByIdUtilisateur($data["idUtilisateur"])->getIdCompteSenior(),
                        "idBesoin"=>$besoin];
                    $besoinsCompteManager->creationCompteSeniorSBesoin($besoinParam);
                }
            }

            if ($res) {
                $this->displayInscription(new Message("Votre compte a bien été créé, vous pouvez vous connecter !", "Inscription réussie", "success"));
            }
            else {
                $this->displayInscription(new Message("Erreur lors de la création du compte", "Erreur d'inscription", "danger"));
            }
        }//Sinon on affiche que le compte existe déjà
        else{
            $this->displayInscription(new Message("Login déjà utilisé", "Erreur d'inscription", "danger"));
        }
    }

    public function bloqueCompte(int $idUtilisateur):string|null{
        $res = null;

        $utilisateurManager = new UtilisateurManager();
        $tokenManager = new TokensManager();
        //On récupère le compte à bloquer pour vérifier son existence
        $compte = $utilisateurManager->getByID($idUtilisateur);
        if($compte!=null){
            //Puis on vérifie que le compte souhaitant bloquer a les permissions pour
            if($compte->getIdRole()<=$utilisateurManager->getByID($tokenManager->getByToken($_SESSION["auth_token"])->getIdUtilisateur())->getIdRole()){
                $compteBloqueManager = new ComptesBloquesManager();
                $compteBloqueManager->creationCompteBloque($idUtilisateur);
            }
            else{
                $res="Vous n'êtes pas autorisé à bloquer ce compte";
            }
        }
        else{
            $res="Ce compte n'existe pas.";
        }

        return $res;
    }

    public function debloqueCompte(int $idUtilisateur):bool{
        $res = null;

        $utilisateurManager = new UtilisateurManager();
        $tokenManager = new TokensManager();
        //On vérifie que le compte à débloquer existe
        $compte = $utilisateurManager->getByID($idUtilisateur);
        if($compte!=null){
            //Puis on vérifie que le compte souhaitant débloquer a les permissions pour
            if($compte->getIdRole()<=$utilisateurManager->getByID($tokenManager->getByToken($_SESSION["auth_token"])->getIdUtilisateur())->getIdRole()){
                $compteBloqueManager = new ComptesBloquesManager();
                //Puis on vérifie si l'utilisateur à débloquer est bien bloqué
                if($compteBloqueManager->getByIdUtilisateur($idUtilisateur)!=null)
                    $compteBloqueManager->deleteByIdUtilisateur($idUtilisateur);
                else
                    $res="Ce compte n'est pas bloqué.";

            }
            else{
                $res="Vous n'êtes pas autorisé à débloquer ce compte.";
            }
        }
        else{
            $res="Ce compte n'existe pas.";
        }

        return $res;
    }


    /**
     * vérifie si l'utilisateur est du staff ou pas (modérateur/admin)
     * @return bool vrai ou faux
     * @author Valentin Colindre
     */
    public function isStaff():bool{
        $res=false;
        $tokenManager = new TokensManager();
        $tokenOk = $tokenManager->checkToken($_SESSION['auth_token']);

        if ($tokenOk) {
            $token = $tokenManager->getByToken($_SESSION['auth_token']);
            $idUtilisateur = $token->getIdUtilisateur();

            $utilisateurManager = new UtilisateurManager();
            $res = $utilisateurManager->isStaff($idUtilisateur);
        }
        return $res;
    }


    /**
     * Affiche la page de gestion de compte du backoffice
     * @param Message|null $message le message à passer ou null
     * @return void
     * @author Valentin Colindre
     */
    public function BackofficeGestionCompte(Message $message=null):void{
        $res = false;

        if (!empty($_SESSION['auth_token'])) {
            $res=$this->isStaff();
        }
        if(!$res) header('Location: accueil');
        else{

            $utilisateurs=array();

            $utilisateurManager = new UtilisateurManager();
            $tokenManager = new TokensManager();
            $token = $tokenManager->getByToken($_SESSION['auth_token']);
            $idUtilisateur = $token->getIdUtilisateur();
            foreach($utilisateurManager->getAll() as $utilisateur){

                //On récupère les infos du compte
                $infosManager = new InfoUtilisateursManager();
                $infosUtilisateur = $infosManager->getByIdUtilisateur($utilisateur->getIdUtilisateur());

                //On vérifie si l'utilisateur est un senior ou non
                $seniorManager = new ComptesSeniorsManager();
                $isSenior = $seniorManager->getByIdUtilisateur($utilisateur->getIdUtilisateur())!=null;

                $etudiantManager = new ComptesEtudiantsManager();
                $isEtudiant = $etudiantManager->getByIdUtilisateur($utilisateur->getIdUtilisateur())!=null;

                //On récupère le role de l'utilisateur
                $role="";
                $rolesManager = new RolesManager();
                foreach ($rolesManager->getAll() as $r){
                    if($r->getIdRole()==$utilisateur->getIdRole()) $role=$r->getType();
                }

                $bloqueManager = new ComptesBloquesManager();
                $bloque=$bloqueManager->getByIdUtilisateur($utilisateur->getIdUtilisateur())!=null;

                $isAdmin = $utilisateurManager->getByID($idUtilisateur)->getIdRole()>=3;


                $utilisateurs[]=[
                    "utilisateur"=>$utilisateur,
                    "infosUtilisateur"=>$infosUtilisateur,
                    "isSenior"=>$isSenior,
                    "isEtudiant"=>$isEtudiant,
                    "role"=>$role,
                    "bloque"=>$bloque,
                    "isAdmin"=>$isAdmin
                ];
            }

            // affichage de la vue
            $connexionView = new View('GestionCompte');
            $connexionView->generer(["message" => $message,"utilisateurs"=>$utilisateurs]);
        }
    }

    public function Deco(): void
    {
        //On supprime le token de la session si l'utilisateur est connecté
        if (!empty($_SESSION['auth_token'])) unset ($_SESSION['auth_token']);

        session_destroy();

        // Redirection
        header('Location: connexion');
    }
}