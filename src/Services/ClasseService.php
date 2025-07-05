<?php
namespace src\Services;

require_once __DIR__ . '/../../autoload.php';


use src\Enum\Role;
use src\Repository\ProfesseurRepository; // ✅

use src\Repository\ClasseRepository;

class ClasseService{
    public static function addClass(): void{
        if (isset($_POST['add_classe'])) {
            $filiere = trim($_POST['filiere']);
            $niveau  = trim($_POST['niveau']);

            if (!isset($_SESSION['user']) || $_SESSION['user']->getRole() !== Role::RP) 
            {
                $_SESSION['error'] = "Accès non autorisé.";
                header("Location: /gestionScolairePHP/public/index.php?controller=security&page=login");

                exit;
            }

            if (empty($filiere) || empty($niveau)) {
                $_SESSION['error'] = "Tous les champs sont obligatoires.";
            } else {
                $repo = new ClasseRepository();

                // Générer le libellé automatiquement : ex. L1GLRSA
                $libelle = $repo->genererLibelleUnique($niveau, $filiere);

                // Ajouter la classe
                $repo->add($libelle, $filiere, $niveau);

                $_SESSION['success'] = "Classe $libelle ajoutée avec succès.";
            }

            header('Location: /gestionScolairePHP/public/index.php?controller=RP&page=classe_formulaire');
            exit;
        }

    }

    public static function affecterClasse(): void{
        if (isset($_POST['affecter_classes'])) {
            $profId = $_POST['professeur_id'] ?? null;
            $classes = $_POST['classes'] ?? [];

            if (!isset($_SESSION['user']) || $_SESSION['user']->getRole() !== Role::RP) 
            {
                $_SESSION['error'] = "Accès non autorisé.";
                header("Location: /gestionScolairePHP/public/index.php?controller=security&page=login");
                exit;
            }

            if (!$profId || empty($classes)) {
                $_SESSION['error'] = "Veuillez choisir un professeur et au moins une classe.";
            } else {
                $repo = new ProfesseurRepository();
                foreach ($classes as $idClasse) {
                    $repo->affecterClasse((int)$profId, (int)$idClasse);
                }
                $_SESSION['success'] = "Classes affectées avec succès.";
            }

            header('Location: /gestionScolairePHP/public/index.php?controller=RP&page=affectation_classes');
            exit;
        }
    }

}


