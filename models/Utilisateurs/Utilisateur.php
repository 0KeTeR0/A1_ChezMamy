<?php
namespace App\ChezMamy\models\Utilisateurs;
/**
 * Un utilisateur de la table Utilisateurs
 * (une entrée de la table)
 * @author valentin Colindre
 */
Class Utilisateur{

    //l'ID de l'utilisateur dans la table
    private int $idUtilisateur;

    //Le login de l'utilisateur
    private string $login;

    //le hash de son mot de passe
    private string $hash;

    //Son role (de la table role)
    private int $idRole;


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

    /**
     * @return int renvoi l'idUtilisateur de l'utilisateur
     */
    public function getIdUtilisateur(): int
    {
        return $this->idUtilisateur;
    }

    /**
     * set l'idUtilisateur de l'utilisateur
     * @param int $idUtilisateur l'id à mettre
     * @return void
     */
    public function setIdUtilisateur(int $idUtilisateur): void
    {
        $this->idUtilisateur = $idUtilisateur;
    }

    /**
     * @return string renvoi le login de l'utilisateur
     */
    public function getLogin(): string
    {
        return $this->login;
    }

    /**
     * set le login de l'utilisateur
     * @param string $login le login à set
     * @return void
     */
    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    /**
     * @return string renvoi le hash du mot de passe de l'utilisateur
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * set le hash du mot de passe de l'utilisateur
     * @param string $hash le hash à set
     * @return void
     */
    public function setHash(string $hash): void
    {
        $this->hash = $hash;
    }

    /**
     * @return int renvoi l'id du role de l'utilisateur
     */
    public function getIdRole(): int
    {
        return $this->idRole;
    }

    /**
     * set l'id du role de l'utilisateur
     * 1 = utilisateur
     * 2 = modérateur
     * 3 = admin
     * @param int $idRole l'id à set
     * @return void
     */
    public function setIdRole(int $idRole): void
    {
        $this->idRole = $idRole;
    }
}