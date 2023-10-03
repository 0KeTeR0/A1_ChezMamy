<?php

namespace App\Chezmamy\Model;

use App\ChezMamy\Lib\Database\DatabaseConnection;
class UserModel
{

    private ?string $adresseCourriel;
    private ?string $password;
    private ?string $nom;
    private ?string $prenom;
    private ?string $dateDeNaissance;
    private ?string $telephone;
    private ?string $adresseDesParents;
    private ?string $ville;
    private ?string $codePostal;
    private ?string $connuAssociation;
    private ?string $autre;
    private ?string $niveauEtudes;
    private ?string $dureeRestante;
    private ?string $dateArriveeRegion;
    private ?string $motivation;
    private bool $fumeur;
    private bool $allergies;
    private ?string $lesquelles;
    private ?string $permisDeConduire;
    private ?string $moyenLocomotion;
    private ?string $centresInteret;
    private ?string $pourquoiCohabitation;
    private ?string $typeLogement;
    private ?string $informationsAdditionnelles;
    private ?string $preferencesQuartier;



// Méthodes Getter
    public function getAdresseCourriel(): ?string {
        return $this->adresseCourriel;
    }

    public function getPassword(): ?string {
        return $this->password;
    }

    public function getNom(): ?string {
        return $this->nom;
    }

    public function getPrenom(): ?string {
        return $this->prenom;
    }
    public function getDateDeNaissance(): ?string {
        return $this->dateDeNaissance;
    }

    public function getTelephone(): ?string {
        return $this->telephone;
    }

    public function getAdresseDesParents(): ?string {
        return $this->adresseDesParents;
    }

    public function getVille(): ?string {
        return $this->ville;
    }

    public function getCodePostal(): ?string {
        return $this->codePostal;
    }

    public function getConnuAssociation(): ?string {
        return $this->connuAssociation;
    }

    public function getAutre(): ?string {
        return $this->autre;
    }

    public function getNiveauEtudes(): ?string {
        return $this->niveauEtudes;
    }

    public function getDureeRestante(): ?string {
        return $this->dureeRestante;
    }

    public function getDateArriveeRegion(): ?string {
        return $this->dateArriveeRegion;
    }

    public function getMotivation(): ?string {
        return $this->motivation;
    }

    public function isFumeur(): bool {
        return $this->fumeur;
    }

    public function hasAllergies(): bool {
        return $this->allergies;
    }

    public function getLesquelles(): ?string {
        return $this->lesquelles;
    }

    public function getPermisDeConduire(): ?string {
        return $this->permisDeConduire;
    }

    public function getMoyenLocomotion(): ?string {
        return $this->moyenLocomotion;
    }

    public function getCentresInteret(): ?string {
        return $this->centresInteret;
    }

    public function getPourquoiCohabitation(): ?string {
        return $this->pourquoiCohabitation;
    }

    public function getTypeLogement(): ?string {
        return $this->typeLogement;
    }

    public function getInformationsAdditionnelles(): ?string {
        return $this->informationsAdditionnelles;
    }

    public function getPreferencesQuartier(): ?string {
        return $this->preferencesQuartier;
    }

    // Méthodes Setter

    public function setAdresseCourriel(?string $adresseCourriel): void {
        $this->adresseCourriel = $adresseCourriel;
    }

    public function setPassword(?string $password): void {
        $this->password = $password;
    }

    public function setNom(?string $nom): void {
        $this->nom = $nom;
    }

    public function setPrenom(?string $prenom): void {
        $this->prenom = $prenom;
    }
    public function setDateDeNaissance(?string $dateDeNaissance): void {
        $this->dateDeNaissance = $dateDeNaissance;
    }

    public function setTelephone(?string $telephone): void {
        $this->telephone = $telephone;
    }

    public function setAdresseDesParents(?string $adresseDesParents): void {
        $this->adresseDesParents = $adresseDesParents;
    }

    public function setVille(?string $ville): void {
        $this->ville = $ville;
    }

    public function setCodePostal(?string $codePostal): void {
        $this->codePostal = $codePostal;
    }

    public function setConnuAssociation(?string $connuAssociation): void {
        $this->connuAssociation = $connuAssociation;
    }

    public function setAutre(?string $autre): void {
        $this->autre = $autre;
    }

    public function setNiveauEtudes(?string $niveauEtudes): void {
        $this->niveauEtudes = $niveauEtudes;
    }

    public function setDureeRestante(?string $dureeRestante): void {
        $this->dureeRestante = $dureeRestante;
    }

    public function setDateArriveeRegion(?string $dateArriveeRegion): void {
        $this->dateArriveeRegion = $dateArriveeRegion;
    }

    public function setMotivation(?string $motivation): void {
        $this->motivation = $motivation;
    }

    public function setFumeur(bool $fumeur): void {
        $this->fumeur = $fumeur;
    }

    public function setAllergies(bool $allergies): void {
        $this->allergies = $allergies;
    }

    public function setLesquelles(?string $lesquelles): void {
        $this->lesquelles = $lesquelles;
    }

    public function setPermisDeConduire(?string $permisDeConduire): void {
        $this->permisDeConduire = $permisDeConduire;
    }

    public function setMoyenLocomotion(?string $moyenLocomotion): void {
        $this->moyenLocomotion = $moyenLocomotion;
    }

    public function setCentresInteret(?string $centresInteret): void {
        $this->centresInteret = $centresInteret;
    }

    public function setPourquoiCohabitation(?string $pourquoiCohabitation): void {
        $this->pourquoiCohabitation = $pourquoiCohabitation;
    }

    public function setTypeLogement(?string $typeLogement): void {
        $this->typeLogement = $typeLogement;
    }

    public function setInformationsAdditionnelles(?string $informationsAdditionnelles): void {
        $this->informationsAdditionnelles = $informationsAdditionnelles;
    }

    public function setPreferencesQuartier(?string $preferencesQuartier): void {
        $this->preferencesQuartier = $preferencesQuartier;
    }
}