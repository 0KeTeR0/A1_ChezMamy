<?php
namespace App\ChezMamy\models;


/**
 * Représentation de la table UTILISATEURS
 * de la BD
 * @author Valentin Colindre
 */
Class UtilisateurManager extends Model{

    /**
     * Créer un nouvel utilisateur à partir d'un login
     * et d'un mot de passe. Renvoi vrai si l'opération
     * a été un succès. Faux sinon.
     * @param string $login Le login, l'identifiant de l'utilisateur : doit être unique
     * @param string $mdp le mdp de l'utilisateur
     * @return bool vrai si réussite, faux si échec.
     * @author Valentin Colindre
     */
    public function creationUtilisateur(string $login, string $mdp):bool{
        $result = false;
        if($this->getByLogin($login)==null){
            $hash = password_hash($mdp,PASSWORD_DEFAULT);
            if($this->execRequest("INSERT INTO UTILISATEURS (login,hash) VALUES(?,?)",array($login,$hash))!==false){
                $result=true;
            }

        }
        return $result;
    }

    /**
     * Récupère tout les utilisateurs de la DB
     * @return array array contenant tous les utilisateurs de la DB
     * @author Valentin Colindre
     */
    public function getAll():Array{
        $result = $this->execRequest("SELECT * FROM UTILISATEURS");
        $utilisateur_array=array();
        foreach($result->fetchAll() as $utilisateur){
            $utilisateur_object = new Utilisateur();
            $utilisateur_object->hydrate($utilisateur);
            $utilisateur_array[] = $utilisateur_object;
        }
        return $utilisateur_array;
    }

    /**
     * récupère l'utilisateur d'id $idUtilisateur
     * @param int $idUtilisateur l'ID de l'utilisateur recherché
     * @return Utilisateur|null renvoi l'utilisateur ou rien s'il n'existe pas dans la DB.
     * @author Valentin Colindre
     */
    public function getByID(int $idUtilisateur):?Utilisateur{
        $result = $this->execRequest("SELECT * FROM UTILISATEURS WHERE idUtilisateur=?",array($idUtilisateur))->fetch();
        if($result!=false){
            $utilisateur = new Utilisateur();
            $utilisateur->hydrate($result);
        }
        else $utilisateur=null;

        return $utilisateur;
    }

    /**
     * récupère l'utilisateur de login $loginUtilisateur
     * @param string $loginUtilisateur le login de l'utilisateur recherché
     * @return Utilisateur|null renvoi l'utilisateur ou rien s'il n'existe pas dans la DB.
     * @author Valentin Colindre
     */
    public function getByLogin(string $loginUtilisateur):?Utilisateur{
        $result = $this->execRequest("SELECT * FROM UTILISATEURS WHERE login=?",array($loginUtilisateur))->fetch();
        if($result !== false){
            $utilisateur = new Utilisateur();
            $utilisateur->hydrate($result);
        }
        else $utilisateur=null;

        return $utilisateur;
    }

    /**
     * Vérifie si l'utilisateur existe dans la DB avec le bon mdp
     * @param string $loginUtilisateur le login de l'utilisateur recherché
     * @param string $password le mot de passe de l'utilisateur
     * @return array array contenant un booléen représentant le succès et un message d'erreur si besoin
     * @author Romain Card
     */
    public function checkLogin(string $loginUtilisateur, string $password):array{
        $success = false;
        $utilisateur = $this->getByLogin($loginUtilisateur);

        if ($utilisateur != null)
            if (password_verify($password,$utilisateur->getHash())) {
                $success = true;
                $message = "Connexion réussie";
            }
            else {
                $message = "Mot de passe incorrect";
            }

        return ["success" => $success, "message" => $message ?? "La connexion est impossibles", "utilisateur" => $utilisateur];
    }
}