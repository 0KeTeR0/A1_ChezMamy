<?php
namespace App\ChezMamy\models;

use Utilisateur;

/**
 * Représentation de la table UTILISATEURS
 * de la BD
 * @author Valentin Colindre
 */
Class UtilisateurManager extends Model{

    /**
     * Récupère tout les utilisateurs de la DB
     * @return array array contenant tous les utilisateurs de la DB
     * @author Valentin Colindre
     */
    public function getAll():Array{
        $result = $this->execRequest("SELECT * FROM UTILISATEURS");
        $utilisateur_array=array();
        foreach($result->fetchAll() as $utilisateur){
            $utilisateur_object = new Utilisateur();
            $utilisateur_object->hydrate($utilisateur);
            $utilisateur_array[] = $utilisateur_object;
        }
        return $utilisateur_array;
    }

    /**
     * récupère l'utilisateur d'id $idUtilisateur
     * @param int $idUtilisateur l'ID de l'utilisateur recherché
     * @return Utilisateur|null renvoi l'utilisateur ou rien s'il n'existe pas dans la DB.
     * @author Valentin Colindre
     */
    public function getByID(int $idUtilisateur):?Utilisateur{
        $result = $this->execRequest("SELECT * FROM UTILISATEURS WHERE idUtilisateur=?",array($idUtilisateur))->fetch();
        if($result!=null){
            $utilisateur = new Utilisateur();
            $utilisateur->hydrate($result);
        }
        else $utilisateur=null;

        return $utilisateur;
    }

    /**
     * récupère l'utilisateur de login $loginUtilisateur
     * @param int $loginUtilisateur le login de l'utilisateur recherché
     * @return Utilisateur|null renvoi l'utilisateur ou rien s'il n'existe pas dans la DB.
     * @author Valentin Colindre
     */
    public function getByLogin(int $loginUtilisateur):?Utilisateur{
        $result = $this->execRequest("SELECT * FROM UTILISATEURS WHERE login=?",array($loginUtilisateur))->fetch();
        if($result!=null){
            $utilisateur = new Utilisateur();
            $utilisateur->hydrate($result);
        }
        else $utilisateur=null;

        return $utilisateur;
    }
}