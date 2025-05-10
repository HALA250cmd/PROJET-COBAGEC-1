<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer une Demande - Appel d'Offres</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap & FontAwesome -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        .form-container {
            max-width: 800px;
            margin: 40px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #007bff;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            padding: 12px 24px;
        }

        .btn-primary:hover {
            background-color:rgb(84, 86, 88);
        }

        .form-group label i {
            color:rgb(83, 80, 80);
            margin-right: 8px;
        }

        .form-group label {
            font-weight: 500;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2><i class="fas fa-file-alt me-2"></i>Créer une Demande</h2>
    <form action="traitement_demande.php" method="POST">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

        <div class="form-group mb-3">
            <label for="date_demande"><i class="fas fa-calendar-alt"></i>Date <span class="text-danger">*</span></label>
            <input type="date" class="form-control" name="date_demande" required>
        </div>

        <div class="form-group mb-3">
            <label for="service_demandeur"><i class="fas fa-building"></i>Service Demandeur <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="service_demandeur" required>
        </div>

        <div class="form-group mb-3">
            <label for="nom_demandeur"><i class="fas fa-user"></i>Nom du Demandeur <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="nom_demandeur" required>
        </div>

        <div class="form-group mb-3">
            <label for="libelle"><i class="fas fa-pen"></i>Libellé de la Demande <span class="text-danger">*</span></label>
            <textarea class="form-control" name="libelle" rows="3" required></textarea>
        </div>

        <div class="form-group mb-3">
            <label for="quantite"><i class="fas fa-sort-numeric-up"></i>Quantité</label>
            <input type="number" step="1" min="0" class="form-control" name="quantite" id="quantite">
        </div>

        <div class="form-group mb-3">
            <label for="prix_unitaire"><i class="fas fa-dollar-sign"></i>Prix Unitaire</label>
            <input type="number" step="0.01" min="0" class="form-control" name="prix_unitaire" id="prix_unitaire">
        </div>

        <div class="form-group mb-3">
            <label for="montant"><i class="fas fa-coins"></i>Montant (auto-calculé)</label>
            <input type="text" class="form-control" id="montant" name="montant" readonly>
        </div>

        <div class="form-group mb-4">
            <label for="nombre_jours"><i class="fas fa-hourglass-half"></i>Nombre de Jours</label>
            <input type="number" step="1" min="0" class="form-control" name="nombre_jours">
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane me-2"></i>Soumettre la Demande</button>
        </div>
    </form>
</div>

<!-- JS auto-calcul -->
<script>
    const quantite = document.getElementById("quantite");
    const prixUnitaire = document.getElementById("prix_unitaire");
    const montant = document.getElementById("montant");

    function updateMontant() {
        const q = parseFloat(quantite.value) || 0;
        const p = parseFloat(prixUnitaire.value) || 0;
        montant.value = (q * p).toFixed(2);
    }

    quantite.addEventListener("input", updateMontant);
    prixUnitaire.addEventListener("input", updateMontant);
</script>

</body>
</html>
