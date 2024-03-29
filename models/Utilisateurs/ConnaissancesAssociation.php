<?php

namespace App\ChezMamy\models\Utilisateurs;

/**
 * Une manière spécifique de connaitre l'association de la table Connaissances_Association
 * (une entrée de la table)
 * @author Louis Demeocq
 */
class ConnaissancesAssociation
{
    /**
     * @var int l'id des valeurs de la table
     * @author Louis Demeocq
     */
    private int $idConnaissanceAssociation;

    /**
     * @var string les différentes manières de connaitre l'association
     * @author Louis Demeocq
     */
    private string $moyen;

    /**
     * @return int renvoi l'id de la table
     * @author Louis Demeocq
     */
    public function getIdConnaissanceAssociation(): int
    {
        return $this->idConnaissanceAssociation;
    }

    /**
     * @param int $idConnaissanceAssociation l'id à mettre
     * @return void
     * @author Louis Demeocq
     */
    public function setIdConnaissanceAssociation(int $idConnaissanceAssociation): void
    {
        $this->idConnaissanceAssociation = $idConnaissanceAssociation;
    }

    /**
     * @return string une manière de connaitre l'association
     * @author Louis Demeocq
     */
    public function getMoyen(): string
    {
        return $this->moyen;
    }

    /**
     * @param string $moyen une manière de connaitre à mettre
     * @return void
     * @author Louis Demeocq
     */
    public function setMoyen(string $moyen): void
    {
        $this->moyen = $moyen;
    }

    /**
     * Remplace les valeurs de la classe par celles des données
     * @param array $donnees données
     * @return void
     * @author Louis Demeocq
     */
    public function hydrate(array $donnees): void
    {
        foreach ($donnees as $key => $value) {
            $method = "set" . ucfirst($key);
            if(method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

}