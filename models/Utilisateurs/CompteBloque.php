<?php

namespace App\ChezMamy\models\Utilisateurs;

/**
 * Représentation d'une entrée de la table
 * COMPTES_BLOQUES
 * @author valentin Colindre
 */
class CompteBloque{

    //id comptebloque
    private int $idCompteBloque;

    //raison
    private ?string $raison;

    //id de l'utilisateur bloqué
    private int $idUtilisateur;


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

    public function getIdCompteBloque(): int
    {
        return $this->idCompteBloque;
    }

    public function setIdCompteBloque(int $idCompteBloque): void
    {
        $this->idCompteBloque = $idCompteBloque;
    }

    public function getRaison(): ?string
    {
        return $this->raison ?? "Aucune raison";
    }

    public function setRaison(?string $raison): void
    {
        $this->raison = $raison;
    }

    public function getIdUtilisateur(): int
    {
        return $this->idUtilisateur;
    }

    public function setIdUtilisateur(int $idUtilisateur): void
    {
        $this->idUtilisateur = $idUtilisateur;
    }


}