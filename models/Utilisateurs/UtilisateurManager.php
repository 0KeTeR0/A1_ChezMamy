<?php
namespace App\ChezMamy\models\Utilisateurs;


use App\ChezMamy\models\Model;

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
     * @param int $role rôle de l'utilisateur
     * @return bool vrai si réussite, faux si échec.
     * @author Valentin Colindre
     */
    public function creationUtilisateur(string $login, string $mdp,int $role):bool{
        $result = false;
        if($this->getByLogin($login)==null){
            $hash = password_hash($mdp,PASSWORD_DEFAULT);
            if($this->execRequest("INSERT INTO UTILISATEURS (login,hash,idRole) VALUES(?,?,?)",array($login,$hash,$role))!==false){
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

        return ["success" => $success, "message" => $message ?? "La connexion est impossible", "utilisateur" => $utilisateur];
    }

    /**
     * Change le rôle de l'utilisateur
     * @param int $idUtilisateur l'id de l'utilisateur dont on veut changer le rôle
     * @param int $idRole l'id du nouveau rôle
     * @return bool true si la requête a réussi, false sinon
     * @author Romain Card
     */
    public function updateRole(int $idUtilisateur, int $idRole):bool{
        return ($this->execRequest("UPDATE UTILISATEURS SET idRole=? WHERE idUtilisateur=?",array($idRole,$idUtilisateur))!==false);
    }

    /**
     * Vérifie si l'utilisateur est un senior
     * @param int $idUtilisateur l'id de l'utilisateur à vérifier
     * @return bool true si l'utilisateur est un senior, false sinon
     * @author Romain Card
     */
    public function isSenior(int $idUtilisateur):bool {
        return ($this->execRequest("SELECT * FROM COMPTES_SENIORS WHERE idUtilisateur=?",array($idUtilisateur))->rowCount() == 1);
    }

    /**
     * Vérifie si l'utilisateur est un étudiant
     * @param int $idUtilisateur l'id de l'utilisateur à vérifier
     * @return bool true si l'utilisateur est un étudiant, false sinon
     * @author Romain Card
     */
    public function isEtudiant(int $idUtilisateur):bool {
        return ($this->execRequest("SELECT * FROM COMPTES_ETUDIANTS WHERE idUtilisateur=?", array($idUtilisateur))->rowCount() == 1);
    }

    /**
     * Vérifie si l'utilisateur est du staff (modérateur, administrateur)
     * @param int $idUtilisateur l'id de l'utilisateur à vérifier
     * @return bool true si l'utilisateur est du staff, false sinon
     * @author Valentin Colindre
     */
    public function isStaff(int $idUtilisateur):bool{
        return ($this->execRequest("SELECT idRole FROM UTILISATEURS WHERE idUtilisateur=?", array($idUtilisateur))->fetch()["idRole"] > 1);
    }
}