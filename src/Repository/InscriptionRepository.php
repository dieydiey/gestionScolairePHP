<?php
namespace src\Repository;

use PDO;
use Config\Database;
use src\Models\Etudiant; // ✅ Ajouté
use src\Models\Inscription;
use src\Enum\SexeEtudiant; // ✅ Ajouté


class InscriptionRepository {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    public function inscrire(int $etudiantId, int $classeId, string $annee, string $date): void {
        $sql = "INSERT INTO inscriptions (etudiant_id, classe_id, annee, date_inscription)
                VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$etudiantId, $classeId, $annee, $date]);
    }

    public function findByClasseEtAnnee(int $classeId, string $annee): array {
        $sql = "SELECT * FROM inscriptions WHERE classe_id = ? AND annee = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$classeId, $annee]);
        $rows = $stmt->fetchAll();

        $inscriptions = [];
        foreach ($rows as $row) {
            $inscriptions[] = new Inscription(
                $row['id'],
                $row['etudiant_id'],
                $row['classe_id'],
                $row['annee'],
                $row['date_inscription']
            );
        }

        return $inscriptions;
    }

    public function dejaInscrit(int $etudiantId, string $annee): bool {
        $sql = "SELECT COUNT(*) FROM inscriptions WHERE etudiant_id = ? AND annee = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$etudiantId, $annee]);
        return $stmt->fetchColumn() > 0;
    }

    public function getEtudiantsParClasseEtAnnee(int $classeId, string $annee): array {
        $sql = "SELECT e.* FROM etudiants e
        INNER JOIN inscriptions i ON i.etudiant_id = e.utilisateur_id
        WHERE i.classe_id = ? AND i.annee = ?
        ORDER BY e.nom, e.prenom";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$classeId, $annee]);

        $rows = $stmt->fetchAll();
        $etudiants = [];

        foreach ($rows as $data) {
            $etudiants[] = new Etudiant(
                $data['utilisateur_id'],
                $data['login'],
                $data['mot_de_passe'],
                $data['nom'],
                $data['prenom'],
                $data['email'],
                $data['matricule'],
                $data['adresse'],
                SexeEtudiant::from($data['sexe']),
                new \DateTime($data['date_naissance'])
            );
        }

        return $etudiants;
    }


    
}
