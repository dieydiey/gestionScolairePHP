
    <div class="main-content">
        <h2>Liste des professeurs par module</h2>

        <form method="GET" action="/gestionScolairePHP/public/index.php?controller=RP&page=professeurs_par_module">
            <input type="hidden" name="page" value="professeurs_par_module">

            <label for="module_id">Choisir un module :</label>
            <select name="module_id" id="module_id" required onchange="this.form.submit()">
                <option value="">-- Sélectionner --</option>
                <?php foreach ($modules as $m): ?>
                    <option value="<?= $m->getId() ?>" 
                        <?= isset($_GET['module_id']) && $_GET['module_id'] == $m->getId() ? 'selected' : '' ?>>
                        <?= htmlspecialchars($m->getLibelle()) ?> (<?= htmlspecialchars($m->getCode()) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </form>

        <?php if (isset($professeurs)): ?>
            <h3>
                <?= count($professeurs) ?> professeur(s) trouvé(s)
            </h3>

            <?php if (count($professeurs) > 0): ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Grade</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($professeurs as $prof): ?>
                            <tr>
                                <td><?= $prof->getId() ?></td>
                                <td><?= htmlspecialchars($prof->getNom()) ?></td>
                                <td><?= htmlspecialchars($prof->getPrenom()) ?></td>
                                <td><?= htmlspecialchars($prof->getGrade()) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Aucun professeur n'enseigne ce module.</p>
            <?php endif; ?>
        <?php endif; ?>

        <br>
        <a href="/gestionScolairePHP/public/index.php?controller=RP&page=professeur">
            <button>⬅ Retour</button>
        </a>

    </div>

