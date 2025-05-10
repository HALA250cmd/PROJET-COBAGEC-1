<?php
require_once 'config.php';

try {
    $stmt = $pdo->query("SELECT * FROM demandes_appel_offres ORDER BY date_demande DESC");
    $demandes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur lors de la récupération : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Demandes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & FontAwesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">


    <style>
        .status-en-attente { color: #6c757d; font-weight: bold; }
        .status-validee { color: #28a745; font-weight: bold; }
        .status-rejetee { color: #dc3545; font-weight: bold; }
        .action-icons i { cursor: pointer; margin: 0 5px; }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="text-center mb-4">
        <h2 class="text-primary fw-bold">
            <i class="fas fa-list-alt me-2"></i> Liste des Demandes d'Appel d'Offres
        </h2>
        <p class="text-muted">Visualisez, modifiez ou supprimez les demandes en un clic.</p>
    </div>

    <div class="table-responsive shadow rounded overflow-hidden">
        <table class="table table-bordered table-hover table-striped align-middle mb-0">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Service</th>
                    <th>Demandeur</th>
                    <th>Libellé</th>
                    <th>Quantité</th>
                    <th>Prix U.</th>
                    <th>Montant</th>
                    <th>Jours</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($demandes as $row): 
                    $statusClass = match($row['statut']) {
                        'validée' => 'status-validee',
                        'rejetée' => 'status-rejetee',
                        default => 'status-en-attente'
                    };
                ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= htmlspecialchars($row['date_demande']) ?></td>
                    <td><?= htmlspecialchars($row['service_demandeur']) ?></td>
                    <td><?= htmlspecialchars($row['nom_demandeur']) ?></td>
                    <td><?= htmlspecialchars($row['libelle']) ?></td>
                    <td><?= htmlspecialchars($row['quantite']) ?></td>
                    <td><?= htmlspecialchars($row['prix_unitaire']) ?></td>
                    <td><?= htmlspecialchars($row['montant']) ?></td>
                    <td><?= htmlspecialchars($row['nombre_jours']) ?></td>
                    <td><span class="<?= $statusClass ?>">
                        <?= ucfirst($row['statut']) ?>
                    </span></td>
                    <td class="action-icons text-center">
                        <a href="modifier.php?id=<?= $row['id'] ?>" title="Modifier">
                            <i class="fas fa-edit text-primary"></i>
                        </a>
                        <a href="supprimer.php?id=<?= $row['id'] ?>" onclick="return confirm('Confirmer la suppression ?')" title="Supprimer">
                            <i class="fas fa-trash-alt text-danger"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>


<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
