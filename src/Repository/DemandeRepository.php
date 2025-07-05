<?php
namespace src\Repository;

use src\Models\Demande;
use src\Enum\TypeDemande;
use src\Enum\EtatDemande;
use Config\Database;
use PDO;

class DemandeRepository
{
    private PDO $pdo;

    public function __construct()
    {
        $this->pdo = Database::getConnection();
    }

    public function findAll(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM demandes ORDER BY date_demande DESC");
        $rows = $stmt->fetchAll();

        $demandes = [];
        foreach ($rows as $row) {
            $demandes[] = new Demande(
                $row['id'],
                $row['etudiant_id'],
                TypeDemande::from($row['type']),
                $row['motif'],
                $row['date_demande'],
                EtatDemande::from($row['etat']),
                $row['traite_par']
            );
        }

        return $demandes;
    }

    public function findById(int $id): ?Demande
    {
        $stmt = $this->pdo->prepare("SELECT * FROM demandes WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch();

        if ($row) {
            return new Demande(
                $row['id'],
                $row['etudiant_id'],
                TypeDemande::from($row['type']),
                $row['motif'],
                $row['date_demande'],
                EtatDemande::from($row['etat']),
                $row['traite_par']
            );
        }

        return null;
    }

    public function add(Demande $demande): void
{
    $sql = "INSERT INTO demandes (etudiant_id, type, motif, date_demande, etat) 
            VALUES (:etudiant_id, :type, :motif, :date_demande, :etat)";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([
        ':etudiant_id' => $demande->getEtudiantId(),
        ':type' => $demande->getType()->value,
        ':motif' => $demande->getMotif(),
        ':date_demande' => $demande->getDateDemande(),
        ':etat' => $demande->getEtat()->value
    ]);
}


    public function updateEtat(int $id, EtatDemande $etat, int $rpId): void
    {
        $sql = "UPDATE demandes SET etat = :etat, traite_par = :traite_par WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':etat' => $etat->value,
            ':traite_par' => $rpId,
            ':id' => $id
        ]);
    }

    public function findByEtudiant(int $etudiantId): array {
        $stmt = $this->pdo->prepare("SELECT * FROM demandes WHERE etudiant_id = ? ORDER BY date_demande DESC");
        $stmt->execute([$etudiantId]);
        $rows = $stmt->fetchAll();

        $demandes = [];
        foreach ($rows as $row) {
            $demandes[] = new Demande(
                $row['id'],
                $row['etudiant_id'],
                TypeDemande::from($row['type']),
                $row['motif'],
                $row['date_demande'],
                EtatDemande::from($row['etat']),
                $row['traite_par']
            );
        }

        return $demandes;
    }


    public function findByEtudiantAndEtat(int $etudiantId, string $etat = "toutes"): array {
        $sql = "SELECT * FROM demandes WHERE etudiant_id = :etudiant_id";
        
        if (strtolower($etat) !== "toutes") {
            $sql .= " AND etat = :etat";
        }

        $stmt = $this->pdo->prepare($sql);

        if (strtolower($etat) !== "toutes") {
            $stmt->execute([
                'etudiant_id' => $etudiantId,
                'etat' => $etat
            ]);
        } else {
            $stmt->execute([
                'etudiant_id' => $etudiantId
            ]);
        }

        $demandes = [];

        while ($row = $stmt->fetch()) {
            $demandes[] = new Demande(
                (int)$row['id'],
                (int)$row['etudiant_id'],
                TypeDemande::from($row['type']),
                $row['motif'],
                $row['date_demande'],
                EtatDemande::from($row['etat']),
                isset($row['traite_par']) ? (int)$row['traite_par'] : null
            );
        }

        return $demandes;
    }




}
