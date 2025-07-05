<?php
namespace src\Repository;

use src\Models\Etudiant;
use src\Enum\SexeEtudiant;
use PDO;

class EtudiantRepository {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = \Config\Database::getConnection();
    }

    public function add(Etudiant $etudiant): void {
        // Étape 1 : Insérer dans la table utilisateurs
        $stmt = $this->pdo->prepare("
            INSERT INTO utilisateurs (login, mot_de_passe, nom, prenom, email, role)
            VALUES (:login, :mot, :nom, :prenom, :email, 'ETUDIANT')
        ");
        $stmt->execute([
            ':login' => $etudiant->getLogin(),
            ':mot' => $etudiant->getMotDePasse(),
            ':nom' => $etudiant->getNom(),
            ':prenom' => $etudiant->getPrenom(),
            ':email' => $etudiant->getEmail()
        ]);

        // Récupérer l’ID du nouvel utilisateur
        $utilisateurId = $this->pdo->lastInsertId();

        // Étape 2 : Insérer dans la table etudiants (avec le même id)
        $stmt = $this->pdo->prepare("
            INSERT INTO etudiants 
            (utilisateur_id, login, mot_de_passe, nom, prenom, email, matricule, adresse, sexe, date_naissance, role)
            VALUES (:id, :login, :mot, :nom, :prenom, :email, :matricule, :adresse, :sexe, :dateN, 'ETUDIANT')
        ");
        $stmt->execute([
            ':id' => $utilisateurId,
            ':login' => $etudiant->getLogin(),
            ':mot' => $etudiant->getMotDePasse(),
            ':nom' => $etudiant->getNom(),
            ':prenom' => $etudiant->getPrenom(),
            ':email' => $etudiant->getEmail(),
            ':matricule' => $etudiant->getMatricule(),
            ':adresse' => $etudiant->getAdresse(),
            ':sexe' => $etudiant->getSexe()->value,
            ':dateN' => $etudiant->getDateNaissance()->format('Y-m-d')
        ]);
    }


    public function exists(string $champ, string $valeur): bool {
        $champsAutorises = ['login', 'email', 'matricule'];
        if (!in_array($champ, $champsAutorises)) {
            throw new \InvalidArgumentException("Champ non autorisé");
        }

        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM etudiants WHERE $champ = :valeur");
        $stmt->execute([':valeur' => $valeur]);
        return $stmt->fetchColumn() > 0;
    }


    public function findAll(): array {
    $stmt = $this->pdo->query("SELECT * FROM etudiants ORDER BY nom");
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


    public function findById(int $id): ?Etudiant {
        $stmt = $this->pdo->prepare("SELECT * FROM etudiants WHERE utilisateur_id = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch();

        if ($data) {
            return new Etudiant(
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

        return null;
    }

    public function findByLogin(string $login): ?Etudiant {
        $stmt = $this->pdo->prepare("SELECT * FROM etudiants WHERE login = ?");
        $stmt->execute([$login]);
        $data = $stmt->fetch();

        if ($data) {
            return new Etudiant(
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

        return null;
    }

    public function getLastId(): int {
        $sql = "SELECT MAX(id) as last_id FROM utilisateurs WHERE role = :role";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['role' => \src\Enum\Role::ETUDIANT->value]);
        $result = $stmt->fetch();
        return $result && $result['last_id'] ? (int)$result['last_id'] : 0;
    }


}
