<?php

namespace App\ChezMamy\models\Offres;

use App\ChezMamy\models\Model;
use App\ChezMamy\models\Utilisateurs\Utilisateur;

/**
 * Le manager des liaisons entre les offres et les étudiants
 * @author Louis Demeocq
 */
class OffresPostulerManager extends Model
{
    /**
     * Crée un nouveau lien utilisateurs et offres
     * @param int $idUtilisateur id de l'utilisateur
     * @param int $idOffre id de l'offre
     * @return bool vraie si réussie, faux si échec
     * @author Louis Demeocq
     */
    public function creationPostulerOffres(int $idUtilisateur, int $idOffre) : bool
    {
        $result = false;
        $resultTest = $this->execRequest("SELECT * FROM OFFRES_POSTULEES WHERE $idUtilisateur=? AND $idOffre=?", array($idUtilisateur, $idOffre))->fetch();
        if($resultTest == false){
            if($this->execRequest("INSERT INTO OFFRES_POSTULEES (idUtilisateur, idOffre) VALUES(?,?)",array($idUtilisateur,$idOffre)) !== false) {
                $result = true;
            }
        }
        return $result;
    }

    /**
     * Renvoi la liste des utilisateurs qui ont postulé pour cette offre
     * @param int $idOffre Id de l'offre liée aux utilisateurs
     * @return array Liste des utilisateurs
     * @author Louis Demeocq
     */
    public function getAllByIdOffre(int $idOffre):?array
    {
        $result = $this->execRequest("SELECT * FROM OFFRES_POSTULEES WHERE $idOffre=?", array($idOffre))->fetchAll();
        if ($result != false) {
            $utilisateurs = array();
            foreach ($result as $utilisateur){
                $utilisateurInstance = new Utilisateur();
                $utilisateurInstance->hydrate($utilisateur);
                $utilisateurs[] = $utilisateurInstance;
            }
        }
        else $utilisateurs = null;

        return $utilisateurs;
    }

    /**
     * Supprimes les offresPostuler d'id $idOffre dans la BDD
     * @param int $idOffre l'id des offresPostuler que l'on veut supprimer
     * @return bool renvoie True si la requête est bien exécuté
     * @author Louis Demeocq
     */
    public function deleteByIdOffre(int $idOffre): bool
    {
        return $this->execRequest("DELETE FROM OFFRES_POSTULEES WHERE $idOffre=?", array($idOffre));
    }


}

