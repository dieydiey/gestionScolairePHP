<div class="main-content-inner">

    <h2>Création d'un professeur</h2>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <form method="POST" action="/gestionScolairePHP/public/index.php?controller=RP&page=professeur&action=add">
        

        <label>Nom *</label>
        <input type="text" name="nom" required>

        <label>Prénom *</label>
        <input type="text" name="prenom" required>

        <label>Grade *</label>
        <select name="grade" required>
            <option value="">-- Choisir un grade --</option>
            <option value="Maître Assistant">Chargé de cours</option>
            <option value="Maître de Conférences">Enseignant vacataire</option>
            <option value="Professeur Agrégé">Professeur Agrégé</option>
            <option value="Professeur Titulaire">Professeur Titulaire</option>
        </select>

        <br>
        <button type="submit" name="add_professeur">Ajouter le professeur</button>
    </form>

    <br>
    <a href="/gestionScolairePHP/public/index.php?controller=RP&page=professeur">
        <button>Voir la liste des professeurs</button>
    </a>
</div>