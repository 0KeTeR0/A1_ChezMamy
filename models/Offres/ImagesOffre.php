<?php

namespace App\ChezMamy\models\Offres;

/**
 * Une imageOffre de la table imageOffre
 * (une entrée de la table)
 * @author Louis Demeocq
 */
class ImagesOffre
{
    /**
     * @var int l'id de l'image
     */
    private int $idImageOffre;

    /**
     * @var string le lien vers l'image
     */
    private string $lienImage;

    /**
     * @var int l'id de l'Offre
     */
    private int $idOffre;

    /**
     * @return int
     */
    public function getIdImageOffre(): int
    {
        return $this->idImageOffre;
    }

    /**
     * @param int $idImageOffre
     */
    public function setIdImageOffre(int $idImageOffre): void
    {
        $this->idImageOffre = $idImageOffre;
    }

    /**
     * @return string
     */
    public function getLienImage(): string
    {
        return $this->lienImage;
    }

    /**
     * @param string $lienImage
     */
    public function setLienImage(string $lienImage): void
    {
        $this->lienImage = $lienImage;
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
}