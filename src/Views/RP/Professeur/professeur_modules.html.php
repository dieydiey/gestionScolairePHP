
    <div class="main-content-inner">

        <h2>Modules enseignés par <?= htmlspecialchars($professeur->getNom()) ?> <?= htmlspecialchars($professeur->getPrenom()) ?></h2>

        <?php if (empty($professeur->getModules())): ?>
            <p>Aucun module affecté à ce professeur.</p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Libellé</th>
                        <th>Volume Horaire</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($professeur->getModules() as $module): ?>
                        <tr>
                            <td><?= htmlspecialchars($module->getId()) ?></td>
                            <td><?= htmlspecialchars($module->getLibelle()) ?></td>
                            <td><?= htmlspecialchars($module->getCode()) ?> </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>

        <br>
        <a href="/gestionScolairePHP/public/index.php?controller=RP&page=professeur">
            <button>⬅ Retour à la liste des professeurs</button>
        </a>
    </div>


