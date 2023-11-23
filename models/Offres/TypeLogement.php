<?php

namespace App\ChezMamy\models\Offres;

/**
 * Un type de logement spécifique de la table Types_Logement
 * (une entrée de la table)
 * @author Louis Demeocq
 */
class TypeLogement
{
    /**
     * @var int l'id de la valeur de la table
     * @author Louis Demeocq
     */
    private int $idTypeLogement;

    /**
     * @var string les différents types de logement
     * @author Louis Demeocq
     */
    private string $type;

    /**
     * @return int renvoi l'id du type
     * @author Louis Demeocq
     */
    public function getIdTypeLogement(): int
    {
        return $this->idTypeLogement;
    }

    /**
     * @param int $idTypeLogement l'id à mettre
     * @return void
     * @author Louis Demeocq
     */
    public function setIdTypeLogement(int $idTypeLogement): void
    {
        $this->idTypeLogement = $idTypeLogement;
    }

    /**
     * @return string un type de logement à mettre
     * @author Louis Demeocq
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type un type de logement
     * @return void
     * @author Louis Demeocq
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