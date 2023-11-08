<?php

namespace App\ChezMamy\models;



/**
 * Représentation de la table INFO_UTILISATEUR
 * de la BD
 * @author Valentin Colindre
 */
Class InfoUtilisateursManager extends Model{

    /**
     * Créer un nouvel infoUtilisateur à partir des champs
     * nécessaires. Renvoi vrai si l'opération
     * a été un succès. Faux sinon.
     * @param array $params liste des paramètres pour l'infoUtilisateur.
     * @return bool vrai si réussite, faux si échec.
     * @author Valentin Colindre
     */
    public function creationInfoUtilisateur(array $params):bool{
        $result = false;
        if($this->getByIdUtilisateur($params['idUtilisateur'])==null){

            if($this->execRequest("INSERT INTO INFO_UTILISATEUR (mail,numero,nom,prenom,dateDeNaissance,ville,codePostal,fumeur,interets,raison,idUtilisateur,idTypeLogement,idConnaissanceAssociation) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)",array($params['mail'],$params['numero'],$params['nom'],$params['prenom'],$params['dateDeNaissance'],$params['ville'],$params['codePostal'],$params['fumeur'],$params['interets'],$params['raison'],$params['idUtilisateur'],$params['idTypeLogement'],$params['idConnaissanceAssociation']))!==false){
                $result=true;
            }
        }
        return $result;
    }

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
        if($result!==false){
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
        if($result!==false){
            $utilisateur = new InfoUtilisateur();
            $utilisateur->hydrate($result);
        }
        else $utilisateur=null;

        return $utilisateur;
    }
}