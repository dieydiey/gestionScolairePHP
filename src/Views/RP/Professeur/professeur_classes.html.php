
   


<div class="main-content-inner">

    <h2>Classes de <?= htmlspecialchars($professeur->getNom()) ?> <?= htmlspecialchars($professeur->getPrenom()) ?></h2>

    <?php if (empty($professeur->getClasses())): ?>
        <p>Aucune classe affectée à ce professeur.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Libellé</th>
                    <th>Filière</th>
                    <th>Niveau</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($professeur->getClasses() as $classe): ?>
                    <tr>
                        <td><?= htmlspecialchars($classe->getId()) ?></td>
                         <td><?= htmlspecialchars($classe->getLibelle()) ?></td>
                        <td><?= htmlspecialchars($classe->getFiliere()) ?></td>
                        <td><?= htmlspecialchars($classe->getNiveau()) ?></td>
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


