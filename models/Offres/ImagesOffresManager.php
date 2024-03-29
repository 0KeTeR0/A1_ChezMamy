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
     * Récupère une image offre d'id idOffres
     * @param int $idOffres l'ID de l'image offre recherchée
     * @return ImagesOffre|null renvoi l'imageOffre ou rien si elle n'existe pas dans la DB.
     * @authors Louis Demeocq, Valentin Colindre
     */
    public function getOneByIdOffres(int $idOffres):?ImagesOffre
    {
        $result = $this->execRequest("SELECT * FROM IMAGES_OFFRE WHERE idOffre=?", array($idOffres))->fetch();
        if ($result != false){
            $offre = new ImagesOffre();
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
        $result = $this->execRequest("SELECT * FROM IMAGES_OFFRE");
        $images_array = array();
        foreach($result->fetchAll() as $image){
            $image_object = new ImagesOffre();
            $image_object->hydrate($image);
            $images_array[] = $image_object;
        }
        return $images_array;
    }

    /**
     * Supprime les images offres d'id $idOffre dans la BDD
     * @param string $link le lien des images
     * @return bool renvoie True si la requête est bien exécuté
     * @authors Louis Dememocq, Valentin Colindre
     */
    public function deleteByLink(string $link): bool
    {
        $result = false;
        if ($this->execRequest("DElETE FROM IMAGES_OFFRE WHERE LienImage=?", array($link)) !== false) {
            $result = true;
        }
        return $result;
    }

}