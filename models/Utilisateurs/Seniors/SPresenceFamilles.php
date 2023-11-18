<?php

namespace App\ChezMamy\models\Utilisateurs\Seniors;

/**
 * Représentation de la table S_Presence_Familles de la BD
 * @author Romain Card
 */
class SPresenceFamilles
{
    private int $idFamillePresente;
    private string $type;

    public function getIdFamillePresente(): int
    {
        return $this->idFamillePresente;
    }

    public function setIdFamillePresente(int $idFamillePresente): void
    {
        $this->idFamillePresente = $idFamillePresente;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
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