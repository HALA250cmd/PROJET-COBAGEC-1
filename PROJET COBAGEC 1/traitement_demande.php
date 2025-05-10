<?php
session_start();
require 'config.php';

// Protection CSRF
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
    die("Requête non autorisée.");
}

// Récupération sécurisée des données
$date = $_POST['date_demande'] ?? null;
$service = trim($_POST['service_demandeur'] ?? '');
$nom = trim($_POST['nom_demandeur'] ?? '');
$libelle = trim($_POST['libelle'] ?? '');
$quantite = isset($_POST['quantite']) ? (int) $_POST['quantite'] : null;
$prix = isset($_POST['prix_unitaire']) ? (float) $_POST['prix_unitaire'] : null;
$montant = isset($_POST['montant']) ? (float) $_POST['montant'] : null;
$jours = isset($_POST['nombre_jours']) ? (int) $_POST['nombre_jours'] : null;
$statut = 'en attente'; // Valeur par défaut

// Validation
if (!$date || !$service || !$nom || !$libelle) {
    die("Certains champs obligatoires sont manquants.");
}

// Insertion dans la base
$sql = "INSERT INTO demandes_appel_offres (date_demande, service_demandeur, nom_demandeur, libelle, quantite, prix_unitaire, montant, nombre_jours, statut)
        VALUES (:date, :service, :nom, :libelle, :quantite, :prix, :montant, :jours, :statut)";

$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':date' => $date,
    ':service' => $service,
    ':nom' => $nom,
    ':libelle' => $libelle,
    ':quantite' => $quantite,
    ':prix' => $prix,
    ':montant' => $montant,
    ':jours' => $jours,
    ':statut' => $statut
]);

// Redirection
header("Location: confirmation.php?status=success");
exit();
