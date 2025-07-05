
<div class="main-content-inner" style="margin-left:25%; padding-top:5%;">
    <h2>Liste des étudiants inscrits</h2>

    <form method="POST">
        <label>Classe :</label>
        <select name="classe_id" required>
            <option value="">-- Choisir --</option>
            <?php foreach ($classes as $c): ?>
                <option value="<?= $c->getId() ?>"><?= $c->getLibelle() ?></option>
            <?php endforeach; ?>
        </select>

        <label>Année :</label>
        <input type="text" name="annee" placeholder="ex: 2024-2025" required>

        <button type="submit">Afficher</button>
    </form>

    <?php if (!empty($etudiants)): ?>
        <h3>Résultats :</h3>
        <table>
    <thead>
        <tr>
            <th>Matricule</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Email</th>
            <th>Date Naissance</th>
            <th>Sexe</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($etudiants as $etudiant): ?>
            <tr>
                <td><?= $etudiant->getMatricule() ?></td>
                <td><?= $etudiant->getNom() ?></td>
                <td><?= $etudiant->getPrenom() ?></td>
                <td><?= $etudiant->getEmail() ?></td>
                <td><?= $etudiant->getDateNaissance()->format('d/m/Y') ?></td>
                <td><?= $etudiant->getSexe()->value ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

    <?php elseif ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
        <p>Aucun étudiant trouvé pour cette classe et année.</p>
    <?php endif; ?>
</div>


