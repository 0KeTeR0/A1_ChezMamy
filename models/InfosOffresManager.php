<?php

namespace App\ChezMamy\models;

/**
 * Représentation de la table InfosOffres de la BD
 * @author Louis Demeocq
 */
class InfosOffresManager extends model
{
    /**
     * Crée une nouvelle infosOffre
     * @param int $idOffre l'id de l'offre qui contient les infos
     * @param int $superficie la valeur de la superficie (chambre)
     * @param int $idLogement l'id du logement
     * @return bool vraie si réussie, faux si échec
     * @author Louis Demeocq
     */
    public function creationInfosOffres(int $idOffre, int $superficie,int $idLogement): bool
    {
        $result = false;
        if ($this->getByIdOffres($idOffre) == null){
            if ($this->execRequest("INSERT INTO INFOS_OFFRES (idOffre, SuperficieDeLaChambre,idLogement ) VALUES(?,?)", array($idOffre, $superficie,$idLogement)) !== false){
                $result = true;
            }
        }
        return $result;
    }

    /**
     * Récupère l'offreInfo d'id idOffres
     * @param int $idOffres l'ID de l'offre recherchée
     * @return infosOffre|null renvoi l'InfoOffre ou rien si elle n'existe pas dans la DB.
     * @author Louis Demeocq
     */
    public function getByIdOffres(int $idOffres):?infosOffre
    {
        $result = $this->execRequest("SELECT * FROM INFOS_OFFRES WHERE idOffre=?", array($idOffres))->fetch();
        if ($result != false){
            $offre = new infosOffre();
            $offre->hydrate($result);
        }
        else $offre = null;

        return $offre;
    }

    /**
     * Récupère toutes les infos de la DB
     * @return array contient toutes les infosOffres de la DB
     * @author Louis Demeocq
     */
    public function getAll():array{
        $result = $this->execRequest("SELECT * FROM INFOS_OFFRES");
        $infos_array = array();
        foreach($result->fetchAll() as $infos){
            $infos_object = new infosOffre();
            $infos_object->hydrate($infos);
            $infos_array[] = $infos_object;
        }
        return $infos_array;
    }
}