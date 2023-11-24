<?php
namespace App\ChezMamy\models\Utilisateurs;

use App\ChezMamy\models\Model;
use DateTime;

/**
 * Représentation de la table Tokens
 * de la BD
 * @author Valentin Colindre
 */
Class TokensManager extends Model{

    /**
     * récupère le token complet
     * @param string $token le token recherché
     * @return Token|null renvoi le Token ou rien s'il n'existe pas dans la DB.
     * @author Valentin Colindre
     */
    public function getByToken(string $token):?Token{
        $result = $this->execRequest("SELECT * FROM TOKENS WHERE token = ?",array($token))->fetch();
        if($result !== false){
            $data = [
                "idToken" => $result["idToken"],
                "token" => $result["token"],
                "expirationTime" => (new DateTime())->setTimestamp(strtotime($result["expirationTime"])),
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
     * Créer un nouveau token de 15minutes pour l'utilisateur d'id idUtilisateur si son compte
     * n'est pas bloqué
     * @param int $idUtilisateur l'idUtilisateur de l'utilisateur
     * @return Token Le nouveau token
     * @author Valentin Colindre
     */
    public function createToken(int $idUtilisateur): ?Token
    {
        $bloqueManager = new ComptesBloquesManager();
        $res=null;
        if($bloqueManager->getByIdUtilisateur($idUtilisateur)==null){
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

            $res = $this->getByIdUtilisateur($idUtilisateur);
        }

        return $res;
    }

    /**
     * Vérifie si le token de l'utilisateur est encore valide, si oui et si le compte n'est pas bloqué
     * le prolonge de 15minutes.
     * @param string $token token de l'utilisateur
     * @return bool vrai si le token est actif (et prolongé) faux sinon
     * @authors Valentin Colindre, Romain Card
     */
    public function checkToken(string $token):bool{
        $oldToken = $this->getByToken($token);
        $result = false;

        $bloqueManager = new ComptesBloquesManager();
        if($oldToken!==null && $oldToken->getByIdUtilisateur($oldToken->getIdUtilisateur())==null){
            $currentTime = new DateTime();
            if(isset($_SESSION['auth_token']) && $_SESSION['auth_token'] === $oldToken->getToken()){
                $diff = $oldToken->getExpirationTime()->getTimestamp() - $currentTime->getTimestamp();
                if($diff > 0){
                    $time= ($currentTime)->add(\DateInterval::createFromDateString("900 seconds"));
                    $this->execRequest("UPDATE TOKENS SET expirationTime=? WHERE token=?",array($time->format("H:i:s"),$token));
                    $result=true;
                }
                else unset($_SESSION['auth_token']);
            }
        }
        else{
            if(isset($_SESSION['auth_token'])) unset($_SESSION['auth_token']);
        }
        return $result;
    }
}