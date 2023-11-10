<?php

namespace App\ChezMamy\models;


/**
 * Le manager des infos complémentaires d'une offre.
 * De la table INFOS_COMPLEMENTAIRES
 * @author Valentin Colindre
 */
class InfosComplementairesManager extends Model
{


    /**
     * Créer un nouvel InfosComplementaires à partir des champs
     * nécessaires. Renvoi vrai si l'opération
     * a été un succès. Faux sinon.
     * @param string $adresse adresse de l'offre
     * @param int $idInfosOffre id de l'infosOffre lié
     * @param string $Description description de l'offre
     * @return bool vrai si réussite, faux si échec.
     * @author Valentin Colindre
     */
    public function creationInfosComplementaires(string $adresse, int $idInfosOffre, string $Description):bool{
        $result = false;
        if($this->getByIdInfosOffre($idInfosOffre)==null){

            if($this->execRequest("INSERT INTO INFOS_COMPLEMENTAIRES (Adresse,IdInfosOffre,Description) VALUES(?,?,?)",array($adresse,$idInfosOffre,$Description))!==false){
                $result=true;
            }
        }
        return $result;
    }

    /**
     * récupère l'InfosComplementaire qui détient la clé étrangère idInfosOffre
     * de la valeur donnée en paramètre
     * @param int $idInfosOffre l'ID de l'infoOffre
     * @return InfosComplementaires|null renvoi l'InfosComplementaires ou rien s'il n'existe pas dans la DB.
     * @author Valentin Colindre
     */
    public function getByIdInfosOffre(int $idInfosOffre):?InfosComplementaires{
        $result = $this->execRequest("SELECT * FROM INFOS_COMPLEMENTAIRES WHERE idInfosOffre=?",array($idInfosOffre))->fetch();
        if($result!==false){
            $val = new InfosComplementaires();
            $val->hydrate($result);
        }
        else $val=null;

        return $val;
    }
}