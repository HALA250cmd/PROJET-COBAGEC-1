<?php
require 'config.php';
session_start();

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $stmt = $pdo->prepare("SELECT id, password FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: index.php");
        exit();
    } else {
        $message = "Identifiants incorrects.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
    <style>
        body { font-family: Arial; background: #f5f5f5; }
        form { background: #fff; padding: 20px; width: 300px; margin: 100px auto; border-radius: 10px; box-shadow: 0 0 10px #ccc; }
        input { width: 100%; margin: 10px 0; padding: 10px; }
        .error { color: red; font-size: 14px; }
    </style>
</head>
<body>
    <form method="POST">
        <h2>Connexion</h2>
        <?php if ($message): ?><p class="error"><?= $message ?></p><?php endif; ?>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <button type="submit">Se connecter</button>
        <p>Pas encore inscrit ? <a href="register.php">Créer un compte</a></p>
    </form>
</body>
</html>
