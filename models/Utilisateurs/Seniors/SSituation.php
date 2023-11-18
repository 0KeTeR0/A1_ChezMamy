<?php

namespace App\ChezMamy\models\Utilisateurs\Seniors;

/**
 * Les situations familiales possibles provenant de la table S_SITUATIONS
 * (une entrée de la table)
 * @author Valentin Colindre
 */
class SSituation
{
    /**
     * @var int l'id des valeurs de la table
     */
    private int $idSituation;

    /**
     * @var string le type de situation
     */
    private string $type;

    /**
     * @return int renvoi l'id de la table
     */
    public function getIdSituation(): int
    {
        return $this->idSituation;
    }

    /**
     * @param int $idSituation l'id à mettre
     * @return void
     */
    public function setIdSituation(int $idSituation): void
    {
        $this->idSituation = $idSituation;
    }

    /**
     * @return string une manière de connaitre le type
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * set le type de situation familial
     * @param string $type type de situation familial
     * @return void
     */
    public function setType(string $type): void
    {
        $this->type = $type;
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