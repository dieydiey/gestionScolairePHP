

<div class="main-content-inner"  >
    <h2>Liste des classes</h2>
    <?php if (isset($_SESSION['success'])): ?>
        <div class="success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    
    <a href="/gestionScolairePHP/public/index.php?controller=RP&page=classe_formulaire">
        <button>Ajouter une classe</button>
    </a>

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
        <?php foreach ($classes as $classe): ?>
            <tr>
                <td><?= $classe->getId() ?></td>
                <td><?= htmlspecialchars($classe->getLibelle()) ?></td>
                <td><?= htmlspecialchars($classe->getFiliere()) ?></td>
                <td><?= htmlspecialchars($classe->getNiveau()) ?></td>
            </tr>
        <?php endforeach; ?>
       </tbody>
        
        

    </table>
</div>


