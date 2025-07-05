<div class="main-content-inner">
    <h2>Réinscription d'un étudiant</h2>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>
    <?php if (isset($_SESSION['success'])): ?>
        <div class="success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>

    <form method="POST" action="/gestionScolairePHP/public/index.php?controller=Attache&page=reinscription&action=valider">
        <label for="etudiant_id">Étudiant *</label>
        <select name="etudiant_id" required>
            <option value="">-- Sélectionner un étudiant --</option>
            <?php foreach ($etudiants as $e): ?>
                <option value="<?= $e->getId() ?>">
                    <?= htmlspecialchars($e->getNom() . ' ' . $e->getPrenom()) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label for="classe_id">Classe *</label>
        <select name="classe_id" required>
            <option value="">-- Sélectionner une classe --</option>
            <?php foreach ($classes as $c): ?>
                <option value="<?= $c->getId() ?>"><?= htmlspecialchars($c->getLibelle()) ?></option>
            <?php endforeach; ?>
        </select>

        <label for="annee">Année *</label>
        <input type="text" name="annee" placeholder="ex: 2024-2025" required>

        <button type="submit" name="reinscrire">Réinscrire</button>
    </form>
</div>
