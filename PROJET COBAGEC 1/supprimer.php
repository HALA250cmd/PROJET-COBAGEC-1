<?php
require_once 'config.php';

if (!isset($_GET['id'])) {
    die("ID de la demande non fourni");
}

$id = $_GET['id'];

try {
    // Supprimer la demande dans la base de données
    $stmt = $pdo->prepare("DELETE FROM demandes_appel_offres WHERE id = :id");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    // Redirection vers la page de liste après suppression
    header("Location: liste_demandes.php");
    exit();
} catch (PDOException $e) {
    die("Erreur lors de la suppression : " . $e->getMessage());
}
