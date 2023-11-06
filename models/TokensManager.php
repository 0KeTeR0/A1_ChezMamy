<?php
namespace App\ChezMamy\models;




/**
 * Représentation de la table COMPTES_SENIORS
 * de la BD
 * @author Valentin Colindre
 */
Class TokensManager extends Model{

    /**
     * récupère le token d'id $idToken
     * @param int $idToken l'ID du token recherché
     * @return Token|null renvoi le Token ou rien s'il n'existe pas dans la DB.
     * @author Valentin Colindre
     */
    public function getByID(int $idToken):?Token{
        $result = $this->execRequest("SELECT * FROM TOKENS WHERE idToken=?",array($idToken))->fetch();
        if($result!=null){
            $utilisateur = new Token();
            $utilisateur->hydrate($result);
        }
        else $utilisateur=null;

        return $utilisateur;
    }

    /**
     * récupère le Token d'idUtilisateur $idUtilisateur
     * @param int $idUtilisateur l'idUtilisateur du Token recherché
     * @return Token|null renvoi le Token ou rien s'il n'existe pas dans la DB.
     * @author Valentin Colindre
     */
    public function getByIdUtilisateur(int $idUtilisateur):?Token{
        $result = $this->execRequest("SELECT * FROM TOKENS WHERE idUtilisateur=?",array($idUtilisateur))->fetch();
        if($result!=null){
            $utilisateur = new Token();
            $utilisateur->hydrate($result);
        }
        else $utilisateur=null;

        return $utilisateur;
    }

    /**
     * Créer un nouveau token de 15minutes pour l'utilisateur d'id idUtilisateur
     * @param int $idUtilisateur l'idUtilisateur de l'utilisateur
     * @return Token Le nouveau token
     * @author Valentin Colindre
     */
    public function createToken(int $idUtilisateur):Token{
        $oldToken = $this->getByIdUtilisateur($idUtilisateur);
        $time = new \DateTime("now");
        $time->add(\DateInterval::createFromDateString("900 seconds"));

        if($oldToken!=null){
            $this->execRequest("UPDATE TOKENS SET token=?, expirationTime=? WHERE idUtilisateur=?",array(\OAuthProvider::generateToken(200),$time->format("hh:mm:ss"),$idUtilisateur));
        }
        else{
            $this->execRequest("INSERT INTO TOKENS SET (token, expirationTime, idUtilisateur) VALUES (?,?,?)",array(\OAuthProvider::generateToken(200),$time->format("hh:mm:ss"),$idUtilisateur));
        }

        return $this->getByIdUtilisateur($idUtilisateur);
    }
}