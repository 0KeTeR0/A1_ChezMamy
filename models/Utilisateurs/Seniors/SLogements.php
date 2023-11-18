<?php

namespace App\ChezMamy\models\Utilisateurs\Seniors;

/**
 * Un type d'habitation de la table S_Logements
 * (une entrée de la table)
 * @author Louis Demeocq
 */
class SLogements
{

    /**
     * @var int l'id du type de logement
     */
    private int $idLogement;

    /**
     * @var string le type de logement
     */
    private string $type;

    /**
     * @return int l'id du logement
     */
    public function getIdLogement(): int
    {
        return $this->idLogement;
    }

    /**
     * @param int $idLogement l'id à mettre
     */
    public function setIdLogement(int $idLogement): void
    {
        $this->idLogement = $idLogement;
    }

    /**
     * @return string le nom du type de logement
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type le type de logement à mettre
     */
    public function setType(string $type): void
    {
        $this->type = $type;
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