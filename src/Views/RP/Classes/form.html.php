<div class="main-content-inner">
    <h2>Créer une classe</h2>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <form action="/gestionScolairePHP/public/index.php?controller=RP&page=classe&action=add_classe" method="POST">


        <label for="filiere">Filière *</label>
        <select name="filiere" id="filiere" required>
            <option value="CPD">CPD</option>
            <option value="ETSE">ETSE</option>
            <option value="GLRS">GLRS</option>
            <option value="IAGE">IAGE</option>
            <option value="CYBER-CRIM">Cyber-Crim</option>
            <option value="MAIE">MAIE</option>
            <option value="MOSIEF">MOSIEF</option>

        </select>

        <label for="niveau">Niveau *</label>
        <select name="niveau" id="niveau" required>
            <option value="">-- Choisir un niveau --</option>
            <option value="Licence 1">Licence 1</option>
            <option value="Licence 2">Licence 2</option>
            <option value="Licence 3">Licence 3</option>
            <option value="Master 1">Master 1</option>
            <option value="Master 2">Master 2</option>
        </select>

        <button type="submit" name="add_classe">Créer la classe</button>
    </form>
    <br>

     <a href="/gestionScolairePHP/public/index.php?controller=RP&page=classe">
        <button>Voir la liste des classes</button>
    </a>


</div>