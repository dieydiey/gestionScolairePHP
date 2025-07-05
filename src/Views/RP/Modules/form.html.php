<div class="main-content-inner">
    <h2>Création d’un module</h2>

        <?php if (isset($_SESSION['success'])): ?>
            <div class="success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
        <?php endif; ?>

        <form method="POST" action="/gestionScolairePHP/public/index.php?controller=RP&page=module&action=add_module">
            <label for="libelle">Libellé *</label>
            <input type="text" name="libelle" id="libelle" required>

            <label for="code">Code *</label>
            <input type="text" name="code" id="code" required>

            <button type="submit" name="add_module">Créer le module</button>
        </form>
        <br>

        <a href="/gestionScolairePHP/public/index.php?controller=RP&page=module">
            <button>Voir la liste des moduless</button>
        </a>

</div>