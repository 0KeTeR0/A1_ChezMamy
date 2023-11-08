<?php

namespace App\ChezMamy\models;

/**
 * Représentation d'une entrée de la table
 * CompteSeniorSBesoin
 * @author valentin Colindre
 */
class CompteSeniorSBesoin{

    //id de la disponibilité
    private int $idBesoin;

    //id du compte étudiant
    private int $idCompteSenior;


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

    public function getIdCompteSenior(): int
    {
        return $this->idCompteSenior;
    }

    public function setIdCompteSenior(int $idCompteSenior): void
    {
        $this->idCompteSenior = $idCompteSenior;
    }


}