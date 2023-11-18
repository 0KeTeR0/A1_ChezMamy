<?php
namespace App\ChezMamy\models\Utilisateurs\Etudiants;
use DateTime;

/**
 * Compte Etudiant d'un
 * utilisateur, provient de la table COMPTES_ETUDIANTS
 * (une entrée de la table)
 * @author valentin Colindre
 */
class CompteEtudiant{

    //l'id du CompteEtudiant
    private int $idCompteEtudiant;

    //l'id de l'utilisateur lié au compte Etudiant
    private int $idUtilisateur;

    //l'id pointant vers le domaine
    // d'étude de l'étudiant dans la
    // table E_DOMAINES_ETUDE
    private int $idDomaineEtude;

    //Le niveau d'étude de l'étudiant
    private ?int $niveauEtude;

    //les stages qu'à fait l'étudiant
    private ?string $stages;

    //L'établissement d'étude de l'étudiant
    private ?string $etablissementEtude;

    //date de fin d'étude de l'étudiant
    private ?DateTime $dateFinEtude;

    //date d'arrivée dans la région de l'étudiant (ou rien)
    private ?DateTime $dateArriveeRegion;

    //motivations de l'étudiant
    //par rapport à l'utilisation du site
    private ?string $motivations;

    //si l'étudiant a le permis de conduire
    private ?bool $permisDeConduire;

    //si l'étudiant est allergique
    private ?bool $allergique;

    //Si oui, les allergies de l'étudiant
    private ?string $allergies;

    //Les moyens de locomotion de l'étudiant
    private ?string $moyenLocomotion;

    //Le budget maximal si utilisation du type de logement3
    private ?int $f3BudgetMax;

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

    public function getIdCompteEtudiant(): ?int
    {
        return $this->idCompteEtudiant;
    }

    public function setIdCompteEtudiant(int $idCompteEtudiant): void
    {
        $this->idCompteEtudiant = $idCompteEtudiant;
    }

    public function getIdUtilisateur(): ?int
    {
        return $this->idUtilisateur;
    }

    public function setIdUtilisateur(int $idUtilisateur): void
    {
        $this->idUtilisateur = $idUtilisateur;
    }

    public function getIdDomaineEtude(): ?int
    {
        return $this->idDomaineEtude;
    }

    public function setIdDomaineEtude(int $idDomaineEtude): void
    {
        $this->idDomaineEtude = $idDomaineEtude;
    }

    public function getNiveauEtude(): ?int
    {
        return $this->niveauEtude;
    }

    public function setNiveauEtude(int $niveauEtude): void
    {
        $this->niveauEtude = $niveauEtude;
    }

    public function getStages(): ?string
    {
        return $this->stages;
    }

    public function setStages(string $stages): void
    {
        $this->stages = $stages;
    }

    public function getEtablissementEtude(): ?string
    {
        return $this->etablissementEtude;
    }

    public function setEtablissementEtude(string $etablissementEtude): void
    {
        $this->etablissementEtude = $etablissementEtude;
    }

    public function getDateFinEtude(): ?DateTime
    {
        return $this->dateFinEtude;
    }

    public function setDateFinEtude(string $dateFinEtude): void
    {
        $this->dateFinEtude = (new DateTime())->setTimestamp(strtotime($dateFinEtude));
    }

    public function getDateArriveeRegion(): ?DateTime
    {
        return $this->dateArriveeRegion;
    }

    public function setDateArriveeRegion(?string $dateArriveeRegion): void
    {
        $this->dateArriveeRegion = (new DateTime())->setTimestamp(strtotime($dateArriveeRegion));
    }

    public function getMotivations(): ?string
    {
        return $this->motivations;
    }

    public function setMotivations(string $motivations): void
    {
        $this->motivations = $motivations;
    }

    public function isPermisDeConduire(): ?bool
    {
        return $this->permisDeConduire;
    }

    public function setPermisDeConduire(bool $permisDeConduire): void
    {
        $this->permisDeConduire = $permisDeConduire;
    }

    public function isAllergique(): ?bool
    {
        return $this->allergique;
    }

    public function setAllergique(bool $allergique): void
    {
        $this->allergique = $allergique;
    }

    public function getAllergies(): ?string
    {
        return $this->allergies;
    }

    public function setAllergies(?string $allergies): void
    {
        $this->allergies = $allergies;
    }

    public function getMoyenLocomotion(): ?string
    {
        return $this->moyenLocomotion;
    }

    public function setMoyenLocomotion(string $moyenLocomotion): void
    {
        $this->moyenLocomotion = $moyenLocomotion;
    }

    public function getF3BudgetMax(): ?int
    {
        return $this->f3BudgetMax;
    }

    public function setF3BudgetMax(?int $f3BudgetMax): void
    {
        $this->f3BudgetMax = $f3BudgetMax;
    }
}