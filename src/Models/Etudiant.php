<?php
namespace src\Models;

use src\Enum\Role;
use src\Enum\SexeEtudiant;


class Etudiant extends Utilisateur {
    private string $matricule;
    private string $adresse;
    private SexeEtudiant $sexe;
    private \DateTime $dateNaissance;

    public function __construct(
        int $id,
        string $login,
        string $motDePasse,
        string $nom,
        string $prenom,
        string $email,
        string $matricule,
        string $adresse,
        SexeEtudiant $sexe,
        \DateTime $dateNaissance
    ) {
        parent::__construct($id, $login, $motDePasse, Role::ETUDIANT, $nom, $prenom, $email);
        $this->matricule = $matricule;
        $this->adresse = $adresse;
        $this->sexe = $sexe;
        $this->dateNaissance = $dateNaissance;
    }

    
    public function getMatricule(): string { return $this->matricule; }
    public function getAdresse(): string { return $this->adresse; }
    public function getSexe(): SexeEtudiant { return $this->sexe; }
    public function getDateNaissance(): \DateTime { return $this->dateNaissance; }
    public function getId(): int {
    return $this->id;}


    public function setMatricule(string $matricule): void { $this->matricule = $matricule; }
    public function setAdresse(string $adresse): void { $this->adresse = $adresse; }
    public function setSexe(SexeEtudiant $sexe): void { $this->sexe = $sexe; }
    public function setDateNaissance(\DateTime $date): void { $this->dateNaissance = $date; }
}
