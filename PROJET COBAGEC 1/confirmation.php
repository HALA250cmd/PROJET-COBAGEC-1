<?php
session_start();

// Vérifier si le formulaire a été bien soumis
$status = $_GET['status'] ?? null;
if ($status !== 'success') {
    header("Location: creer_demande.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Confirmation - Appel d'Offres</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Styles externes -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Poppins', sans-serif;
        }

        .confirmation-box {
            max-width: 600px;
            margin: 80px auto;
            background-color: #fff;
            padding: 40px;
            border-radius: 12px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        }

        .confirmation-box i {
            font-size: 60px;
            color: #28a745;
            margin-bottom: 20px;
        }

        .confirmation-box h2 {
            color: #333;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .confirmation-box p {
            font-size: 16px;
            color: #555;
            margin-bottom: 30px;
        }

        .btn-custom {
            margin: 10px;
            padding: 12px 24px;
            font-size: 16px;
        }
    </style>
</head>
<body>

<div class="confirmation-box">
    <i class="fas fa-check-circle"></i>
    <h2>Demande envoyé avec succès</h2>
    <p>Votre demande a bien été soumise.</p>

    <div>
        <a href="creer_demande.php" class="btn btn-success btn-custom"><i class="fas fa-plus-circle"></i> Nouvelle Demande</a>
        <a href="index.php" class="btn btn-outline-primary btn-custom"><i class="fas fa-home"></i> Retour à l'accueil</a>
    </div>
</div>

<!-- Scripts -->
<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
