<?php

namespace App\ChezMamy\models\Utilisateurs\Etudiants;


use App\ChezMamy\models\Model;

/**
 * Le manager des dispos de l'étudiant de EDispos
 * @author Valentin Colindre
 */
class EDisposManager extends Model
{


    /**
     * Créer un nouvel EDispo à partir des champs
     * nécessaires. Renvoi vrai si l'opération
     * a été un succès. Faux sinon.
     * @param array $params liste des paramètres pour EDispo.
     * @return bool vrai si réussite, faux si échec.
     * @author Valentin Colindre
     */
    public function creationEDispo(array $params):bool{
        $result = false;
        if($this->getByIdCompteEtudiant($params['idCompteEtudiant'])==null){

            if($this->execRequest("INSERT INTO E_DISPOS (heureDebut,heureFin,idCompteEtudiant) VALUES(?,?,?)",array($params['heureDebut'],$params['heureFin'],$params['idCompteEtudiant']))!==false){
                $result=true;
            }
        }
        return $result;
    }

    /**
     * récupère l'EDispo d'id $idCompteEtudiant
     * @param int $idCompteEtudiant l'ID de l'EDispo recherché
     * @return EDispo|null renvoi l'EDispo ou rien s'il n'existe pas dans la DB.
     * @author Valentin Colindre
     */
    public function getByIdCompteEtudiant(int $idCompteEtudiant):?EDispo{
        $result = $this->execRequest("SELECT * FROM E_DISPOS WHERE idCompteEtudiant=?",array($idCompteEtudiant))->fetch();
        if($result!==false){
            $utilisateur = new EDispo();
            $utilisateur->hydrate($result);
        }
        else $utilisateur=null;

        return $utilisateur;
    }
}