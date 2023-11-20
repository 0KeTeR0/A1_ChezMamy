<?php

namespace App\ChezMamy\models\Offres;

/**
 * Une infosOffre de la table InfosOffre
 * (une entrée de la table)
 * @author Louis Demeocq
 */
class infosOffre
{
    /**
     * @var int l'id d'infosOffre
     */
    private int $idInfosOffre;

    /**
     * @var int superficie de la chambre en m²
     */
    private int $SuperficieDeLaChambre;

    /**
     * @var int l'ID de l'offre
     */
    private int $idOffre;

    /**
     * @var int l'ID du type de logement
     */
    private int $idTypeLogement;

    /**
     * @return int
     */
    public function getIdInfosOffre(): int
    {
        return $this->idInfosOffre;
    }

    /**
     * @param int $idInfosOffre
     */
    public function setIdInfosOffre(int $idInfosOffre): void
    {
        $this->idInfosOffre = $idInfosOffre;
    }

    /**
     * @return int
     */
    public function getSuperficieDeLaChambre(): int
    {
        return $this->SuperficieDeLaChambre;
    }

    /**
     * @param int $SuperficieDeLaChambre
     */
    public function setSuperficieDeLaChambre(int $SuperficieDeLaChambre): void
    {
        $this->SuperficieDeLaChambre = $SuperficieDeLaChambre;
    }

    /**
     * @return int
     */
    public function getIdOffre(): int
    {
        return $this->idOffre;
    }

    /**
     * @param int $idOffre
     */
    public function setIdOffre(int $idOffre): void
    {
        $this->idOffre = $idOffre;
    }

    /**
     * Remplace les valeurs de la classe par celles des données
     * @param array $donnees données
     * @return void
     * @author Louis Demeocq
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

    public function getIdTypeLogement(): int
    {
        return $this->idTypeLogement;
    }

    public function setIdTypeLogement(int $idTypeLogement): void
    {
        $this->idTypeLogement = $idTypeLogement;
    }
}