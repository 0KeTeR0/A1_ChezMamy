<?php

namespace App\ChezMamy\models\Utilisateurs;

/**
 * Représentation d'une entrée de la table
 * SBesoin
 * @author valentin Colindre
 */
class Role{

    //id de la disponibilité
    private int $idRole;

    //heure de début
    private string $type;


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

    public function getIdRole(): int
    {
        return $this->idRole;
    }

    public function setIdRole(int $idRole): void
    {
        $this->idRole= $idRole;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): void
    {
        $this->type = $type;
    }

}