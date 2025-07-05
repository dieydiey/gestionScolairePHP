

<div class="main-content-inner">

    <h2>Affectation de modules à un professeur</h2>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <form method="POST" action="/gestionScolairePHP/public/index.php?controller=RP&page=affectation_modules&action=affecter_modules">

        <label>Choisir un professeur</label>
        <select name="professeur_id" required>
            <option value="">-- Sélectionner --</option>
            <?php foreach ($professeurs as $prof): ?>
                <option value="<?= $prof->getId() ?>">
                    <?= htmlspecialchars($prof->getNom() . ' ' . $prof->getPrenom()) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Choisir les modules</label>
        <?php foreach ($modules as $mod): ?>
            <div>
                <input type="checkbox" name="modules[]" value="<?= $mod->getId() ?>">
                <?= htmlspecialchars($mod->getLibelle()) ?>
            </div>
        <?php endforeach; ?>

        <br>
        <button type="submit" name="affecter_modules">Affecter les modules</button>
    </form>
</div>

