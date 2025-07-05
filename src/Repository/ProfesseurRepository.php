<?php
namespace src\Repository;

use src\Models\Professeur;
use src\Models\Classe;
use src\Models\Module;


use Config\Database;
use PDO;

class ProfesseurRepository
{
    private PDO $pdo;

    public function __construct()
    {
       $this->pdo = \Config\Database::getConnection();
    }

    public function findAll(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM professeurs ORDER BY nom");
        $rows = $stmt->fetchAll();

        $professeurs = [];
        foreach ($rows as $row) {
            $prof = new Professeur(
                $row['id'],
                $row['nom'],
                $row['prenom'],
                $row['grade']
            );

            // On récupère et associe modules et classes
            $prof->setModules($this->findModules($prof->getId()));
            $prof->setClasses($this->findClasses($prof->getId()));

            $professeurs[] = $prof;
        }

        return $professeurs;
    }

    public function add(string $nom, string $prenom, string $grade): void
    {
        $sql = "INSERT INTO professeurs (nom, prenom, grade) VALUES (:nom, :prenom, :grade)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':grade' => $grade
        ]);
    }

   
    private function findModules(int $profId): array
    {
        $stmt = $this->pdo->prepare("
            SELECT m.* FROM modules m
            JOIN enseignements e ON e.module_id = m.id
            WHERE e.professeur_id = ?
        ");
        $stmt->execute([$profId]);
        $rows = $stmt->fetchAll();

        $modules = [];
        foreach ($rows as $row) {
            $modules[] = new Module(
                $row['id'],
                $row['libelle'],
                $row['code']
            );
        }

        return $modules;
    }




    private function findClasses(int $profId): array
    {
        $stmt = $this->pdo->prepare("
            SELECT c.* FROM classes c
            JOIN affectations a ON a.classe_id = c.id
            WHERE a.professeur_id = ?
        ");
        $stmt->execute([$profId]);
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


        public function findById(int $id): ?Professeur
        {
        $stmt = $this->pdo->prepare("SELECT * FROM professeurs WHERE id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch();

        if ($data) {
            $prof = new Professeur($data['id'], $data['nom'], $data['prenom'], $data['grade']);
            $prof->setClasses($this->findClasses($id));
            $prof->setModules($this->findModules($id));
            return $prof;
        }
        return null;
        }

       

      public function getAllClasses(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM classes ORDER BY libelle");
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

    public function affecterClasse(int $profId, int $classeId): void
    {
        // Éviter les doublons dans la table "affectations"
        $stmt = $this->pdo->prepare("
            SELECT COUNT(*) FROM affectations 
            WHERE professeur_id = :prof AND classe_id = :classe
        ");
        $stmt->execute([
            ':prof' => $profId,
            ':classe' => $classeId
        ]);
        
        if ($stmt->fetchColumn() == 0) {
            $insert = $this->pdo->prepare("
                INSERT INTO affectations (professeur_id, classe_id) 
                VALUES (:prof, :classe)
            ");
            $insert->execute([
                ':prof' => $profId,
                ':classe' => $classeId
            ]);
        }
    }
  

    public function getAllModules(): array
    {
        $stmt = $this->pdo->query("SELECT * FROM modules ORDER BY libelle");
        $rows = $stmt->fetchAll();

        $modules = [];
        foreach ($rows as $row) {
            $modules[] = new Module(
                $row['id'],
                $row['libelle'],
                $row['code']
            );
        }

        return $modules;
    }


   
    public function affecterModule(int $profId, int $moduleId): void
    {
        $stmt = $this->pdo->prepare("
            SELECT COUNT(*) FROM enseignements 
            WHERE professeur_id = :prof AND module_id = :module
        ");
        $stmt->execute([
            ':prof' => $profId,
            ':module' => $moduleId
        ]);

        if ($stmt->fetchColumn() == 0) {
            $insert = $this->pdo->prepare("
                INSERT INTO enseignements (professeur_id, module_id) 
                VALUES (:prof, :module)
            ");
            $insert->execute([
                ':prof' => $profId,
                ':module' => $moduleId
            ]);
        }
    }

    public function findProfesseursByModule(int $moduleId): array {
    $stmt = $this->pdo->prepare("
        SELECT p.* FROM professeurs p
        JOIN enseignements e ON p.id = e.professeur_id
        WHERE e.module_id = :moduleId
        ORDER BY p.nom
    ");
    $stmt->execute(['moduleId' => $moduleId]);

    $professeurs = [];
    foreach ($stmt->fetchAll() as $row) {
        $professeurs[] = new Professeur($row['id'], $row['nom'], $row['prenom'], $row['grade']);
    }
    return $professeurs;
}




}
