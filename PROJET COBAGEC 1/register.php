<?php
require 'config.php';

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm = trim($_POST['confirm']);

    if ($password !== $confirm) {
        $message = "Les mots de passe ne correspondent pas.";
    } else {
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->fetch()) {
            $message = "Email déjà utilisé.";
        } else {
            $hash = password_hash($password, PASSWORD_BCRYPT);
            $pdo->prepare("INSERT INTO users (email, password) VALUES (?, ?)")->execute([$email, $hash]);
            header("Location: login.php");
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
    <style>
        body { font-family: Arial; background: #f5f5f5; }
        form { background: #fff; padding: 20px; width: 300px; margin: 100px auto; border-radius: 10px; box-shadow: 0 0 10px #ccc; }
        input { width: 100%; margin: 10px 0; padding: 10px; }
        .error { color: red; font-size: 14px; }
    </style>
</head>
<body>
    <form method="POST">
        <h2>Créer un compte</h2>
        <?php if ($message): ?><p class="error"><?= $message ?></p><?php endif; ?>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Mot de passe" required>
        <input type="password" name="confirm" placeholder="Confirmer le mot de passe" required>
        <button type="submit">S'inscrire</button>
        <p>Déjà un compte ? <a href="login.php">Connecte-toi</a></p>
    </form>
</body>
</html>
