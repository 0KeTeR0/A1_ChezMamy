<?php

namespace App\ChezMamy\models;

use DateTime;

/**
 * Représentation d'une entrée de la table
 * EDispos
 * @author valentin Colindre
 */
class EDispo{

    //id de la disponibilité
    private int $idDispos;

    //heure de début
    private string $heureDebut;

    //heure de fin
    private string $heureFin;

    //id du compte étudiant relié à la dispo
    private int $idCompteEtudiant;

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

    public function getIdDispos(): int
    {
        return $this->idDispos;
    }

    public function setIdDispos(int $idDispos): void
    {
        $this->idDispos = $idDispos;
    }

    public function getHeureDebut(): string
    {
        return $this->heureDebut;
    }

    public function setHeureDebut(string $heureDebut): void
    {
        $this->heureDebut = $heureDebut;
    }

    public function getHeureFin(): string
    {
        return $this->heureFin;
    }

    public function setHeureFin(string $heureFin): void
    {
        $this->heureFin = $heureFin;
    }

    public function getIdCompteEtudiant(): int
    {
        return $this->idCompteEtudiant;
    }

    public function setIdCompteEtudiant(int $idCompteEtudiant): void
    {
        $this->idCompteEtudiant = $idCompteEtudiant;
    }

}