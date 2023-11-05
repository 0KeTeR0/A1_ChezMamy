<?php
namespace App\ChezMamy\models;

use CompteEtudiant;

/**
 * Représentation de la table COMPTES_SENIORS
 * de la BD
 * @author Valentin Colindre
 */
Class ComptesEtudiantsManager extends Model{

    /**
     * Récupère tout les CompteEtudiant de la DB
     * @return array array contenant tous les CompteEtudiant de la DB
     * @author Valentin Colindre
     */
    public function getAll():Array{
        $result = $this->execRequest("SELECT * FROM COMPTES_ETUDIANTS");
        $utilisateur_array=array();
        foreach($result->fetchAll() as $utilisateur){
            $utilisateur_object = new CompteEtudiant();
            $utilisateur_object->hydrate($utilisateur);
            $utilisateur_array[] = $utilisateur_object;
        }
        return $utilisateur_array;
    }

    /**
     * récupère le CompteEtudiant d'id $idCompteEtudiant
     * @param int $idCompteEtudiant l'ID du CompteEtudiant recherché
     * @return CompteEtudiant|null renvoi le CompteEtudiant ou rien s'il n'existe pas dans la DB.
     * @author Valentin Colindre
     */
    public function getByID(int $idCompteEtudiant):?CompteEtudiant{
        $result = $this->execRequest("SELECT * FROM COMPTES_ETUDIANTS WHERE idCompteEtudiant=?",array($idCompteEtudiant))->fetch();
        if($result!=null){
            $utilisateur = new CompteEtudiant();
            $utilisateur->hydrate($result);
        }
        else $utilisateur=null;

        return $utilisateur;
    }

    /**
     * récupère le CompteEtudiant d'idUtilisateur $idUtilisateur
     * @param int $idUtilisateur l'idUtilisateur du CompteEtudiant recherché
     * @return CompteEtudiant|null renvoi le CompteEtudiant ou rien s'il n'existe pas dans la DB.
     * @author Valentin Colindre
     */
    public function getByIdUtilisateur(int $idUtilisateur):?CompteEtudiant{
        $result = $this->execRequest("SELECT * FROM COMPTES_ETUDIANTS WHERE idUtilisateur=?",array($idUtilisateur))->fetch();
        if($result!=null){
            $utilisateur = new CompteEtudiant();
            $utilisateur->hydrate($result);
        }
        else $utilisateur=null;

        return $utilisateur;
    }
}