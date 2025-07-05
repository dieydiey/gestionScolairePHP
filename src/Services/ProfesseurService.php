<?php
namespace src\Services;

require_once __DIR__ . '/../../autoload.php';

use src\Enum\Role;
use src\Repository\ProfesseurRepository;

class ProfesseurService{
    public static function add(){
        if (isset($_POST['add_professeur'])) {
            $nom = trim($_POST['nom'] ?? '');
            $prenom = trim($_POST['prenom'] ?? '');
            $grade = trim($_POST['grade'] ?? '');

             if (!isset($_SESSION['user']) || $_SESSION['user']->getRole() !== Role::RP) 
            {
                $_SESSION['error'] = "Accès non autorisé.";
                header("Location: /gestionScolairePHP/public/index.php?controller=security&page=login");
                exit;
            }

            if (empty($nom) || empty($prenom) || empty($grade)) {
                $_SESSION['error'] = "Tous les champs sont obligatoires.";
            } else {
                $repo = new ProfesseurRepository();
                $repo->add($nom, $prenom, $grade);
                $_SESSION['success'] = "Professeur ajouté avec succès.";
            }

            header('Location: /gestionScolairePHP/public/index.php?controller=RP&page=professeur_formulaire');
            exit;
        }


    }
}

