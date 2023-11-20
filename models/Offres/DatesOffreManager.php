<?php

namespace App\ChezMamy\models\Offres;


use App\ChezMamy\models\Model;
use DateTime;

/**
 * Le manager des dates d'une offre.
 * De la table DATES_OFFRE
 * @author Valentin Colindre
 */
class DatesOffreManager extends Model
{

    /**
     * Créer un nouvel DatesOffre à partir des champs
     * nécessaires. Renvoi vrai si l'opération
     * a été un succès. Faux sinon.
     * @param DateTime $DateDebut adresse de l'offre
     * @param int $idInfosOffre id de l'infosOffre lié
     * @param DateTime $DateFin description de l'offre
     * @return bool vrai si réussite, faux si échec.
     * @author Valentin Colindre
     */
    public function creationDatesOffre(DateTime $DateDebut, int $idInfosOffre, DateTime $DateFin):bool{
        $result = false;
        if($this->getByIdInfosOffre($idInfosOffre)==null){

            if($this->execRequest("INSERT INTO DATES_OFFRE (DateDebut,IdInfosOffre,DateFin) VALUES(?,?,?)",array($DateDebut->format('Y-m-d'),$idInfosOffre,$DateFin->format('Y-m-d')))!==false){
                $result=true;
            }
        }
        return $result;
    }

    /**
     * Récupère le DatesOffre qui détient la clé étrangère idInfosOffre
     * de la valeur donnée en paramètre
     * @param int $idInfosOffre l'ID de l'infoOffre
     * @return DatesOffre|null renvoi le DatesOffre ou rien s'il n'existe pas dans la DB.
     * @author Valentin Colindre
     */
    public function getByIdInfosOffre(int $idInfosOffre):?DatesOffre{
        $result = $this->execRequest("SELECT * FROM DATES_OFFRE WHERE idInfosOffre=?",array($idInfosOffre))->fetch();
        if($result!==false){
            $val = new DatesOffre();
            $val->hydrate($result);
        }
        else $val=null;

        return $val;
    }

    /**
     * Supprimes les datesOffre d'id $idInfosOffre dans la BDD
     * @param int $idInfosOffre l'id des datesOffres que l'on veut supprimer
     * @return bool renvoie True si la requête est bien exécuté
     * @author Louis Dememocq
     */
    public function deleteByIdOffre(int $idInfosOffre): bool
    {
        return $this->execRequest("DElETE FROM DATES_OFFRE WHERE $idInfosOffre=?", array($idInfosOffre));
    }
}