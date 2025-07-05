

        <div class="main-content">
            <h2>Liste des demandes</h2>

            <?php if (isset($_SESSION['success'])): ?>
                <div class="success"><?= $_SESSION['success']; unset($_SESSION['success']); ?></div>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                <div class="error"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
            <?php endif; ?>

            <table >
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Motif</th>
                        <th>Date</th>
                        <th>État</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($demandes as $demande): ?>
                        <tr>
                            <td><?= $demande->getType()->value ?></td>
                            <td><?= htmlspecialchars($demande->getMotif()) ?></td>
                            <td><?= $demande->getDateDemande() ?></td>
                            <td><?= $demande->getEtat()->value ?></td>
                            <td>
                                <?php if ($demande->getEtat() === \src\Enum\EtatDemande::EN_ATTENTE): ?>
                                    <form method="POST" action="/gestionScolairePHP/public/index.php?controller=RP&page=demande&action=traiter">


                                        <input type="hidden" name="demande_id" value="<?= $demande->getId() ?>">
                                        <button type="submit" name="action" value="acceptée">Valider</button>
                                        <button type="submit" name="action" value="refusée">Rejeter</button>
                                    </form>
                                <?php else: ?>
                                    Traitée
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
       
   


