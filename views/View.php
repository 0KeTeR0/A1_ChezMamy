<?php
namespace App\ChezMamy\views;

use App\ChezMamy\models\TokensManager;
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
     * Génère et affiche la vue
     * @param array $donnees Données nécessaires à la vue
     * @return void
     * @author Romain Card
     */
    public function generer(array $donnees): void
    {
        // Vérifie si l'utilisateur est connecté
        $userLogged = !empty($_SESSION['auth_token']) ? (new TokensManager())->checkToken($_SESSION['auth_token']) : false;
        $donnees['userLogged'] = $userLogged;
        // Génération de la partie spécifique de la vue
        $contenu = $this->genererFichier($this->fichier, $donnees);
        // Génération du gabarit commun utilisant la partie spécifique
        $vue = $this->genererFichier('views/gabarit.php', array('titre' => $this->titre, 'contenu' => $contenu, 'userLogged' => $userLogged));
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