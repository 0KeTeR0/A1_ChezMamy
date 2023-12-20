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


    /**
     * Renvoi la liste des besoins liés à une offre
     * @param int $idInfosOffre Id de l'infoOffre lié aux besoins
     * @return array Liste des besoins
     * @author Valentin Colindre
     */
    public function GetAllByIdInfosOffre(int $idInfosOffre):?array{
        $result = $this->execRequest("SELECT * FROM BESOINS_OFFRES WHERE idInfosOffre=?", array($idInfosOffre))->fetchAll();
        if ($result != false){
            $besoins = array();
            foreach ($result as $besoin){
                $besoinInstance = new BesoinOffres();
                $besoinInstance->hydrate($besoin);
                $besoins[] = $besoinInstance;
            }
        }
        else $besoins = null;

        return $besoins;
    }

    /**
     * Supprimes les besoinsOffres d'id $idInfosOffre dans la BDD
     * @param int $idInfosOffre l'id des besoinsOffres que l'on veut supprimer
     * @return bool renvoie True si la requête est bien exécuté
     * @author Louis Dememocq
     */
    public function deleteByIdOffre(int $idInfosOffre): bool
    {
        $result = false;
        if ($this->execRequest("DElETE FROM BESOINS_OFFRES WHERE idInfosOffre=?", array($idInfosOffre)) !== false) {
            $result = true;
        }
        return $result;
    }
}