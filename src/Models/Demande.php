<?php
namespace src\Models;

use src\Enum\TypeDemande;
use src\Enum\EtatDemande;

class Demande {
    private int $id;
    private int $etudiantId;
    private TypeDemande $type;
    private string $motif;
    private string $dateDemande;
    private EtatDemande $etat;
    private ?int $traitePar;

    public function __construct(
        int $id,
        int $etudiantId,
        TypeDemande $type,
        string $motif,
        string $dateDemande,
        EtatDemande $etat = EtatDemande::EN_ATTENTE,
        ?int $traitePar = null
    ) {
        $this->id = $id;
        $this->etudiantId = $etudiantId;
        $this->type = $type;
        $this->motif = $motif;
        $this->dateDemande = $dateDemande;
        $this->etat = $etat;
        $this->traitePar = $traitePar;
    }

    public function getId(): int { return $this->id; }
    public function getEtudiantId(): int { return $this->etudiantId; }
    public function getType(): TypeDemande { return $this->type; }
    public function getMotif(): string { return $this->motif; }
    public function getDateDemande(): string { return $this->dateDemande; }
    public function getEtat(): EtatDemande { return $this->etat; }
    public function getTraitePar(): ?int { return $this->traitePar; }

    public function setEtat(EtatDemande $etat): void {
        $this->etat = $etat;
    }

    public function setTraitePar(?int $traitePar): void {
        $this->traitePar = $traitePar;
    }
}
