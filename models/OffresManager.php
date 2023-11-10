<?php

namespace App\ChezMamy\models;

/**
 * Représentation de la table Offre de la BD
 * @author Louis Demeocq
 */
class OffresManager extends model
{

    /**
     * Crée une nouvelle offre
     * @param int $idUser l'id d'utilisateur qui ajoute l'offre
     * @param string $titreOffre le titre de l'offre
     * @return bool vraie si réussie, faux si échec
     */
    public function creationOffres(int $idUser, string $titreOffre): bool
    {
        $result = false;
        $nbrOffres = $this->execRequest("SELECT COUNT(*) FROM OFFRES WHERE idutilisateur=?", array($idUser))->fetch();
        if($nbrOffres < 5)
        {
            if ($this->execRequest("INSERT INTO OFFRES (titreOffre, idUser) VALUES(?,?)", array($titreOffre, $idUser)) !== false){
                $result = true;
            }
        }
        return $result;
    }

    /**
     * Récupère toutes les offres de la DB
     * @return array contient toutes les offres de la DB
     * @author Louis Demeocq
     */
    public function getAll():array{
        $result = $this->execRequest("SELECT * FROM OFFRES");
        $offres_array = array();
        foreach($result->fetchAll() as $offre){
            $offre_object = new Offre();
            $offre_object->hydrate($offre);
            $offres_array[] = $offre_object;
        }
        return $offres_array;
    }

}