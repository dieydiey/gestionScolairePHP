<?php
namespace src\Services;
use src\Enum\Role;

use src\Repository\ClasseRepository;
use src\Repository\InscriptionRepository;
use src\Models\Demande;
use src\Repository\DemandeRepository;
use src\Enum\TypeDemande;
use src\Enum\EtatDemande;

class EtudiantService {
    public static function listerEtudiants(): void {
        

        $classeRepo = new ClasseRepository();
        $classes = $classeRepo->findAll();
        $etudiants = [];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $classeId = $_POST['classe_id'] ?? null;
            $annee = $_POST['annee'] ?? null;

            if ($classeId && $annee) {
                $repo = new InscriptionRepository();
                $etudiants = $repo->getEtudiantsParClasseEtAnnee((int)$classeId, $annee);
            }
        }

        require_once __DIR__ . '/../Views/liste_etudiant.html.php';



    }


    public static function faireDemande(): void
    {
       

        if (isset($_POST['faire_demande'])) {
            $type = $_POST['type'] ?? '';
            $motif = trim($_POST['motif'] ?? '');

            if (!isset($_SESSION['user']) || $_SESSION['user']->getRole() !== Role::ETUDIANT) {
                $_SESSION['error'] = "Accès non autorisé.";
                header("Location: /gestionScolairePHP/public/index.php?controller=security&page=login");
                exit;
            }

            if (empty($type) || empty($motif)) {
                $_SESSION['error'] = "Tous les champs sont obligatoires.";
                header("Location: /gestionScolairePHP/public/index.php?controller=Etudiant&page=faire_demande");
                exit;
            }

            $etudiantId = $_SESSION['user']->getId();
            $date = date('Y-m-d');

            $demande = new Demande(
                0,
                $etudiantId,
                TypeDemande::from($type),
                $motif,
                $date,
                EtatDemande::EN_ATTENTE,
                null
            );

            $repo = new DemandeRepository();
            $repo->add($demande);

            $_SESSION['success'] = "Demande envoyée avec succès.";
            header("Location: /gestionScolairePHP/public/index.php?controller=Etudiant&page=faire_demande");
            exit;
        }

       
    }

     public static function mesDemandes(): void
    {
        if (!isset($_SESSION['user'])) {
            header("Location: /gestionScolairePHP/public/index.php?controller=securiry&page=login");
            exit;
        }

        $etudiantId = $_SESSION['user']->getId();
        $etat = $_GET['etat'] ?? 'toutes';

        $repo = new DemandeRepository();

        if (strtolower($etat) === 'toutes') {
            $demandes = $repo->findByEtudiant($etudiantId);
        } else {
            $demandes = $repo->findByEtudiantAndEtat($etudiantId, $etat);
        }

        // ✅ On passe les variables à la vue
        require_once __DIR__ . '/../Views/Etudiant/mesDemandes.html.php';
    }
}