<?php
if (!isset($_SESSION['user'])) {
    header("Location: /gestionScolairePHP/public/index.php?controller=security&page=login");
    exit;
}

$user = $_SESSION['user'];
$role = $_SESSION['role'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion Scolaire</title>
    <link rel="stylesheet" href="/gestionScolairePHP/public/css/style.css">
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h3><?= ucfirst(strtolower($role)) ?></h3>

            <!-- Lien dashboard correct -->
            <a href="/gestionScolairePHP/public/index.php?controller=<?= strtolower($role) ?>&page=dashboard">🏠 Dashboard</a>

            <?php if ($role === 'RP'): ?>
                <a href="/gestionScolairePHP/public/index.php?controller=RP&page=classe">Gestion des classes</a>
                <a href="/gestionScolairePHP/public/index.php?controller=RP&page=module">Gestion des modules</a>
                <a href="/gestionScolairePHP/public/index.php?controller=RP&page=professeur">Gestion des professeurs</a>
                <a href="/gestionScolairePHP/public/index.php?controller=RP&page=demande">Traiter demandes</a>
                <a href="/gestionScolairePHP/public/index.php?controller=RP&page=affectation_classes">Affecter classe</a>
                <a href="/gestionScolairePHP/public/index.php?controller=RP&page=affectation_modules">Affecter module</a>

            <?php elseif ($role === 'Attache'): ?>
                <a href="/gestionScolairePHP/public/index.php?controller=Attache&page=inscription">Inscription</a>
                <a href="/gestionScolairePHP/public/index.php?controller=Attache&page=reinscription">Réinscription</a>
                <a href="/gestionScolairePHP/public/index.php?controller=Attache&page=liste_etudiants">Liste des étudiants</a>

            <?php elseif ($role === 'Etudiant'): ?>
                <a href="/gestionScolairePHP/public/index.php?controller=Etudiant&page=faire_demande">Faire une demande</a>
                <a href="/gestionScolairePHP/public/index.php?controller=Etudiant&page=mes_demandes">Mes demandes</a>
            <?php endif; ?>

            <!-- Déconnexion -->
            <a href="/gestionScolairePHP/public/index.php?controller=security&page=logout">Déconnexion</a>
        </div>

        <div class="main-content">
            <?php require_once $content; ?>
        </div>
    </div>
</body>
</html>
