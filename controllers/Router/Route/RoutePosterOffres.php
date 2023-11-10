<?php

namespace App\ChezMamy\controllers\Router\Route;

use App\ChezMamy\controllers\OffresController;
use App\ChezMamy\controllers\Router\Route;
use App\ChezMamy\helpers\Message;

/*
 * Route pour la page poster des offres
 */
class RoutePosterOffres extends Route
{
    private OffresController $controller;

    /**
     * Prépare l'affichage de la page
     * @param OffresController $controller
     * @author Louis Demeocq
     */
    public function __construct(OffresController $controller)
    {
        parent::__construct();
        $this->controller = $controller;
    }

    /**
     * Affiche la page des offres
     * @param array $params Paramètres à passer à la page
     * @return void
     * @author Louis Demeocq
     */
    protected function get(array $params = []): void
    {
        $this->controller->displayPosterOffres();
    }

    /**
     * Exécute une action
     * @param array $params Paramètres à passer à l'exécution
     * @return void
     * @author Louis Demeocq
     */
    protected function post(array $params = []): void
    {
        $error = null;
        try{
            $nbrFiles = count($_FILES['imagesOffre']['name']);
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
            // vérification des données passée dans le formulaire
            $data = [
                "TitreDeLoffre"=>$this->getParam($params,"TitreDeLoffre",false),
                "Housing"=>$this->getParam($params,"housing",false),
                "needs"=>$this->getParam($params,"needs",false),
                "date_debut_offre"=>date('Y-m-d',strtotime($this->getParam($params,"date_debut_offre",false))),
                "date_fin_offre"=>date('Y-m-d',strtotime($this->getParam($params,"date_fin_offre",false))),
                "adresseLogement"=>$this->getParam($params,"adresseLogement"),
                "surfaceChambre"=>$this->getParam($params,"room_surface",false),
                "descriptionOffre"=>$this->getParam($params,"descriptionOffre"),
                "imagesOffre"=>$chemins
            ];
            if(strtotime($this->getParam($params,"date_fin_offre")) <= strtotime($this->getParam($params,"date_debut_offre"))){
                throw new \Exception("La date de fin de l'offre doit être après celle de début");
            }
        }
        //Renvoi une erreur si quelque chose n'est pas correct
        catch (\Exception $e){
            $error=$e->getMessage();
        }
        if ($error!=null){
            $this->controller->displayPosterOffres(new Message("Erreur : ".$error, "Erreur d'envoie", "danger"));
        }

        else{
            $this->controller->posterOffres($data);
        }
    }
}