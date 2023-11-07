<?php
namespace App\ChezMamy\models;

use DateTime;

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
            $data = [
                "idToken" => $result["idToken"],
                "token" => $result["token"],
                "expirationTime" => new DateTime(strtotime($result["expirationTime"])),
                "idUtilisateur" => $result["idUtilisateur"]
            ];
            $utilisateur = new Token();
            $utilisateur->hydrate($data);
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
    public function getByIdUtilisateur(int $idUtilisateur): ?Token{
        $result = $this->execRequest("SELECT * FROM TOKENS WHERE idUtilisateur=?",array($idUtilisateur))->fetch();
        if($result !== false){
            $expirationTime = new DateTime();
            $data = [
                "idToken" => $result["idToken"],
                "token" => $result["token"],
                "expirationTime" => $expirationTime->setTimestamp(strtotime($result["expirationTime"])),
                "idUtilisateur" => $result["idUtilisateur"]
            ];
            $utilisateur = new Token();
            $utilisateur->hydrate($data);
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
    public function createToken(int $idUtilisateur): ?Token
    {
        $oldToken = $this->getByIdUtilisateur($idUtilisateur);
        $time = new \DateTime("now");
        $time->add(\DateInterval::createFromDateString("900 seconds"));

        $length=200;
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $authToken = '';
        for($i=0; $i<$length; $i++){
            $authToken .= $chars[rand(0, strlen($chars)-1)];
        }

        if($oldToken !== null){
            $this->execRequest("UPDATE TOKENS SET token=?, expirationTime=? WHERE idUtilisateur=?",array($authToken,$time->format("H:i:s"),$idUtilisateur));
        }
        else{
            $this->execRequest("INSERT INTO TOKENS (token, expirationTime, idUtilisateur) VALUES (?,?,?)",array($authToken,$time->format("H:i:s"),$idUtilisateur));
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
                $this->execRequest("UPDATE TOKENS SET expirationTime=? WHERE idUtilisateur=?",array($time->format("H:i:s"),$idUtilisateur));
                $result=true;
            }
        }

        return $result;
    }
}