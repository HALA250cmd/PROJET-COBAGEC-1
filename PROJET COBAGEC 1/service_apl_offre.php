<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Service Appel d'Offres | COBAGEC</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/styl.css">

</head>
<body>

<header>
    <h1><i class="fas fa-folder-open"></i> Service Appel d'Offres</h1>
    <p>Bienvenue dans l'espace des demandes internes</p>
</header>

 <!-- Logo centré -->
 <div class="logo-header">
        <img src="assets/images/mes_im/logo.png" alt="Logo COBAGEC" class="logo-img">
    </div>
</div>

<section class="actions">
    <a href="creer_demande.php" class="btn-service">
        <i class="fas fa-plus-circle"></i> Créer une nouvelle demande
    </a>
    <a href="liste_demandes.php" class="btn-service">
        <i class="fas fa-list"></i> Voir les demandes existantes
    </a>
</section>

<footer id="footer" class="footer bg-dark text-light pt-4">
    <div class="container">
        <div class="row align-items-center mb-3">
            <div class="col-md-3 mb-3 mb-md-0">
                <a class="navbar-brand text-light fw-bold" href="#">
                    COBAGEC<span class="text-warning">SARL</span>
                </a>
            </div>
            <div class="col-md-9">
                <ul class="list-inline text-md-end mb-0 footer-menu-item">
                    <li class="list-inline-item mx-2"><a class="text-light text-decoration-none" href="#">Accueil</a></li>
                    <li class="list-inline-item mx-2"><a class="text-light text-decoration-none" href="#">Services</a></li>
                    <li class="list-inline-item mx-2"><a class="text-light text-decoration-none" href="#">Contact</a></li>
                    <li class="list-inline-item mx-2"><a class="text-light text-decoration-none" href="logout.php">Déconnexion</a></li>
                </ul>
            </div>
        </div>

        <div class="row border-top pt-3">
            <div class="col-md-6">
                <p class="mb-0">&copy; 2025 COBAGEC. Tous droits réservés.</p>
            </div>
            <div class="col-md-6 text-md-end">
                <div class="footer-social">
                    <a href="#" class="text-light me-2"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="text-light me-2"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-light me-2"><i class="fab fa-linkedin"></i></a>
                    <a href="#" class="text-light"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>


</body>
</html>
