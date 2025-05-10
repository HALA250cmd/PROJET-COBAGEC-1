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
    <title>Page D'Accueil</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #0e66b3;
            color: white;
            text-align: center;
            padding-top: 60px;
        }

        h2 {
            font-weight: 600;
            margin-bottom: 40px;
        }

        .logout-btn {
            position: absolute;
            top: 20px;
            right: 30px;
            background: #e74c3c;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
        }

        .services-grid {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }

        .service-card {
            background: #f5f5f5;
            color:rgb(6, 6, 6);
            border-radius: 15px;
            padding: 30px 20px;
            width: 220px;
            text-align: center;
            transition: 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-5px);
            background: #e6f0ff;
        }

        .service-card i {
            font-size: 36px;
            margin-bottom: 15px;
        }

        .service-card a {
            text-decoration: none;
            font-weight: bold;
            color: inherit;
        }

        footer {
            margin-top: 50px;
            padding: 20px;
            background: #0c4e88;
        }

        footer .social a {
            color: white;
            margin: 0 10px;
            font-size: 20px;
        }
    </style>
</head>
<body>

    <a class="logout-btn" href="logout.php"><i class="fas fa-sign-out-alt"></i> Déconnexion</a>

    <h2>LOGICIEL DE GESTION<br>DES DEMANDES POUR LE COMPTE DE COBAGEC SARL</h2>

    <div class="services-grid">
        <?php
        $services = [
            ["SERVICE APPELS D'OFFRES", "fa-file-lines", "service_apl_offre.php"],
            ["SERVICE TRAVAUX", "fa-screwdriver-wrench", "service_travaux.php"],
            ["SERVICE COMPTABILITÉ", "fa-calculator", "service_compta.php"],
            ["SERVICE MOYENS GÉNÉRAUX", "fa-gears", "service_moyens.php"],
            ["SERVICE DIRECTION GÉNÉRAL", "fa-user-tie", "service_direction.php"],
            ["SERVICE AMÉNAGEMENT", "fa-drafting-compass", "service_amenagement.php"],
            ["SERVICE MARKETING", "fa-bullhorn", "service_marketing.php"]
        ];

        foreach ($services as $service) {
            echo '<div class="service-card">
                    <i class="fas ' . $service[1] . '"></i>
                    <div><a href="' . $service[2] . '">' . $service[0] . '</a></div>
                </div>';
        }
        ?>
    </div>

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


    <!-- Scripts -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
