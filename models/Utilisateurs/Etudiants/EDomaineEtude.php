<?php

namespace App\ChezMamy\models\Utilisateurs\Etudiants;

/**
 * Un domaine d'étude de la table E_Domaines_Etude
 * @author Romain Card
 */
class EDomaineEtude
{
    /**
     * @var int l'id du domaine d'étude
     * @author Romain Card
     */
    private int $idDomaineEtude;
    /**
     * @var string le nom du domaine d'étude
     * @author Romain Card
     */
    private string $domaine;

    public function getIdDomaineEtude(): int
    {
        return $this->idDomaineEtude;
    }

    public function setIdDomaineEtude(int $idDomaineEtude): void
    {
        $this->idDomaineEtude = $idDomaineEtude;
    }

    public function getDomaine(): string
    {
        return $this->domaine;
    }

    public function setDomaine(string $domaine): void
    {
        $this->domaine = $domaine;
    }

    /**
     * Remplace les valeurs de la classe par celles des données
     * @param array $donnees données
     * @return void
     * @author Romain Card
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