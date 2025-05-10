<?php
require_once 'config.php';

if (!isset($_GET['id'])) {
    die("ID de la demande non fourni");
}

$id = $_GET['id'];

try {
    // Récupérer les données de la demande
    $stmt = $pdo->prepare("SELECT * FROM demandes_appel_offres WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $demande = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$demande) {
        die("Demande non trouvée");
    }

    // Traitement du formulaire de modification
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $date_demande = $_POST['date_demande'];
        $service_demandeur = $_POST['service_demandeur'];
        $nom_demandeur = $_POST['nom_demandeur'];
        $libelle_demande = $_POST['libelle_demande'];
        $quantite = $_POST['quantite'];
        $prix_unitaire = $_POST['prix_unitaire'];
        $montant = $quantite * $prix_unitaire; // Calcul du montant
        $nombre_jours = $_POST['nombre_jours'];
        $statut = $_POST['statut'];

        // Mise à jour de la demande dans la base de données
        $updateStmt = $pdo->prepare("UPDATE demandes_appel_offres SET 
            date_demande = :date_demande, 
            service_demandeur = :service_demandeur, 
            nom_demandeur = :nom_demandeur, 
            libelle = :libelle, 
            quantite = :quantite, 
            prix_unitaire = :prix_unitaire, 
            montant = :montant, 
            nombre_jours = :nombre_jours, 
            statut = :statut
            WHERE id = :id");

        $updateStmt->bindParam(':date_demande', $date_demande);
        $updateStmt->bindParam(':service_demandeur', $service_demandeur);
        $updateStmt->bindParam(':nom_demandeur', $nom_demandeur);
        $updateStmt->bindParam(':libelle', $libelle_demande);
        $updateStmt->bindParam(':quantite', $quantite);
        $updateStmt->bindParam(':prix_unitaire', $prix_unitaire);
        $updateStmt->bindParam(':montant', $montant);
        $updateStmt->bindParam(':nombre_jours', $nombre_jours);
        $updateStmt->bindParam(':statut', $statut);
        $updateStmt->bindParam(':id', $id, PDO::PARAM_INT);

        $updateStmt->execute();

        // Redirection vers la page de liste après mise à jour
        header("Location: liste_demandes.php");
        exit();
    }
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Modifier Demande</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">*
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
 

    <link rel="stylesheet" href="assets/css/styl.css">
</head>

<body>

<div class="container mt-5">
    <div class="form-header text-center mb-4">
        <h2 class="text-primary fw-bold">
            <i class="bi bi-pencil-square me-2"></i> Modifier votre demande ici !
        </h2>
        <p class="text-muted">Remplissez les champs ci-dessous pour mettre à jour votre demande .</p>
    </div>

    <?php if (isset($successMessage)): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= htmlspecialchars($successMessage) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

<?php endif; ?>

<?php if (isset($errorMessage)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($errorMessage) ?></div>
<?php endif; ?>


        <form method="POST">
            <div class="mb-3">
                <label for="date_demande" class="form-label">Date</label>
                <input type="date" class="form-control" id="date_demande" name="date_demande" value="<?= htmlspecialchars($demande['date_demande']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="service_demandeur" class="form-label">Service Demandeur</label>
                <input type="text" class="form-control" id="service_demandeur" name="service_demandeur" value="<?= htmlspecialchars($demande['service_demandeur']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="nom_demandeur" class="form-label">Nom du Demandeur</label>
                <input type="text" class="form-control" id="nom_demandeur" name="nom_demandeur" value="<?= htmlspecialchars($demande['nom_demandeur']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="libelle_demande" class="form-label">Libellé de la Demande</label>
                <input type="text" class="form-control" id="libelle" name="libelle" value="<?= htmlspecialchars($demande['libelle']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="quantite" class="form-label">Quantité</label>
                <input type="number" class="form-control" id="quantite" name="quantite" value="<?= htmlspecialchars($demande['quantite']) ?>">
            </div>
            <div class="mb-3">
                <label for="prix_unitaire" class="form-label">Prix Unitaire</label>
                <input type="number" class="form-control" id="prix_unitaire" name="prix_unitaire" value="<?= htmlspecialchars($demande['prix_unitaire']) ?>">
            </div>
            <div class="mb-3">
                <label for="nombre_jours" class="form-label">Nombre de Jours</label>
                <input type="number" class="form-control" id="nombre_jours" name="nombre_jours" value="<?= htmlspecialchars($demande['nombre_jours']) ?>">
            </div>
            <div class="mb-3">
                <label for="statut" class="form-label">Statut</label>
                <select class="form-control" id="statut" name="statut" required>
                    <option value="en attente" <?= $demande['statut'] == 'en attente' ? 'selected' : '' ?>>En attente</option>
                    <option value="validée" <?= $demande['statut'] == 'validée' ? 'selected' : '' ?>>Validée</option>
                    <option value="rejetée" <?= $demande['statut'] == 'rejetée' ? 'selected' : '' ?>>Rejetée</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
<footer class="text-center mt-5 mb-3 text-muted">
    &copy; <?= date('Y') ?> - Application des demandes internes 
</footer>

</html>