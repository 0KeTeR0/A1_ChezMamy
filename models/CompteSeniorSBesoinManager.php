<?php

namespace App\ChezMamy\models;


/**
 * Le manager des liaisons entre les types de besoin et les senios
 * @author Valentin Colindre
 */
class CompteSeniorSBesoinManager extends Model
{
    /**
     * Créer un nouveau lien compteSenior & SBesoin à partir des paramètres
     * nécessaires. Renvoi vrai si l'opération
     * a été un succès. Faux sinon.
     * @param array $params paramètres de l'objet
     * @return bool vrai si réussite, faux si échec.
     * @author Valentin Colindre
     */
    public function creationCompteSeniorSBesoin(array $params):bool{
        $result = false;
        $resultTest = $this->execRequest("SELECT * FROM COMPTE_SENIOR_S_BESOIN WHERE idCompteSenior=? AND idBesoin=?",array($params["idCompteSenior"],$params["idBesoin"]))->fetch();
        if($resultTest==false){
            if($this->execRequest("INSERT INTO COMPTE_SENIOR_S_BESOIN (idCompteSenior,idBesoin) VALUES(?,?)",array($params["idCompteSenior"],$params["idBesoin"]))!==false){
                $result=true;
            }

        }
        return $result;
    }


}