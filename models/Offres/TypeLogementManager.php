<?php

namespace App\ChezMamy\models\Offres;

use App\ChezMamy\models\Model;

/**
 * Représentation de la table Type_Logement
 * @author Louis Demeocq
 */
class TypeLogementManager extends Model
{
    public function getAll():array
    {
        $request = $this->execRequest("SELECT * FROM TYPES_LOGEMENT");
        $typeLogement_array = array();
        foreach ($request->fetchAll() as $logement)
        {
            $typeLogement_objet = new TypeLogement();
            $typeLogement_objet->hydrate($logement);
            $typeLogement_array[] = $typeLogement_objet;
        }

        return $typeLogement_array;
    }
}