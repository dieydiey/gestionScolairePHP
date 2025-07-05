
    <div class="main-content-inner" >

        <h2>Liste des modules</h2>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <a href="/gestionScolairePHP/public/index.php?controller=RP&page=module_formulaire">
            <button>Ajouter un module</button>
        </a>

        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Libellé</th>
                    <th>Code</th>
                </tr>
            </thead>
            <tbody>
                
            <?php foreach ($modules as $module): ?>
            <tr>
                <td><?= $module->getId() ?></td>
                <td><?= htmlspecialchars($module->getLibelle()) ?></td>
                <td><?= htmlspecialchars($module->getCode()) ?></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

