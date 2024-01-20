<?php

namespace App\ChezMamy\models\Offres;

use App\ChezMamy\models\model;

/**
 * Représentation de la table OFFRES_SIGNALEES de la BD
 * @author Valentin Colindre
 */
class OffresSignaleesManager extends model
{

    /**
     * Crée un nouveau signalement
     * @param int $idUtilisateur l'id d'utilisateur qui signale
     * @param int $idOffre l'id de l'offre
     * @return bool vraie si réussie, faux si échec
     * @author Valentin Colindre
     */
    public function creationSignalement(int $idUtilisateur, int $idOffre): bool
    {
        // si l'utilisateur n'a pas déjà signalé l'offre alors true sinon false
        try {
            if ($this->execRequest("INSERT INTO OFFRES_SIGNALEES (idOffre, idUtilisateur) VALUES(?,?)", array($idOffre, $idUtilisateur)) !== false) {
                $result = true;
            }
        }
        catch (\Exception $e){
            $result = false;
        }
        return $result;
    }

    /**
     * Récupère tout les signalements d'offre de la DB
     * @return array contient toutes les offres de la DB
     * @author Valentin Colindre
     */
    public function getAll(): array
    {
        $result = $this->execRequest("SELECT * FROM OFFRES_SIGNALEES");
        $offres_array = array();
        foreach ($result->fetchAll() as $offre) {
            $offre_object = new OffreSignalee();
            $offre_object->hydrate($offre);
            $offres_array[] = $offre_object;
        }
        return $offres_array;
    }


    /**
     * Supprime les signalements d'id $idOffre dans la BDD
     * @param int $idOffre l'id du signalement que l'on veut supprimer
     * @return bool renvoie True si la requête est bien exécuté
     * @author Valentin Colindre
     */
    public function deleteByIdOffre(int $idOffre): bool
    {
        $result = false;
        if ($this->execRequest("DElETE FROM OFFRES_SIGNALEES WHERE idOffre=?", array($idOffre)) !== false) {
            $result = true;
        }
        return $result;
    }

}