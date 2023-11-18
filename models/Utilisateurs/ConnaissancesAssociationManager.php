<?php

namespace App\ChezMamy\models\Utilisateurs;


use App\ChezMamy\models\Model;

/**
 * Représentation de la table Connaissances_Association de la BD
 * @author Louis Demeocq
 */
class ConnaissancesAssociationManager extends Model
{
    public function getAll():array
    {
        $request = $this->execRequest("SELECT * FROM CONNAISSANCES_ASSOCIATION");
        $connaissances_array = array();
        foreach ($request->fetchAll() as $connaissances)
        {
            $connaissancesAssociation_objet = new ConnaissancesAssociation();
            $connaissancesAssociation_objet->hydrate($connaissances);
            $connaissances_array[] = $connaissancesAssociation_objet;
        }

        return $connaissances_array;
    }
}