<?php

namespace App\ChezMamy\models\Utilisateurs;


use App\ChezMamy\models\Model;

/**
 * Le manager des entrées de la table COMPTES_BLOQUES
 * @author Valentin Colindre
 */
class ComptesBloquesManager extends Model
{
    /**
     * Récupère tous les comptes bloqués
     * @return array tableau de tous les comptes bloqués
     * @author Valentin Colindre
     */
    public function getAll(): array
    {
        $request = $this->execRequest("SELECT * FROM COMPTES_BLOQUES");

        $besoins = [];
        foreach ($request->fetchAll() as $besoin)
        {
            $bes = new CompteBloque();
            $bes->hydrate($besoin);
            $besoins[] = $bes;
        }

        return $besoins;
    }

    /**
     * récupère le compteBloque d'idUtilisateur $idUtilisateur
     * @param int $idCompteSenior l'IDutilisateur du compteBloque recherché
     * @return CompteBloque|null renvoi le compteBloque ou rien s'il n'existe pas dans la DB.
     * @author Valentin Colindre
     */
    public function getByIdUtilisateur(int $idUtilisateur):?CompteBloque{
        $result = $this->execRequest("SELECT * FROM COMPTES_BLOQUES WHERE idUtilisateur=?",array($idUtilisateur))->fetch();
        if($result!==false){
            $utilisateur = new CompteBloque();
            $utilisateur->hydrate($result);
        }
        else $utilisateur=null;

        return $utilisateur;
    }

    /**
     * bloque un compte
     * @param int $idUtilisateur id de l'utilisateur bloqué
     * @param string $raison raison du bloquage
     * @return bool vrai si succès, faux si échec
     * @author Valentin Colindre
     */
    public function creationCompteBloque(int $idUtilisateur, string $raison=null):bool
    {
        $result=false;
        try {
            if ($this->execRequest("INSERT INTO COMPTES_BLOQUES (idUtilisateur, raison) VALUES(?,?)", array($idUtilisateur, $raison)) !== false) {
                $result = true;
            }
        }
        catch (\Exception $e){
            $result = false;
        }
        return $result;
    }

    /**
     * Débloque un compte
     * @param int $idUtilisateur id du compte à débloquer
     * @return bool vrai si succès faux si échec
     * @author Valentin Colindre
     */
    public function deleteByIdUtilisateur(int $idUtilisateur):bool
    {
        $result = false;
        if ($this->execRequest("DElETE FROM COMPTES_BLOQUES WHERE idUtilisateur=?", array($idUtilisateur)) !== false) {
            $result = true;
        }
        return $result;
    }

}