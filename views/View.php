<?php
namespace App\ChezMamy\views;

use App\ChezMamy\models\Utilisateurs\InfoUtilisateur;
use App\ChezMamy\models\Utilisateurs\InfoUtilisateursManager;
use App\ChezMamy\models\Utilisateurs\TokensManager;
use App\ChezMamy\models\Utilisateurs\Utilisateur;
use App\ChezMamy\models\Utilisateurs\UtilisateurManager;
use Exception;

/**
 * Classe View
 * Représente une vue
 */
class View
{
    private string $fichier;
    private string $titre;

    /**
     * Constructeur de la vue
     * @param string $action Action à laquelle la vue est associée
     * @author Romain Card
     */
    public function __construct(string $action)
    {
        // Détermination du nom du fichier vue à partir de l'action
        $this->fichier = "views/vue" . $action . ".php";
        $this->titre = $action;
    }

    /**
     * Récupère les traductions liées à la langue choisie
     * @param string $lang  Langue choisie
     * @return array
     * @author Romain Card
     */
    private function getTraductions(string $lang = "fr"): array
    {
        // Récupération des traductions liées à la langue choisie
        if(file_exists("views/langs/{$lang}.php")) $res = require_once("langs/{$lang}.php");
        else $res = require_once('langs/fr.php');

        return $res;
    }

    /**
     * @return Utilisateur|null Renvoi l'utilisateur connecté ou null si l'utilisateur n'est pas connecté
     * @author Romain Card
     */
    private function getUtilisateur(): ?Utilisateur
    {
        $tokenManager = new TokensManager();
        $userLogged = !empty($_SESSION['auth_token']) ? $tokenManager->checkToken($_SESSION['auth_token']) : false;
        $token = !empty($_SESSION['auth_token']) ? $tokenManager->getByToken($_SESSION['auth_token']) : null;

        if ($userLogged && $token !== null) {
            $idUtilisateur = $token->getIdUtilisateur();
            $utilisateurManager = new UtilisateurManager();
            $utilisateur = $utilisateurManager->getById($idUtilisateur);
        }
        else $utilisateur = null;

        return $utilisateur;
    }

    /**
     * @return \App\ChezMamy\models\Utilisateurs\InfoUtilisateur|null Renvoi les informations de l'utilisateur connecté ou null si l'utilisateur n'est pas connecté
     * @author Romain Card
     */
    private function getInfoUtilisateur(): ?InfoUtilisateur
    {
        $tokenManager = new TokensManager();
        $userLogged = !empty($_SESSION['auth_token']) ? $tokenManager->checkToken($_SESSION['auth_token']) : false;
        $token = !empty($_SESSION['auth_token']) ? $tokenManager->getByToken($_SESSION['auth_token']) : null;

        if ($userLogged && $token !== null) {
            $idUtilisateur = $token->getIdUtilisateur();
            $infosManager = new InfoUtilisateursManager();
            $infoUtilisateur = $infosManager->getByIdUtilisateur($idUtilisateur);
        }
        else $infoUtilisateur = null;

        return $infoUtilisateur;
    }

    /**
     * Génère et affiche la vue
     * @param array $donnees Données nécessaires à la vue
     * @return void
     * @author Romain Card
     */
    public function generer(array $donnees): void
    {
        // Vérifie si l'utilisateur est connecté et récupère les informations
        $donnees['infoUtilisateur'] = $this->getInfoUtilisateur();

        // Vérifie si l'utilisateur est un senior
        $isSenior = (!empty($_SESSION['auth_token']) && $this->getUtilisateur() !== null)  ? (new UtilisateurManager())->isSenior(($this->getUtilisateur())->getIdUtilisateur()) : false;
        $isEtudiant = (!empty($_SESSION['auth_token']) && $this->getUtilisateur() !== null)  ? (new UtilisateurManager())->isEtudiant(($this->getUtilisateur())->getIdUtilisateur()) : false;
        $isStaff = (!empty($_SESSION['auth_token']) && $this->getUtilisateur() !== null)  ? (new UtilisateurManager())->isStaff(($this->getUtilisateur())->getIdUtilisateur()) : false;


        // On récupère les traductions
        $donnees['traductions'] = $this->getTraductions($_GET['lang'] ?? "fr");
        $donnees['isEtudiant'] = $isEtudiant;
        $donnees['isStaff']=$isStaff;

        // Génération de la partie spécifique de la vue
        $contenu = $this->genererFichier($this->fichier, $donnees);
        // Génération du gabarit commun utilisant la partie spécifique
        $vue = $this->genererFichier('views/gabarit.php', array('titre' => $this->titre, 'contenu' => $contenu, 'traductions' => $donnees['traductions'], 'isSenior' => $isSenior, 'isEtudiant' => $isEtudiant, 'infoUtilisateur' => $donnees['infoUtilisateur'],"isStaff"=>$donnees['isStaff']));
        // Renvoi de la vue au navigateur
        echo $vue;
    }

    /**
     * Génère un fichier de vue et renvoie le résultat produit
     * @param string $fichier Fichier à générer
     * @param array $donnees Données nécessaires à la vue
     * @return string Résultat de la génération de la vue
     * @author Romain Card
     */
    private function genererFichier(string $fichier, array $donnees): string
    {
        if (file_exists($fichier)) {
            // Rend les éléments du tableau $donnees accessibles dans la vue
            // Voir la documentation de extract
            extract($donnees);
            // Démarrage de la temporisation de sortie
            ob_start();
            // Inclut le fichier vue
            // Son résultat est placé dans le tampon de sortie
            require $fichier;
            // Arrêt de la temporisation et renvoi du tampon de sortie
            return ob_get_clean();
        }
        else {
            throw new Exception("Fichier '$fichier' introuvable");
        }
    }
}