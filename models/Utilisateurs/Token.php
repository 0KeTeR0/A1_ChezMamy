<?php
namespace App\ChezMamy\models\Utilisateurs;

use DateTime;

/**
 * Un token de la table Tokens
 * (une entrée de la table)
 * @author valentin Colindre
 */
Class Token{

    //id du token
    private int $idToken;

    //id de l'utilisateur lié au token
    private int $idUtilisateur;

    //contenu du token
    private string $token;

    //date d'exiration du token
    private DateTime $expirationTime;

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

    public function getIdToken(): int
    {
        return $this->idToken;
    }

    public function setIdToken(int $idToken): void
    {
        $this->idToken = $idToken;
    }

    public function getIdUtilisateur(): int
    {
        return $this->idUtilisateur;
    }

    public function setIdUtilisateur(int $idUtilisateur): void
    {
        $this->idUtilisateur = $idUtilisateur;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    public function getExpirationTime(): DateTime
    {
        return $this->expirationTime;
    }

    public function setExpirationTime(DateTime $expirationTime): void
    {
        $this->expirationTime = $expirationTime;
    }
}