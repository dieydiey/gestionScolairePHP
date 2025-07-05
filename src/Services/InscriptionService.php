<?php
namespace src\Services;


require_once __DIR__ . '/../../autoload.php';

use src\Models\Etudiant;
use src\Repository\EtudiantRepository;
use src\Enum\SexeEtudiant;
use src\Enum\Role;


use src\Repository\ClasseRepository;
use src\Repository\InscriptionRepository;
use DateTime;




class InscriptionService{

    public static function inscrire(){
        if (isset($_POST['inscrire_etudiant'])) {

            $motDePasse = trim($_POST['mot_de_passe'] ?? '');
            $nom = trim($_POST['nom'] ?? '');
            $prenom = trim($_POST['prenom'] ?? '');
            $adresse = trim($_POST['adresse'] ?? '');
            $sexe = $_POST['sexe'] ?? '';
            $dateNaissance = $_POST['date_naissance'] ?? '';
            $classeId = $_POST['classe_id'] ?? '';
            $annee = trim($_POST['annee'] ?? '');

            // ✅ Génération automatique de l'email/login
            $prenomNettoye = strtolower(str_replace(' ', '', $prenom));
            $nomNettoye = strtolower(str_replace(' ', '', $nom));
            $baseEmail = $prenomNettoye . '.' . $nomNettoye;
            $email = $baseEmail . '@ism.edu.sn';
            $login = $email;

            $repo = new EtudiantRepository();
            $suffix = 1;
            while ($repo->exists('login', $login)) {
                $email = $login = $baseEmail . $suffix . '@ism.edu.sn';
                $suffix++;
            }

            // 🔍 Vérification des champs requis
            if (
                empty($login) || empty($motDePasse) || empty($nom) || empty($prenom) ||
                empty($adresse) || empty($sexe) || empty($dateNaissance) ||
                empty($classeId) || empty($annee)
            ) {
                $_SESSION['error'] = "Tous les champs sont obligatoires.";
                header("Location: /gestionScolairePHP/public/index.php?controller=Attache&page=inscription_etudiant");
                exit;
            }

            // ✅ Génération automatique du matricule
            $lastId = $repo->getLastId(); // méthode à définir dans EtudiantRepository
            $numero = str_pad($lastId + 1, 3, '0', STR_PAD_LEFT);
            $matricule = 'ETD' . $numero;

            // ✅ Création de l’objet
            $etudiant = new Etudiant(
                0,
                $login,
                password_hash($motDePasse, PASSWORD_DEFAULT),
                strtoupper($nom),
                ucfirst($prenom),
                $email,
                $matricule,
                ucfirst($adresse),
                SexeEtudiant::from($sexe),
                new DateTime($dateNaissance)
            );

            // ✅ Insertion
            $repo->add($etudiant);

            // ✅ Inscription
            $inscriptionRepo = new \src\Repository\InscriptionRepository();
            $etudiantCree = $repo->findByLogin($login);
            $inscriptionRepo->inscrire($etudiantCree->getId(), $classeId, $annee, (new DateTime())->format('Y-m-d'));

            $_SESSION['success'] = "Étudiant inscrit avec succès.";
            header("Location: /gestionScolairePHP/public/index.php?controller=Attache&page=inscription");
            exit;
        }

    }

    public static function form() {
        $etudiantRepo = new EtudiantRepository();
        $classeRepo = new ClasseRepository();

        // On rend ces variables globales pour que la vue puisse y accéder
        $GLOBALS['etudiants'] = $etudiantRepo->findAll();
        $GLOBALS['classes'] = $classeRepo->findAll();
        
        

    }


    public static function valider(): void {
        if (isset($_POST['reinscrire'])) {
            $etudiantId = $_POST['etudiant_id'] ?? '';
            $classeId = $_POST['classe_id'] ?? '';
            $annee = $_POST['annee'] ?? '';

            if (empty($etudiantId) || empty($classeId) || empty($annee)) {
                $_SESSION['error'] = "Tous les champs sont obligatoires.";
            } else {
                $repo = new InscriptionRepository();
                if ($repo->dejaInscrit((int)$etudiantId, $annee)) {
                    $_SESSION['error'] = "Cet étudiant est déjà inscrit pour l'année $annee.";
                } else {
                    $repo->inscrire((int)$etudiantId, (int)$classeId, $annee, (new DateTime())->format('Y-m-d'));
                    $_SESSION['success'] = "Réinscription réussie.";
                }
            }
            header('Location: /gestionScolairePHP/public/index.php?controller=Attache&page=reinscription');
            exit;
        }
    }

}

