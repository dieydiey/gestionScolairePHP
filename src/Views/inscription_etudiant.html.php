<style>
    .inscription-container {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        max-width: 900px;
        margin: auto;
    }

    .inscription-container label {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    .inscription-container input,
    .inscription-container select {
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        border-radius: 5px;
        border: 1px solid #ccc;
    }

    .form-full-width {
        grid-column: span 2;
    }

    .button-group {
        grid-column: span 2;
        display: flex;
        justify-content: space-between;
    }

    button {
        padding: 10px 20px;
        border-radius: 8px;
        border: none;
        background-color: #3c8dbc;
        color: white;
        cursor: pointer;
    }

    button:hover {
        background-color: #367fa9;
    }
</style>


<div class="main-content-inner">
    <h2>Inscription d'un étudiant</h2>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <form method="POST" action="/gestionScolairePHP/public/index.php?controller=Attache&page=inscription&action=inscrire_etudiant">
        <div class="inscription-container">
            <div>
                <label for="mot_de_passe">Mot de passe *</label>
                <input type="password" name="mot_de_passe" required>
            </div>

            <div>
                <label for="nom">Nom *</label>
                <input type="text" name="nom" required>
            </div>

            <div>
                <label for="prenom">Prénom *</label>
                <input type="text" name="prenom" required>
            </div>

            <div>
                <label for="adresse">Adresse *</label>
                <input type="text" name="adresse" required>
            </div>

            <div>
                <label for="sexe">Sexe *</label>
                <select name="sexe" required>
                    <option value="">-- Choisir --</option>
                    <option value="M">Masculin</option>
                    <option value="F">Féminin</option>
                </select>
            </div>

            <div>
                <label for="date_naissance">Date de naissance *</label>
                <input type="date" name="date_naissance" required>
            </div>

            <div>
                <label for="classe_id">Classe *</label>
                <select name="classe_id" required>
                    <option value="">-- Choisir une classe --</option>
                    <?php foreach ($classes as $classe): ?>
                        <option value="<?= $classe->getId() ?>">
                            <?= htmlspecialchars($classe->getLibelle()) ?> (<?= $classe->getNiveau() ?> - <?= $classe->getFiliere() ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div>
                <label for="annee">Année scolaire *</label>
                <input type="text" name="annee" value="<?= date('Y') . '-' . (date('Y') + 1) ?>" required>
            </div>

            <div class="button-group">
                
                <a href="/gestionScolairePHP/public/index.php?controller=Attache&page=dashboard">
                    <button type="button">⬅ Retour</button>
                </a>
                <button type="submit" name="inscrire_etudiant">Inscrire</button>
            </div>
        </div>
    </form>
</div>
