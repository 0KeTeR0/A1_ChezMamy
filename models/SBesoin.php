<?php

namespace App\ChezMamy\models;

use DateTime;

/**
 * Représentation d'une entrée de la table
 * SBesoin
 * @author valentin Colindre
 */
class SBesoin{

    //id de la disponibilité
    private int $idBesoin;

    //heure de début
    private string $besoin;


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

    public function getIdBesoin(): int
    {
        return $this->idBesoin;
    }

    public function setIdBesoin(int $idBesoin): void
    {
        $this->idBesoin = $idBesoin;
    }

    public function getBesoin(): string
    {
        return $this->besoin;
    }

    public function setBesoin(string $besoin): void
    {
        $this->besoin = $besoin;
    }

}