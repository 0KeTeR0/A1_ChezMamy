<?php
namespace App\ChezMamy\models;



/**
 * Représentation de la table COMPTES_SENIORS
 * de la BD
 * @author Valentin Colindre
 */
Class ComptesSeniorsManager extends Model{


    /**
     * Créer un nouveau compte Senior à partir des champs
     * nécessaires. Renvoi vrai si l'opération
     * a été un succès. Faux sinon.
     * @param array $params liste des paramètres pour le compte Senior.
     * @return bool vrai si réussite, faux si échec.
     * @author Valentin Colindre
     */
    public function creationCompteSenior(array $params):bool{
        $result = false;
        if($this->getByIdUtilisateur($params['idUtilisateur'])==null){

            if($this->execRequest("INSERT INTO COMPTES_SENIORS (animal,transportPlusProche,resterEnEte,passionAPartager,professionExercee,avantagesCohabitation,accordFamille,surfaceChambre,meublee,appareilsDeLavage,internet,idSituation,idFamillePresente,idPropriete,idLogement,idUtilisateur) VALUES(????????????????)",
                    array($params['animal'],$params['transportPlusProche'],$params['resterEnEte'],$params['passionAPartager'],$params["professionExercee"],$params["avantagesCohabitation"],$params["accordFamille"],$params["surfaceChambre"],$params["meublee"],$params["appareilsDeLavage"],$params["internet"],$params["idSituation"],$this["idFamillePresente"],$params["idPropriete"],$params["idLogement"],$params["idUtilisateur"]))!==false){
                $result=true;
            }
        }
        return $result;
    }


    /**
     * Récupère tout les CompteSenior de la DB
     * @return array array contenant tous les CompteSenior de la DB
     * @author Valentin Colindre
     */
    public function getAll():Array{
        $result = $this->execRequest("SELECT * FROM COMPTES_SENIORS");
        $utilisateur_array=array();
        foreach($result->fetchAll() as $utilisateur){
            $utilisateur_object = new CompteSenior();
            $utilisateur_object->hydrate($utilisateur);
            $utilisateur_array[] = $utilisateur_object;
        }
        return $utilisateur_array;
    }

    /**
     * récupère le CompteSenior d'id $idCompteSenior
     * @param int $idCompteSenior l'ID du CompteSenior recherché
     * @return CompteSenior|null renvoi le CompteSenior ou rien s'il n'existe pas dans la DB.
     * @author Valentin Colindre
     */
    public function getByID(int $idCompteSenior):?CompteSenior{
        $result = $this->execRequest("SELECT * FROM COMPTES_SENIORS WHERE idCompteSenior=?",array($idCompteSenior))->fetch();
        if($result!==false){
            $utilisateur = new CompteSenior();
            $utilisateur->hydrate($result);
        }
        else $utilisateur=null;

        return $utilisateur;
    }

    /**
     * récupère le CompteSenior d'idUtilisateur $idUtilisateur
     * @param int $idUtilisateur l'idUtilisateur du CompteSenior recherché
     * @return CompteSenior|null renvoi le CompteSenior ou rien s'il n'existe pas dans la DB.
     * @author Valentin Colindre
     */
    public function getByIdUtilisateur(int $idUtilisateur):?CompteSenior{
        $result = $this->execRequest("SELECT * FROM COMPTES_SENIORS WHERE idUtilisateur=?",array($idUtilisateur))->fetch();
        if($result!==false){
            $utilisateur = new CompteSenior();
            $utilisateur->hydrate($result);
        }
        else $utilisateur=null;

        return $utilisateur;
    }
}