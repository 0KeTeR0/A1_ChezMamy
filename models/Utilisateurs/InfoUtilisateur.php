<?php
namespace App\ChezMamy\models\Utilisateurs;

use DateTime;

/**
 * Informations générales d'un
 * utilisateur, provient de la table INFOS_UTILISATEUR
 * (une entrée de la table)
 * @author Valentin Colindre
 */
class InfoUtilisateur{

    //id de l'InfoUtilisateur
    private int $idInfosUtilisateur;

    //mail de l'utilisateur
    private ?string $mail;

    //numéro de l'utilisateur
    private ?string $numero;

    //nom de l'utilisateur
    private ?string $nom;

    //prenom de l'utilisateur
    private ?string $prenom;

    //date de naissance de l'utilisateur
    private ?DateTime $dateDeNaissance;

    //ville de l'utilisateur
    private ?string $ville;

    //codePostal de l'utilisateur
    private ?int $codePostal;

    //addresse de l'utilisateur
    private ?string $adresse;

    //si l'utilisateur fume ou non
    private ?bool $fumeur;

    //les intérêts de l'utilisateur pour le site
    private ?string $interets;

    //La raison pour la quelle l'utilisateur à décidé d'utiliser le site
    private ?string $raison;

    //L'id de la table ConnaissanceAssociation (façon dont l'utilisateur à connu l'asso)
    private ?int $idConnaissanceAssociation;

    //L'id du type de "service de logement" que souhaite l'utilisateur
    private ?int $idTypeLogement;

    //id vers l'utilisateur
    private int $idUtilisateur;

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

    public function getIdInfosUtilisateur(): int
    {
        return $this->idInfosUtilisateur;
    }

    public function setIdInfosUtilisateur(int $idInfosUtilisateur): void
    {
        $this->idInfosUtilisateur = $idInfosUtilisateur;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): void
    {
        $this->mail = $mail;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): void
    {
        $this->numero = $numero;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): void
    {
        $this->prenom = $prenom;
    }

    public function getDateDeNaissance(): ?DateTime
    {
        return $this->dateDeNaissance;
    }

    public function setDateDeNaissance(string $dateDeNaissance): void
    {
        $dateDeNaissance = new DateTime($dateDeNaissance);
        $this->dateDeNaissance = $dateDeNaissance;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): void
    {
        $this->ville = $ville;
    }

    public function getCodePostal(): ?int
    {
        return $this->codePostal;
    }

    public function setCodePostal(int $codePostal): void
    {
        $this->codePostal = $codePostal;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): void
    {
        $this->adresse = $adresse;
    }

    public function isFumeur(): ?bool
    {
        return $this->fumeur;
    }

    public function setFumeur(bool $fumeur): void
    {
        $this->fumeur = $fumeur;
    }

    public function getInterets(): ?string
    {
        return $this->interets;
    }

    public function setInterets(string $interets): void
    {
        $this->interets = $interets;
    }

    public function getRaison(): ?string
    {
        return $this->raison;
    }

    public function setRaison(string $raison): void
    {
        $this->raison = $raison;
    }

    public function getIdConnaissanceAssociation(): ?int
    {
        return $this->idConnaissanceAssociation;
    }

    public function setIdConnaissanceAssociation(int $idConnaissanceAssociation): void
    {
        $this->idConnaissanceAssociation = $idConnaissanceAssociation;
    }

    public function getIdTypeLogement(): ?int
    {
        return $this->idTypeLogement;
    }

    public function setIdTypeLogement(int $idTypeLogement): void
    {
        $this->idTypeLogement = $idTypeLogement;
    }

    public function getIdUtilisateur(): int
    {
        return $this->idUtilisateur;
    }

    public function setIdUtilisateur(int $idUtilisateur): void
    {
        $this->idUtilisateur = $idUtilisateur;
    }

}