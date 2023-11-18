<?php

namespace App\ChezMamy\models\Offres;

use DateTime;

/**
 * Représentation d'une entrée de la table
 * DATES_OFFRES
 * @author valentin Colindre
 */
class DatesOffre{

    //id des dates de l'offre
    private int $idDateOffre;

    //adresse de début de l'offre
    private DateTime $DateDebut;

    //Date de fin de l'offre
    private DateTime $DateFin;

    //id de l'InfosOffre lié à ce DatesOffres
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

    public function getIdDateOffre(): int
    {
        return $this->idDateOffre;
    }

    public function setIdDateOffre(int $idDateOffre): void
    {
        $this->idDateOffre = $idDateOffre;
    }

    public function getDateDebut(): DateTime
    {
        return $this->DateDebut;
    }

    public function setDateDebut(DateTime $DateDebut): void
    {
        $this->DateDebut = $DateDebut;
    }

    public function getDateFin(): DateTime
    {
        return $this->DateFin;
    }

    public function setDateFin(DateTime $DateFin): void
    {
        $this->DateFin = $DateFin;
    }

}