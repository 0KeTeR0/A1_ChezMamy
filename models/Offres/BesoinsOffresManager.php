<?php

namespace App\ChezMamy\models\Offres;


use App\ChezMamy\models\Model;

/**
 * Le manager des liaisons entre les types de besoin et les seniors
 * @author Valentin Colindre
 */
class BesoinsOffresManager extends Model
{
    /**
     * Créer un nouveau lien SBesoin & InfosOffres à partir des paramètres
     * nécessaires. Renvoi vrai si l'opération
     * a été un succès. Faux sinon.
     * @param int $idBesoin id du besoin
     * @param int $idInfosOffre id de l'offre
     * @return bool vrai si réussite, faux si échec.
     * @author Valentin Colindre
     */
    public function creationBesoinsOffre(int $idBesoin, int $idInfosOffre):bool{
        $result = false;
        $resultTest = $this->execRequest("SELECT * FROM BESOINS_OFFRES WHERE IdInfosOffre=? AND idBesoin=?",array($idInfosOffre,$idBesoin))->fetch();
        if($resultTest==false){
            if($this->execRequest("INSERT INTO BESOINS_OFFRES (IdInfosOffre,idBesoin) VALUES(?,?)",array($idInfosOffre,$idBesoin))!==false){
                $result=true;
            }
        }
        return $result;
    }


}