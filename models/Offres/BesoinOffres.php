<?php

namespace App\ChezMamy\models\Offres;


/**
 * Représentation d'une entrée de la table
 * BESOINS_OFFRES
 * @author valentin Colindre
 */
class BesoinOffres{

    //id du besoin
    private int $idBesoin;

    //id de l'InfosOffre
    private int $idInfosOffre;

    /**
     * Remplace les valeurs de la classe par celles des données
     * @param array $donnees données
     * @return void
     * @author Valentin Colindre
     */
    public function hydrate(array $donnees): void
    {
        foreach ($donnees as $key => $value) {
            $method = "set" . ucfirst($key);
            if(method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function getIdInfosOffre(): int
    {
        return $this->idInfosOffre;
    }

    public function setIdInfosOffre(int $idInfosOffre): void
    {
        $this->idInfosOffre = $idInfosOffre;
    }

    public function getIdBesoin(): int
    {
        return $this->idBesoin;
    }

    public function setIdBesoin(int $idBesoin): void
    {
        $this->idBesoin = $idBesoin;
    }


}