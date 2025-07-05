<?php
// On suppose que $_SESSION['user'] existe et contient l'objet utilisateur avec getPrenom()
$prenom = $_SESSION['user']->getPrenom() ?? 'Utilisateur';

// Exemple de données statistiques (à remplacer par tes requêtes)
$nbEtudiants = $stats['etudiants'] ?? 120;
$nbProfesseurs = $stats['professeurs'] ?? 15;
$nbModules = $stats['modules'] ?? 30;

// Exemple tableau des dernières inscriptions (remplacer par données réelles)
$dernièresInscriptions = $dernieresInscriptions ?? [
    ['nom' => 'BA', 'prenom' => 'Ramata', 'classe' => '4ème A', 'date' => '2025-06-25'],
    ['nom' => 'DIOP', 'prenom' => 'Mamadou', 'classe' => '3ème B', 'date' => '2025-06-20'],
    ['nom' => 'SOW', 'prenom' => 'Awa', 'classe' => '2ème C', 'date' => '2025-06-18'],
];
?>

<section class="dashboard">
  <h1>Bienvenue, <?= htmlspecialchars($prenom) ?> !</h1>

  <div class="stats-cards">
    <div class="card">
      <h2><?= $nbEtudiants ?></h2>
      <p>Étudiants inscrits</p>
    </div>
    <div class="card">
      <h2><?= $nbProfesseurs ?></h2>
      <p>Professeurs</p>
    </div>
    <div class="card">
      <h2><?= $nbModules ?></h2>
      <p>Modules</p>
    </div>
  </div>

  
     
    </tbody>
  </table>
</section>

<style>
  
</style>
