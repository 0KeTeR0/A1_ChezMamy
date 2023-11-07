<?php
namespace App\ChezMamy\models;



/**
 * Représentation de la table COMPTES_SENIORS
 * de la BD
 * @author Valentin Colindre
 */
Class ComptesEtudiantsManager extends Model{


    /**
     * Créer un nouveau compte Etudiant à partir des champs
     * nécessaires. Renvoi vrai si l'opération
     * a été un succès. Faux sinon.
     * @param array $params liste des paramètres pour le compte Etudiant.
     * @return bool vrai si réussite, faux si échec.
     * @author Valentin Colindre
     */
    public function creationCompteEtudiant(array $params):bool{
        $result = false;
        if($this->getByIdUtilisateur($params['idUtilisateur'])==null){

            if($this->execRequest("INSERT INTO COMPTES_ETUDIANTS (niveauEtude,stages,etablissementEtude,dateFinEtude,dateArriveeRegion,motivations,permisDeConduire,allergique,allergies,moyenLocomotion,f3BudgetMax,idDomaineEtude,idUtilisateur) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)",
                    array($params["niveauEtude"],$params["stages"],$params["etablissementEtude"],$params["dateFinEtude"],$params["dateArriveeRegion"],$params["motivations"],$params["permisDeConduire"],$params["allergique"],$params["allergies"],$params["moyenLocomotion"],$params["f3BudgetMax"],$params["idDomaineEtude"],$params["idUtilisateur"]))!==false){
                $result=true;
            }
        }
        return $result;
    }


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
        if($result!==false){
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
        if($result!==false){
            $utilisateur = new CompteEtudiant();
            $utilisateur->hydrate($result);
        }
        else $utilisateur=null;

        return $utilisateur;
    }
}