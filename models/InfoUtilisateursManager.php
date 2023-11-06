<?php

namespace App\ChezMamy\models;



/**
 * Représentation de la table INFO_UTILISATEUR
 * de la BD
 * @author Valentin Colindre
 */
Class InfoUtilisateursManager extends Model{

    /**
     * Récupère tout les InfoUtilisateur de la DB
     * @return array array contenant tous les InfoUtilisateur de la DB
     * @author Valentin Colindre
     */
    public function getAll():Array{
        $result = $this->execRequest("SELECT * FROM INFO_UTILISATEUR");
        $utilisateur_array=array();
        foreach($result->fetchAll() as $utilisateur){
            $utilisateur_object = new InfoUtilisateur();
            $utilisateur_object->hydrate($utilisateur);
            $utilisateur_array[] = $utilisateur_object;
        }
        return $utilisateur_array;
    }

    /**
     * récupère l'InfoUtilisateur d'id $idInfosUtilisateur
     * @param int $idInfosUtilisateur l'ID de l'InfoUtilisateur recherché
     * @return InfoUtilisateur|null renvoi l'utilisateur ou rien s'il n'existe pas dans la DB.
     * @author Valentin Colindre
     */
    public function getByID(int $idInfosUtilisateur):?InfoUtilisateur{
        $result = $this->execRequest("SELECT * FROM INFO_UTILISATEUR WHERE idInfosUtilisateur=?",array($idInfosUtilisateur))->fetch();
        if($result!=null){
            $utilisateur = new InfoUtilisateur();
            $utilisateur->hydrate($result);
        }
        else $utilisateur=null;

        return $utilisateur;
    }

    /**
     * récupère l'InfoUtilisateur d'idUtilisateur $idUtilisateur
     * @param int $idUtilisateur l'idUtilisateur de l'InfoUtilisateur recherché
     * @return InfoUtilisateur|null renvoi l'InfoUtilisateur ou rien s'il n'existe pas dans la DB.
     * @author Valentin Colindre
     */
    public function getByIdUtilisateur(int $idUtilisateur):?InfoUtilisateur{
        $result = $this->execRequest("SELECT * FROM INFO_UTILISATEUR WHERE idUtilisateur=?",array($idUtilisateur))->fetch();
        if($result!=null){
            $utilisateur = new InfoUtilisateur();
            $utilisateur->hydrate($result);
        }
        else $utilisateur=null;

        return $utilisateur;
    }
}