<?php

namespace App\ChezMamy\models\Offres;

use App\ChezMamy\models\model;

/**
 * Représentation de la table Offre de la BD
 * @author Louis Demeocq
 */
class OffresManager extends model
{

    /**
     * Crée une nouvelle offre
     * @param int $idUser l'id d'utilisateur qui ajoute l'offre
     * @param string $titreOffre le titre de l'offre
     * @return bool vraie si réussie, faux si échec
     * @author Louis Demeocq
     */
    public function creationOffres(int $idUser, string $titreOffre): bool
    {
        $result = false;
        $nbrOffres = $this->execRequest("SELECT COUNT(*) as nbOffres FROM OFFRES WHERE idUtilisateur=?", array($idUser))->fetch();
        if($nbrOffres['nbOffres'] < 5)
        {
            if ($this->execRequest("INSERT INTO OFFRES (TitreDeLoffre, idUtilisateur) VALUES(?,?)", array($titreOffre, $idUser)) !== false){
                $result = true;
            }
        }
        return $result;
    }

    /**
     * Récupère toutes les offres de la DB
     * @return array contient toutes les offres de la DB
     * @author Louis Demeocq
     */
    public function getAll():array{
        $result = $this->execRequest("SELECT * FROM OFFRES");
        $offres_array = array();
        foreach($result->fetchAll() as $offre){
            $offre_object = new Offre();
            $offre_object->hydrate($offre);
            $offres_array[] = $offre_object;
        }
        return $offres_array;
    }

    /**
     * Recherche les offres comportant nom dans leur titre
     * @param string $name nom servant de base de recherche
     * @return array|null Array de vingt offre maximum ou null
     * @author Valentin Colindre
     */
    public function getByName(string $name):?array{
        $result = $this->execRequest("SELECT * FROM OFFRES WHERE approbation = 1 AND TitreDeLoffre LIKE ? ORDER BY idOffre DESC LIMIT 20",array("%".$name."%"))->fetchAll();
        if($result!==false){
            $val = array();
            foreach ($result as $offre){
                $nOffre = new Offre();
                $nOffre->hydrate($offre);
                $val[] = $nOffre;
            }
        }
        else $val=null;

        return $val;
    }

    public function getByIdOffre(int $idOffre):?Offre{
        $result = $this->execRequest("SELECT * FROM OFFRES WHERE idOffre=?",array($idOffre))->fetch();
        if($result!==false){
            $val = new Offre();
            $val->hydrate($result);
        }
        else $val=null;

        return $val;
    }

    /**
     * Renvoi toutes les offres postées par un utilisateur
     * @param int $idUtilisateur id de l'utilisateur
     * @return array|null liste des utilisateur ou null
     * @author Valentin Colindre
     */
    public function getAllByIdUtilisateur(int $idUtilisateur):?array{
        $result = $this->execRequest("SELECT * FROM OFFRES WHERE idUtilisateur=?",array($idUtilisateur))->fetchAll();
        if($result!==false){
            $val = array();
            foreach ($result as $offre){
                $nOffre = new Offre();
                $nOffre->hydrate($offre);
                $val[] = $nOffre;
            }
        }
        else $val=null;

        return $val;
    }

    /**
     * Renvoi la dernière offre insérée par ce manager
     * @return Offre|null la dernière offre
     * @author Valentin Colindre
     */
    public function getLast(): ?Offre{
        $result = $this->execRequest("SELECT * FROM OFFRES WHERE idOffre=?",array($this->getLastId()))->fetch();
        if($result!==false){
            $val = new Offre();
            $val->hydrate($result);
        }
        else $val=null;

        return $val;
    }


    /**
     * Supprime l'offre d'id $idOffre dans la BDD
     * @param int $idOffre l'id de l'offre que l'on veut supprimer
     * @return bool renvoie True si la requête est bien exécuté
     * @author Louis Dememocq
     */
    public function deleteByIdOffre(int $idOffre): bool
    {
        $result = false;
        if ($this->execRequest("DElETE FROM OFFRES WHERE idOffre=?", array($idOffre)) !== false) {
            $result = true;
        }
        return $result;
    }


}