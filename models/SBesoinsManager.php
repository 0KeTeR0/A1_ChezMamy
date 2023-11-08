<?php

namespace App\ChezMamy\models;


/**
 * Le manager des types de besoins d'un senior de S_BESOINS
 * @author Valentin Colindre
 */
class SBesoinsManager extends Model
{
    /**
     * Récupère tous les besoins du tableau SBesoin
     * @return array tableau de tous les SBesoin
     * @author Valentin Colindre
     */
    public function getAll(): array
    {
        $request = $this->execRequest("SELECT * FROM S_BESOINS");

        $besoins = [];
        foreach ($request->fetchAll() as $besoin)
        {
            $bes = new SBesoin();
            $bes->hydrate($besoin);
            $besoins[] = $bes;
        }

        return $besoins;
    }

}