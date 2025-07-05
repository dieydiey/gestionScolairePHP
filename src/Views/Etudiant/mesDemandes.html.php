<?php
$etat = $etat ?? ($_GET['etat'] ?? 'toutes');
$demandes = $demandes ?? [];
?>



<div class="main-content">
    <h2>Mes demandes</h2>
    <form method="GET" action="" style="margin-left:20%;width:50%;">
        <input type="hidden" name="page" value="mes_demandes">
        <label for="etat">Filtrer par état :</label>
        <select name="etat" id="etat" onchange="this.form.submit()">
            <option value="toutes" <?= $etat === 'toutes' ? 'selected' : '' ?>>Toutes</option>
            <option value="en attente" <?= $etat === 'en attente' ? 'selected' : '' ?>>En attente</option>
            <option value="acceptée" <?= $etat === 'acceptée' ? 'selected' : '' ?>>Acceptée</option>
            <option value="refusée" <?= $etat === 'refusée' ? 'selected' : '' ?>>Refusée</option>
        </select>
    </form>                    
            


    <br>

    <table >
        <thead >
            <tr>
                <th>Type</th>
                <th>Motif</th>
                <th>Date</th>
                <th>État</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($demandes) === 0): ?>
            <tr><td colspan="4" style="text-align:center;">Aucune demande trouvée</td></tr>
            <?php else: ?>
                <?php foreach ($demandes as $dem): ?>
                <tr>
                    <td><?= $dem->getType()->value ?></td>
                    <td><?= htmlspecialchars($dem->getMotif()) ?></td>
                    <td><?= $dem->getDateDemande() ?></td>
                    <td><?= $dem->getEtat()->value ?></td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>
       



