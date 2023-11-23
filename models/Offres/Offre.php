<?php

namespace App\ChezMamy\models\Offres;

/**
 * Une Offre de la table Offre
 * (une entrée de la table)
 * @authors Louis Demeocq, Valentin Colindre
 */
class Offre
{
    //l'ID de l'utilisateur dans la table
    private int $idUtilisateur;

    //le Titre de l'offre
    private string $TitreDeLoffre;

    //l'ID de l'offre
    private int $idOffre;

    //Si l'offre est approuvée ou non
    private bool $approbation;

    /**
     * @return int
     * @author Louis Demeocq
     */
    public function getIdUtilisateur(): int
    {
        return $this->idUtilisateur;
    }

    /**
     * @param int $idUtilisateur
     * @author Louis Demeocq
     */
    public function setIdUtilisateur(int $idUtilisateur): void
    {
        $this->idUtilisateur = $idUtilisateur;
    }

    /**
     * @return string
     * @author Louis Demeocq
     */
    public function getTitreDeLoffre(): string
    {
        return $this->TitreDeLoffre;
    }

    /**
     * @param string $TitreDeLoffre
     * @author Louis Demeocq
     */
    public function setTitreDeLoffre(string $TitreDeLoffre): void
    {
        $this->TitreDeLoffre = $TitreDeLoffre;
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
     * get approbation
     * @return bool
     * @author Valentin Colindre
     */
    public function isApprobation(): bool
    {
        return $this->approbation;
    }

    /**
     * set approbation
     * @param bool $approbation
     * @return void
     * @author Valentin Colindre
     */
    public function setApprobation(bool $approbation): void
    {
        $this->approbation = $approbation;
    }
}