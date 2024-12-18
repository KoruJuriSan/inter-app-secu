<?php
/**
* index.php
*
* Ce fichier représente une page de connexion pour l'application.
* Il vérifie la présence d'un message d'erreur et l'affiche si nécessaire.
* Une session sécurisée est utilisée pour générer un jeton CSRF et éviter les attaques CSRF.
* Un formulaire HTML est présenté pour permettre à l'utilisateur d'entrer ses identifiants 
* (nom d'utilisateur et mot de passe).
* Les champs du formulaire sont protégés avec des attributs HTML `maxlength` et `required`.
* Le formulaire envoie les données en méthode POST au fichier `login.php` pour authentification.
*/

$error_message = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : '';

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

require_once __DIR__ . '/app/views/templates/header.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Connexion</title>
</head>
<body>
    <h2>Connexion</h2>

    <?php if (!empty($error_message)): ?>
        <p style="color:red;"><?= $error_message; ?></p>
    <?php endif; ?>

    <form method="POST" action="login.php">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" name="username" id="username" maxlength="30" required><br>

        <label for="password">Mot de passe :</label>
        <input type="password" name="password" id="password" maxlength="30" required><br>

        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">

        <button type="submit">Se connecter</button>
    </form>

    <?php require_once __DIR__ . '/app/views/templates/footer.php'; ?>
</body>
</html>
