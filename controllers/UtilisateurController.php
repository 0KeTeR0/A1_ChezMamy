<?php
namespace App\ChezMamy\controllers;

use App\ChezMamy\helpers\Message;
use App\ChezMamy\models\Offres\TypeLogementManager;
use App\ChezMamy\models\Utilisateurs\ConnaissancesAssociationManager;
use App\ChezMamy\models\Utilisateurs\Etudiants\ComptesEtudiantsManager;
use App\ChezMamy\models\Utilisateurs\Etudiants\EDisposManager;
use App\ChezMamy\models\Utilisateurs\Etudiants\EDomainesEtudeManager;
use App\ChezMamy\models\Utilisateurs\InfoUtilisateursManager;
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
 */
class UtilisateurController
{
    /**
     * Vérifie que l'utilisateur ne soit pas connecté pour accéder aux inscription et connexion
     * Renvoie sur la page d'accueil si l'utilisateur est déjà connecté
     * @return void
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

    public function Deco(): void
    {
        //On supprime le token de la session si l'utilisateur est connecté
        if (!empty($_SESSION['auth_token'])) unset ($_SESSION['auth_token']);

        session_destroy();

        // Redirection
        header('Location: connexion');
    }
}