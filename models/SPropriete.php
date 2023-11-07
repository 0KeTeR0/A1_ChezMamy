<?php

namespace App\ChezMamy\models;

/**
 * Les type de propriété (locataire, propriétaire...) possibles
 * provenant de la table S_SITUATIONS
 * (une entrée de la table)
 * @author Valentin Colindre
 */
class SPropriete
{
    /**
     * @var int l'id des valeurs de la table
     */
    private int $idPropriete;

    /**
     * @var string le type de propriete
     */
    private string $type;

    /**
     * @return int renvoi l'id de la table
     */
    public function getIdPropriete(): int
    {
        return $this->idPropriete;
    }

    /**
     * @param int $idPropriete l'id à mettre
     * @return void
     */
    public function setIdPropriete(int $idPropriete): void
    {
        $this->idPropriete = $idPropriete;
    }

    /**
     * @return string une manière de connaitre le type
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * set le type de propriete
     * @param string $type type de propriete
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