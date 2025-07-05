<div class="main-content-inner">
    <h2>Liste des professeurs</h2>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <a href="/gestionScolairePHP/public/index.php?controller=RP&page=professeur_formulaire">
        <button>Ajouter un professeur</button>
    </a>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Grade</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($professeurs as $prof): ?>
            <tr>
                <td><?= htmlspecialchars($prof->getId()) ?></td>
                <td><?= htmlspecialchars($prof->getNom()) ?></td>
                <td><?= htmlspecialchars($prof->getPrenom()) ?></td>
                <td><?= htmlspecialchars($prof->getGrade()) ?></td>
                <td>
                    <a href="/gestionScolairePHP/public/index.php?controller=RP&page=professeur_classes&id=<?= $prof->getId() ?>">
                        <button type="button">Classes</button>
                    </a>
                    <a href="/gestionScolairePHP/public/index.php?controller=RP&page=professeur_modules&id=<?= $prof->getId() ?>">
                        <button type="button">Modules</button>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

