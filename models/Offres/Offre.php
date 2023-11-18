<?php

namespace App\ChezMamy\models\Offres;

/**
 * Une Offre de la table Offre
 * (une entrée de la table)
 * @author Louis Demeocq
 */
class Offre
{
    //l'ID de l'utilisateur dans la table
    private int $idUtilisateur;

    //le Titre de l'offre
    private string $TitreDeLoffre;

    //l'ID de l'offre
    private int $idOffre;

    /**
     * @return int
     */
    public function getIdUtilisateur(): int
    {
        return $this->idUtilisateur;
    }

    /**
     * @param int $idUtilisateur
     */
    public function setIdUtilisateur(int $idUtilisateur): void
    {
        $this->idUtilisateur = $idUtilisateur;
    }

    /**
     * @return string
     */
    public function getTitreDeLoffre(): string
    {
        return $this->TitreDeLoffre;
    }

    /**
     * @param string $TitreDeLoffre
     */
    public function setTitreDeLoffre(string $TitreDeLoffre): void
    {
        $this->TitreDeLoffre = $TitreDeLoffre;
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