<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Statistiques de l'École</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #F4F6F8;
            margin: 0;
            padding: 30px;
        }

        h2, h3 {
            color: #0D47A1;
            margin-bottom: 20px;
        }

        .maint-content {
            max-width: 1200px;
            margin: auto;
        }

        .flex-sections {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            justify-content: center;
            align-items: flex-start;
        }

        .section {
            flex: 1 1 40%;
            max-width: 45%;
            min-width: 300px;
            background-color: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .label {
            margin-bottom: 5px;
            font-weight: bold;
        }

        .bar-container {
            margin-bottom: 15px;
        }

        .bar {
            height: 30px;
            color: white;
            font-weight: bold;
            line-height: 30px;
            padding-left: 10px;
            border-radius: 5px;
        }

        .grouped {
            display: flex;
            gap: 8px;
            margin-bottom: 15px;
        }

        .bar-fille {
            background-color: #F48FB1;
        }

        .bar-garcon {
            background-color: #64B5F6;
        }

        .bar-annulation {
            background-color: #EF5350;
        }

        .bar-suspension {
            background-color: #FFA726;
        }

        .table-stats {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            font-size: 15px;
        }

        .table-stats th, .table-stats td {
            padding: 10px;
            text-align: left;
        }

        .table-stats th {
            background-color: #0D47A1;
            color: white;
        }

        .table-stats tr:nth-child(even) {
            background-color: #f3f6f9;
        }

        .table-stats tr:nth-child(odd) {
            background-color: #ffffff;
        }

        .bar-inline {
            height: 25px;
            border-radius: 4px;
            padding-left: 8px;
            color: white;
            font-weight: bold;
            line-height: 25px;
        }

        .bar-inline.suspension {
            background-color: #FFA726;
        }

        .bar-inline.annulation {
            background-color: #EF5350;
        }

        @media screen and (max-width: 768px) {
            .section {
                flex: 1 1 100%;
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="maint-content" >
        <h2>📈 Statistiques de l'École</h2>

        <div class="flex-sections">
            <!-- Effectif total par année -->
            <div class="section">
                <h3>👥 Effectif total par année</h3>
                <?php
                    $max = max(array_column($effectifParAnnee, 'total')) ?: 1;
                    foreach ($effectifParAnnee as $row):
                        $width = ($row['total'] / $max) * 100;
                ?>
                    <div class="label"><?= htmlspecialchars($row['annee']) ?> (<?= $row['total'] ?> étudiants)</div>
                    <div class="bar-container">
                        <div class="bar" style="width: <?= $width ?>%; background-color: #1976D2;">
                            <?= $row['total'] ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Répartition filles/garçons par année -->
            <div class="section">
                <h3>👧👦 Répartition filles/garçons par année</h3>
                <?php
                $groupes = [];
                foreach ($filleGarconParAnnee as $row) {
                    $groupes[$row['annee']][$row['sexe']] = $row['total'];
                }
                $max = 0;
                foreach ($groupes as $grp) {
                    $total = array_sum($grp);
                    if ($total > $max) $max = $total;
                }
                foreach ($groupes as $annee => $data):
                ?>
                    <div class="label"><?= $annee ?></div>
                    <div class="grouped">
                        <?php foreach (['FEMININ', 'MASCULIN'] as $sexe): 
                            $val = $data[$sexe] ?? 0;
                            $width = ($val / $max) * 100;
                            $class = $sexe === 'FEMININ' ? 'bar-fille' : 'bar-garcon';
                        ?>
                            <div class="bar <?= $class ?>" style="width: <?= $width ?>%">
                                <?= $val ?> <?= strtolower($sexe) ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Effectif par classe -->
            <div class="section">
                <h3>🏫 Effectif par classe</h3>
                <?php
                    $max = max(array_column($effectifParClasse, 'total')) ?: 1;
                    foreach ($effectifParClasse as $row):
                        $width = ($row['total'] / $max) * 100;
                ?>
                    <div class="label"><?= htmlspecialchars($row['libelle']) ?> (<?= $row['total'] ?>)</div>
                    <div class="bar-container">
                        <div class="bar" style="width: <?= $width ?>%; background-color: #388E3C;">
                            <?= $row['total'] ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Répartition filles/garçons par classe -->
            <div class="section">
                <h3>🧑‍🎓 Répartition filles/garçons par classe</h3>
                <?php
                $groupes = [];
                foreach ($filleGarconParClasse as $row) {
                    $groupes[$row['libelle']][$row['sexe']] = $row['total'];
                }
                $max = 0;
                foreach ($groupes as $grp) {
                    $total = array_sum($grp);
                    if ($total > $max) $max = $total;
                }
                foreach ($groupes as $classe => $data):
                ?>
                    <div class="label"><?= $classe ?></div>
                    <div class="grouped">
                        <?php foreach (['FEMININ', 'MASCULIN'] as $sexe): 
                            $val = $data[$sexe] ?? 0;
                            $width = ($val / $max) * 100;
                            $class = $sexe === 'FEMININ' ? 'bar-fille' : 'bar-garcon';
                        ?>
                            <div class="bar <?= $class ?>" style="width: <?= $width ?>%">
                                <?= $val ?> <?= strtolower($sexe) ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Suspension / Annulation -->
            <div class="section">
                <h3>📌 Demandes de suspension ou annulation par année</h3>
                <table class="table-stats">
                    <thead>
                        <tr>
                            <th>Année</th>
                            <th>Suspensions</th>
                            <th>Annulations</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $groupes = [];
                        foreach ($suspensionAnnulationParAnnee as $row) {
                            $groupes[$row['annee']][$row['type']] = $row['total'];
                        }

                        $max = 0;
                        foreach ($groupes as $data) {
                            foreach ($data as $val) {
                                if ($val > $max) $max = $val;
                            }
                        }

                        foreach ($groupes as $annee => $data):
                            $suspension = $data['suspension'] ?? 0;
                            $annulation = $data['annulation'] ?? 0;
                            $widthSusp = ($max > 0) ? ($suspension / $max) * 100 : 0;
                            $widthAnnu = ($max > 0) ? ($annulation / $max) * 100 : 0;
                        ?>
                        <tr>
                            <td><?= $annee ?></td>
                            <td>
                                <div class="bar-inline suspension" style="width: <?= $widthSusp ?>%">
                                    <?= $suspension ?>
                                </div>
                            </td>
                            <td>
                                <div class="bar-inline annulation" style="width: <?= $widthAnnu ?>%">
                                    <?= $annulation ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>
