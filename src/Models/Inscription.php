<?php
namespace src\Models;

class Inscription {
    private int $id;
    private int $etudiantId;
    private int $classeId;
    private string $annee;
    private DateTime $dateInscription;

    public function __construct(int $id, int $etudiantId, int $classeId, string $annee, DateTime $dateInscription) {
        $this->id = $id;
        $this->etudiantId = $etudiantId;
        $this->classeId = $classeId;
        $this->annee = $annee;
        $this->dateInscription = $dateInscription;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getEtudiantId(): int {
        return $this->etudiantId;
    }

    public function getClasseId(): int {
        return $this->classeId;
    }

    public function getAnnee(): string {
        return $this->annee;
    }

    public function getDateInscription(): DateTimeid {
        return $this->dateInscription;
    }
}
