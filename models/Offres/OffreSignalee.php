<?php

namespace App\ChezMamy\models\Offres;

/**
 * Un signalement d'offre de la table OFFRES_SIGNALEES
 * (une entrée de la table)
 * @author Valentin Colindre
 */
class OffreSignalee
{
    //l'ID de l'utilisateur dans la table
    private int $idUtilisateur;

    //l'ID de l'offre
    private int $idOffre;


    /**
     * @return int
     * @author Valentin Colindre
     */
    public function getIdUtilisateur(): int
    {
        return $this->idUtilisateur;
    }

    /**
     * @param int $idUtilisateur
     * @author Valentin Colindre
     */
    public function setIdUtilisateur(int $idUtilisateur): void
    {
        $this->idUtilisateur = $idUtilisateur;
    }


    /**
     * @return int
     * @author Valentin Colindre
     */
    public function getIdOffre(): int
    {
        return $this->idOffre;
    }

    /**
     * @param int $idOffre
     * @author Valentin Colindre
     */
    public function setIdOffre(int $idOffre): void
    {
        $this->idOffre = $idOffre;
    }

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

}