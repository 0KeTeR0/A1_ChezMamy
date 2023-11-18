<?php

namespace App\ChezMamy\models\Offres;


use App\ChezMamy\models\model;

/**
 * Représentation de la table Images_Offres de la BD
 * @author Louis Demeocq
 */
class ImagesOffresManager extends model
{
    /**
     * Crée une nouvelle imagesOffre
     * @param string $lienImage le lien vers l'image poster
     * @param int $idOffre l'id de l'offre qui contient l'image
     * @return bool vraie si réussi, faux si échec
     * @author Louis Demeocq
     */
    public function creationImagesOffres(string $lienImage, int $idOffre): bool
    {
        $result = false;
        if ($this->execRequest("INSERT INTO IMAGES_OFFRE (LienImage, idOffre) VALUES(?,?)", array($lienImage, $idOffre)) !== false){
            $result = true;
        }
        return $result;
    }

    /**
     * Récupère l'offre d'id idOffres
     * @param int $idOffres l'ID de l'offre recherchée
     * @return Offre|null renvoi l'offre ou rien si elle n'existe pas dans la DB.
     * @author Louis Demeocq
     */
    public function getByIdOffres(int $idOffres):?Offre
    {
        $result = $this->execRequest("SELECT * FROM OFFRES WHERE idOffre=?", array($idOffres))->fetch();
        if ($result != false){
            $offre = new Offre();
            $offre->hydrate($result);
        }
        else $offre = null;

        return $offre;
    }

    /**
     * Récupère toutes les imagesOffres de la DB
     * @return array contient toutes les imagesOffres de la DB
     * @author Louis Demeocq
     */
    public function getAll():array{
        $result = $this->execRequest("SELECT * FROM INFOS_OFFRES");
        $images_array = array();
        foreach($result->fetchAll() as $image){
            $image_object = new ImagesOffre();
            $image_object->hydrate($image);
            $images_array[] = $image_object;
        }
        return $images_array;
    }
}