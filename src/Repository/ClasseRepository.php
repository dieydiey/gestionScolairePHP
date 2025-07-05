<?php
namespace src\Repository;

use PDO;
use Config\Database;
use src\Models\Classe;

class ClasseRepository
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = \Config\Database::getConnection();

    }

    public function findAll(): array
    {
        $sql = "SELECT * FROM classes ORDER BY id DESC";
        $stmt = $this->pdo->query($sql);
        $rows = $stmt->fetchAll();

        $classes = [];
        foreach ($rows as $row) {
            $classes[] = new Classe(
                $row['id'],
                $row['libelle'],
                $row['filiere'],
                $row['niveau']
            );
        }

        return $classes;
    }

    public function add(string $libelle, string $filiere, string $niveau): void
    {
        $sql = "INSERT INTO classes (libelle, filiere, niveau) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$libelle, $filiere, $niveau]);
    }

    public function genererLibelleUnique(string $niveau, string $filiere): string
    {
        // Ex: Licence 2 → L2 ; Master 1 → M1
        $codeNiveau = '';
        if (stripos($niveau, 'Licence') !== false) {
            $codeNiveau = 'L' . substr($niveau, -1);
        } elseif (stripos($niveau, 'Master') !== false) {
            $codeNiveau = 'M' . substr($niveau, -1);
        }

        $prefixe = $codeNiveau . strtoupper($filiere); 

        // Récupère tous les libellés existants commençant par ce préfixe
        $sql = "SELECT libelle FROM classes WHERE libelle LIKE ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$prefixe . '%']);
        $libelles = $stmt->fetchAll(PDO::FETCH_COLUMN);

        // Extraire les suffixes existants (A, B, C…)
        $used = array_map(function ($libelle) use ($prefixe) {
            return substr($libelle, strlen($prefixe));
        }, $libelles);

        // Trouver la prochaine lettre disponible
        $lettre = 'A';
        while (in_array($lettre, $used)) {
            $lettre++;
        }

        return $prefixe . $lettre;
    }
}
