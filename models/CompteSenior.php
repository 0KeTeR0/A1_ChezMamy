<?php
namespace App\ChezMamy\models;

/**
 * Compte Senior d'un
 * utilisateur, provient de la table COMPTES_SENIORS
 * (une entrée de la table)
 * @author valentin Colindre
 */
class CompteSenior{

    //id du CompteSenior
    private int $idCompteSenior;

    //id de l'utilisateur lié au compte senior
    private int $idUtilisateur;

    //animaux possédés par l'utilisateur
    private string $animal;

    //distance entre le logement et le moyen de transport le plus proche
    private int $transportPlusProche;

    //Si les étudiants peuvent rester en été
    private bool $resterEnEte;

    //la passion à partager avec les étudiants
    private string $passionAPartager;

    //La profession exercée par le senior dans le passé
    private string $professionExercee;

    //les avantages qu'auraient un étudiant à cohabiter ici
    private string $avantagesCohabitation;

    //Si la famille est d'accord
    private bool $accordFamille;

    //La surface de la chambre (m²)
    private int $surfaceChambre;

    //Si la chambre est meublée
    private bool $meublee;

    //s'il y a des appareils de lavage
    private bool $appareilsDeLavage;

    //Si il y a internet
    private bool $internet;

    //id vers la table S_SITUATIONS,
    //la situation familiale du senior
    private int $idSituation;

    //id vers la table S_PRESENCE_FAMILLE
    //la présence de la famille du senior
    private int $idFamillePresente;

    //id vers la table S_PROPRIETE
    //Si le senior est locataire ou propriétaire
    private int $idPropriete;

    //id vers la table S_LOGEMENT
    //Si le logement est un appartement ou une maison
    private int $idLogement;


    /**
     * Remplace les valeurs de la classe par celles des données
     * @param array $donnees données
     * @return void
     * @author Valentin Colindre
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

    public function getIdCompteSenior(): int
    {
        return $this->idCompteSenior;
    }

    public function setIdCompteSenior(int $idCompteSenior): void
    {
        $this->idCompteSenior = $idCompteSenior;
    }

    public function getIdUtilisateur(): int
    {
        return $this->idUtilisateur;
    }

    public function setIdUtilisateur(int $idUtilisateur): void
    {
        $this->idUtilisateur = $idUtilisateur;
    }

    public function getAnimal(): string
    {
        return $this->animal;
    }

    public function setAnimal(string $animal): void
    {
        $this->animal = $animal;
    }

    public function getTransportPlusProche(): int
    {
        return $this->transportPlusProche;
    }

    public function setTransportPlusProche(int $transportPlusProche): void
    {
        $this->transportPlusProche = $transportPlusProche;
    }

    public function isResterEnEte(): bool
    {
        return $this->resterEnEte;
    }

    public function setResterEnEte(bool $resterEnEte): void
    {
        $this->resterEnEte = $resterEnEte;
    }

    public function getPassionAPartager(): string
    {
        return $this->passionAPartager;
    }

    public function setPassionAPartager(string $passionAPartager): void
    {
        $this->passionAPartager = $passionAPartager;
    }

    public function getProfessionExercee(): string
    {
        return $this->professionExercee;
    }

    public function setProfessionExercee(string $professionExercee): void
    {
        $this->professionExercee = $professionExercee;
    }

    public function getAvantagesCohabitation(): string
    {
        return $this->avantagesCohabitation;
    }

    public function setAvantagesCohabitation(string $avantagesCohabitation): void
    {
        $this->avantagesCohabitation = $avantagesCohabitation;
    }

    public function isAccordFamille(): bool
    {
        return $this->accordFamille;
    }

    public function setAccordFamille(bool $accordFamille): void
    {
        $this->accordFamille = $accordFamille;
    }

    public function getSurfaceChambre(): int
    {
        return $this->surfaceChambre;
    }

    public function setSurfaceChambre(int $surfaceChambre): void
    {
        $this->surfaceChambre = $surfaceChambre;
    }

    public function isMeublee(): bool
    {
        return $this->meublee;
    }

    public function setMeublee(bool $meublee): void
    {
        $this->meublee = $meublee;
    }

    public function isAppareilsDeLavage(): bool
    {
        return $this->appareilsDeLavage;
    }

    public function setAppareilsDeLavage(bool $appareilsDeLavage): void
    {
        $this->appareilsDeLavage = $appareilsDeLavage;
    }

    public function isInternet(): bool
    {
        return $this->internet;
    }

    public function setInternet(bool $internet): void
    {
        $this->internet = $internet;
    }

    public function getIdSituation(): int
    {
        return $this->idSituation;
    }

    public function setIdSituation(int $idSituation): void
    {
        $this->idSituation = $idSituation;
    }

    public function getIdFamillePresente(): int
    {
        return $this->idFamillePresente;
    }

    public function setIdFamillePresente(int $idFamillePresente): void
    {
        $this->idFamillePresente = $idFamillePresente;
    }

    public function getIdPropriete(): int
    {
        return $this->idPropriete;
    }

    public function setIdPropriete(int $idPropriete): void
    {
        $this->idPropriete = $idPropriete;
    }

    public function getIdLogement(): int
    {
        return $this->idLogement;
    }

    public function setIdLogement(int $idLogement): void
    {
        $this->idLogement = $idLogement;
    }


}