<?php
namespace src\Models;

class Classe {
    private int $id;
    private string $libelle;
    private string $filiere;
    private string $niveau;

    public function __construct(int $id, string $libelle, string $filiere, string $niveau) {
        $this->id = $id;
        $this->libelle = $libelle;
        $this->filiere = $filiere;
        $this->niveau = $niveau;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getLibelle(): string {
        return $this->libelle;
    }

    public function getFiliere(): string {
        return $this->filiere;
    }

    public function getNiveau(): string {
        return $this->niveau;
    }

    public function setLibelle(string $libelle): void {
        $this->libelle = $libelle;
    }

    public function setFiliere(string $filiere): void {
        $this->filiere = $filiere;
    }

    public function setNiveau(string $niveau): void {
        $this->niveau = $niveau;
    }
}
