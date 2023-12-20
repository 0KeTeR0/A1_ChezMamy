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
     * @author Louis Demeocq
     */
    private int $idInfosOffre;

    /**
     * @var int superficie de la chambre en m²
     * @author Louis Demeocq
     */
    private int $SuperficieDeLaChambre;

    /**
     * @var int l'ID de l'offre
     * @author Louis Demeocq
     */
    private int $idOffre;

    /**
     * @var int l'ID du type de logement
     * @author Louis Demeocq
     */
    private int $idTypeLogement;

    /**
     * @return int
     * @author Louis Demeocq
     */
    public function getIdInfosOffre(): int
    {
        return $this->idInfosOffre;
    }

    /**
     * @param int $idInfosOffre
     * @author Louis Demeocq
     */
    public function setIdInfosOffre(int $idInfosOffre): void
    {
        $this->idInfosOffre = $idInfosOffre;
    }

    /**
     * @return int
     * @author Louis Demeocq
     */
    public function getSuperficieDeLaChambre(): int
    {
        return $this->SuperficieDeLaChambre;
    }

    /**
     * @param int $SuperficieDeLaChambre
     * @author Louis Demeocq
     */
    public function setSuperficieDeLaChambre(int $SuperficieDeLaChambre): void
    {
        $this->SuperficieDeLaChambre = $SuperficieDeLaChambre;
    }

    /**
     * @return int
     * @author Louis Demeocq
     */
    public function getIdOffre(): int
    {
        return $this->idOffre;
    }

    /**
     * @param int $idOffre
     * @author Louis Demeocq
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

    /**
     * @return int l'ID du type de logement
     * @author Valentin Colindre
     */
    public function getIdTypeLogement(): int
    {
        return $this->idTypeLogement;
    }

    /**
     * @param int $idTypeLogement l'ID du type de logement
     * @return void
     * @author Valentin Colindre
     */
    public function setIdTypeLogement(int $idTypeLogement): void
    {
        $this->idTypeLogement = $idTypeLogement;
    }
}