<?php
namespace src\Repository;

use src\Models\Module;
use PDO;

class ModuleRepository {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = \Config\Database::getConnection();
    }

    public function findAll(): array {
        $stmt = $this->pdo->query("SELECT * FROM modules ORDER BY libelle");
        $rows = $stmt->fetchAll();

        $modules = [];
        foreach ($rows as $row) {
            $modules[] = new Module($row['id'], $row['libelle'], $row['code']);

        }

        return $modules;
    }

    public function exists(string $champ, string $valeur): bool {
    // Protection contre les injections en limitant les champs autorisés
        $champsAutorises = ['libelle', 'code'];
        if (!in_array($champ, $champsAutorises)) {
            throw new \InvalidArgumentException("Champ invalide : $champ");
        }
        
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM modules WHERE $champ = :valeur");
        $stmt->execute([':valeur' => $valeur]);
        return $stmt->fetchColumn() > 0;
    }

    

    public function add(string $libelle, string $code): void
    {
        $sql = "INSERT INTO modules (libelle, code) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$libelle, $code]);
    }

}
