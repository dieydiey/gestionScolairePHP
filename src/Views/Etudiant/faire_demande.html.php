<div class="main-content-inner" style="padding: 4% 10%;">
    <h2>Faire une demande</h2>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <form method="POST" action="/gestionScolairePHP/public/index.php?controller=Etudiant&page=faire_demande" style="max-width: 600px;">
        <label for="type">Type de demande *</label>
        <select name="type" required>
            <option value="">-- Choisir --</option>
            <option value="suspension">Suspension</option>
            <option value="annulation">Annulation</option>
        </select>

        <label for="motif">Motif *</label>
        <textarea name="motif" rows="4" required></textarea>

        <button type="submit" name="faire_demande">Envoyer la demande</button>
    </form>

    <br>
    <a href="/gestionScolairePHP/public/index.php?controller=Etudiant&page=dashboard">
        <button>⬅ Retour</button>
    </a>
</div>
