
    <div class="main-content-inner">
        <?php require_once $routes[$page]; ?>
        <h2>Affectation de classes à un professeur</h2>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <form method="POST" action="/gestionScolairePHP/public/index.php?controller=RP&page=affectation_classes&action=affecter">
            <label>Professeur *</label>
            <select name="professeur_id" required>
                <option value="">-- Choisir un professeur --</option>
                <?php foreach ($professeurs as $prof): ?>
                    <option value="<?= $prof->getId() ?>">
                        <?= htmlspecialchars($prof->getNom()) . ' ' . htmlspecialchars($prof->getPrenom()) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label>Classes à affecter *</label>
            <?php foreach ($classes as $classe): ?>
                <div>
                    <input type="checkbox" name="classes[]" value="<?= $classe->getId() ?>">
                    <?= htmlspecialchars($classe->getLibelle()) ?> (<?= $classe->getNiveau() ?> - <?= $classe->getFiliere() ?>)
                </div>
            <?php endforeach; ?>

            <button type="submit" name="affecter_classes">Affecter les classes</button>
        </form>

        <br>
        <a href="/gestionScolairePHP/public/index.php?controller=RP&page=professeur">
            <button>⬅ Retour</button>
        </a>

    </div>
    



