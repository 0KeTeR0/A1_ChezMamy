<?php
namespace App\ChezMamy\models;

/**
 * Représentation de la table Tokens
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
        if($result !== false){
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
        if($result !== false){
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

        if($oldToken !== false){
            $this->execRequest("UPDATE TOKENS SET token=?, expirationTime=? WHERE idUtilisateur=?",array(\OAuthProvider::generateToken(200),$time->format("hh:mm:ss"),$idUtilisateur));
        }
        else{
            $this->execRequest("INSERT INTO TOKENS SET (token, expirationTime, idUtilisateur) VALUES (?,?,?)",array(\OAuthProvider::generateToken(200),$time->format("hh:mm:ss"),$idUtilisateur));
        }

        return $this->getByIdUtilisateur($idUtilisateur);
    }

    /**
     * Vérifie si le token de l'utilisateur est encore valide, si oui le prolonge de 15minutes.
     * @param int $idUtilisateur idUtilisateur de l'utilisateur
     * @return bool vrai si le token est actif (et prolongé) faux sinon
     * @author Valentin Colindre
     */
    public function checkToken(int $idUtilisateur):bool{
        $oldToken = $this->getByIdUtilisateur($idUtilisateur);
        $result = false;
        if($oldToken!==false){
            $diff = date_diff($oldToken->getExpirationTime(),new \DateTime("now"));
            if($diff->format("s")>0){
                $time=$oldToken->getExpirationTime()->add(\DateInterval::createFromDateString("900 seconds"));
                $this->execRequest("UPDATE TOKENS SET expirationTime=? WHERE idUtilisateur=?",array($time->format("hh:mm:ss"),$idUtilisateur));
                $result=true;
            }
        }

        return $result;
    }
}