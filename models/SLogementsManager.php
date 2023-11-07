<?php

namespace App\ChezMamy\models;

/**
 * Représentation de la table S_logements de la BD
 * @author Louis Demeocq
 */
class SLogementsManager extends Model
{
    public function getAll():array
    {
        $request = $this->execRequest("SELECT * FROM S_LOGEMENTS");
        $sLogement_array = array();
        foreach ($request->fetchAll() as $logement)
        {
            $sLogement_objet = new ConnaissancesAssociation();
            $sLogement_objet->hydrate($logement);
            $sLogement_array[] = $sLogement_objet;
        }

        return $sLogement_array;
    }
}