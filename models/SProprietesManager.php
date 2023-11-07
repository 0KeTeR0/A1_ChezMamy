<?php

namespace App\ChezMamy\models;


/**
 * Représentation de la table S_SITUATIONS de la BD
 * @author Valentin Colindre
 */
class SProprietesManager extends Model
{
    public function getAll():array
    {
        $request = $this->execRequest("SELECT * FROM S_PROPRIETES");
        $object_array = array();
        foreach ($request->fetchAll() as $entree)
        {
            $objet = new SPropriete();
            $objet->hydrate($entree);
            $object_array[] = $objet;
        }

        return $object_array;
    }
}