<?php

namespace App\ChezMamy\models;

/**
 * Représentation d'une entrée de la table
 * INFOS_COMPLEMENTAIRES
 * @author valentin Colindre
 */
class InfosComplementaires{

    //id des infos complémentaires
    private int $IdInfosComplementaires;

    //adresse de l'offre
    private string $Adresse;

    //id de l'InfosOffre lié à ce infosComplémentaires
    private int $idInfosOffre;

    //description de l'offre
    private string $Description;

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

    public function getIdInfosComplementaires(): int
    {
        return $this->IdInfosComplementaires;
    }

    public function setIdInfosComplementaires(int $IdInfosComplementaires): void
    {
        $this->IdInfosComplementaires = $IdInfosComplementaires;
    }

    public function getAdresse(): string
    {
        return $this->Adresse;
    }

    public function setAdresse(string $Adresse): void
    {
        $this->Adresse = $Adresse;
    }

    public function getIdInfosOffre(): int
    {
        return $this->idInfosOffre;
    }

    public function setIdInfosOffre(int $idInfosOffre): void
    {
        $this->idInfosOffre = $idInfosOffre;
    }

    public function getDescription(): string
    {
        return $this->Description;
    }

    public function setDescription(string $Description): void
    {
        $this->Description = $Description;
    }

}