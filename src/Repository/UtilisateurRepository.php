<?php
namespace src\Repository;

use PDO;
use src\Models\Utilisateur;
use src\Enum\Role;
use Config\Database;

class UtilisateurRepository {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    public function findByLogin(string $login): ?Utilisateur {
        $sql = "SELECT * FROM utilisateurs WHERE login = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$login]);
        $data = $stmt->fetch();

        if ($data) {
            return new Utilisateur(
                $data['id'],
                $data['login'],
                $data['mot_de_passe'],
                Role::from($data['role']),
                $data['nom'],
                $data['prenom'],
                $data['email']
            );
        }

        return null;
    }

    public function add(Utilisateur $user): void {
        $sql = "INSERT INTO utilisateurs (login, mot_de_passe, nom, prenom, email, role)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $user->getLogin(),
            $user->getMotDePasse(),
            $user->getNom(),
            $user->getPrenom(),
            $user->getEmail(),
            $user->getRole()->value
        ]);
    }

    public function exists(string $login): bool {
        $sql = "SELECT COUNT(*) FROM utilisateurs WHERE login = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$login]);
        return $stmt->fetchColumn() > 0;
    }
}
