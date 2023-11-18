<?php

namespace App\ChezMamy\models\Utilisateurs\Seniors;

use App\ChezMamy\models\Model;

/**
 * Le manager des domaines d'étude de la table E_Domaines_Etude
 * @author Romain Card
 */
class SPresenceFamillesManager extends Model
{
    /**
     * Récupère tous les choix de présence de la famille
     * @return array tableau de tous les choix
     * @author Romain Card
     */
    public function getAll(): array
    {
        $request = $this->execRequest("SELECT * FROM S_PRESENCE_FAMILLES");

        $listeChoix = [];
        foreach ($request->fetchAll() as $choix)
        {
            $presence = new SPresenceFamilles();
            $presence->hydrate($choix);
            $listeChoix[] = $presence;
        }

        return $listeChoix;
    }
}