<?php

namespace App\ChezMamy\models;


/**
 * Représentation de la table S_SITUATIONS de la BD
 * @author Valentin Colindre
 */
class SSituationsManager extends Model
{
    public function getAll():array
    {
        $request = $this->execRequest("SELECT * FROM S_SITUATIONS");
        $object_array = array();
        foreach ($request->fetchAll() as $entree)
        {
            $objet = new SSituation();
            $objet->hydrate($entree);
            $object_array[] = $objet;
        }

        return $object_array;
    }
}