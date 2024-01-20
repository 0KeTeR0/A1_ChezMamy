<?php

namespace App\ChezMamy\models\Utilisateurs;


use App\ChezMamy\models\Model;

/**
 * Le manager des roles des comptes (utilisateur, modérateur;..)
 * @author Valentin Colindre
 */
class RolesManager extends Model
{
    /**
     * Récupère tous les roles existants
     * @return array tableau de tous les roles
     * @author Valentin Colindre
     */
    public function getAll(): array
    {
        $request = $this->execRequest("SELECT * FROM ROLES");

        $Roles = [];
        foreach ($request->fetchAll() as $role)
        {
            $rol = new Role();
            $rol->hydrate($role);
            $roles[] = $rol;
        }

        return $roles;
    }

}