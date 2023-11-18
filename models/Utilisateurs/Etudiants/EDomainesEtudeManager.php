<?php

namespace App\ChezMamy\models\Utilisateurs\Etudiants;

use App\ChezMamy\models\Model;

/**
 * Le manager des domaines d'étude de la table E_Domaines_Etude
 * @author Romain Card
 */
class EDomainesEtudeManager extends Model
{
    /**
     * Récupère tous les domaines d'étude
     * @return array tableau de tous les domaines d'étude
     * @author Romain Card
     */
    public function getAll(): array
    {
        $request = $this->execRequest("SELECT * FROM E_DOMAINES_ETUDE");

        $domaines = [];
        foreach ($request->fetchAll() as $domaine)
        {
            $dom = new EDomaineEtude();
            $dom->hydrate($domaine);
            $domaines[] = $dom;
        }

        return $domaines;
    }
}