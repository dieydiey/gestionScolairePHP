<?php
namespace src\Repository;

use PDO;
use Config\Database;

class StatistiqueRepository {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    public function effectifParAnnee(): array {
        $stmt = $this->pdo->query("
            SELECT annee, COUNT(*) as total
            FROM inscriptions
            GROUP BY annee
            ORDER BY annee DESC
        ");
        return $stmt->fetchAll();
    }

    public function repartitionSexeParAnnee(): array {
        $stmt = $this->pdo->query("
            SELECT i.annee, e.sexe, COUNT(*) as total
            FROM inscriptions i
            JOIN etudiants e ON i.etudiant_id = e.utilisateur_id
            GROUP BY i.annee, e.sexe
            ORDER BY i.annee DESC
        ");
        return $stmt->fetchAll();
    }

    public function effectifParClasse(): array {
        $stmt = $this->pdo->query("
            SELECT c.libelle, COUNT(*) as total
            FROM inscriptions i
            JOIN classes c ON i.classe_id = c.id
            GROUP BY c.libelle
        ");
        return $stmt->fetchAll();
    }

    public function repartitionSexeParClasse(): array {
        $stmt = $this->pdo->query("
            SELECT c.libelle, e.sexe, COUNT(*) as total
            FROM inscriptions i
            JOIN classes c ON i.classe_id = c.id
            JOIN etudiants e ON i.etudiant_id = e.utilisateur_id
            GROUP BY c.libelle, e.sexe
        ");
        return $stmt->fetchAll();
    }

   public function demandesParAnnee(): array {
    $stmt = $this->pdo->query("
        SELECT YEAR(d.date_demande) AS annee, d.type, COUNT(*) as total
        FROM demandes d
        WHERE d.etat = 'acceptée'
        GROUP BY annee, d.type
        ORDER BY annee DESC
    ");
    return $stmt->fetchAll();
}

}
