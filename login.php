<?php
session_start();
if(isset($_SESSION['user_id'])) {
    header("Location: index.php"); // Si ya estás logueado, ve directo adentro
    exit();
}

require 'db.php';
$error = '';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();
    
    if($user && password_verify($password, $user['password_hash'])) {
        // Credenciales correctas
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['avatar_path'] = $user['avatar_path'];
        $_SESSION['email'] = $user['email'];
        header("Location: index.php");
        exit();
    } else {
        $error = "Nombre de usuario o contraseña incorrectos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Restringido - AETERNA ESPORTS</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/forms.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&family=Rajdhani:wght@500;700&display=swap" rel="stylesheet">
</head>
<body style="justify-content:center; align-items:center; background-image: radial-gradient(circle at 50% 50%, #1c2135 0%, #07090f 100%); min-height: 100vh;">
    <div class="contact-container" style="max-width: 450px; width: 90%; text-align: center; margin: 0;">
        <h2 class="logo glow" style="font-size:2.5rem; margin-bottom: 0.5rem; letter-spacing: 2px;">AETERNA<span>ESPORTS</span></h2>
        <p style="color:var(--text-sub); margin-bottom: 2rem;">Acceso Protegido - Área de Miembros</p>
        
        <?php if($error): ?>
            <div style="background: rgba(255, 70, 85, 0.1); border: 1px solid var(--accent); color: var(--text-main); padding: 10px; border-radius: 5px; margin-bottom: 1rem;">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group" style="text-align: left; margin-bottom: 1rem;">
                <label>Nombre de Usuario</label>
                <input type="text" name="username" placeholder="Ingresa tu ID de usuario" required>
            </div>
            <div class="form-group" style="text-align: left; margin-bottom: 2rem;">
                <label>Contraseña</label>
                <input type="password" name="password" placeholder="Tu clave secreta" required>
            </div>
            <button type="submit" class="btn-submit" style="width: 100%; letter-spacing: 1px;">Ingresar al Sistema</button>
        </form>
        <p style="margin-top: 1.5rem; color: var(--text-sub);">¿Eres nuevo fan? <a href="register.php" style="color: var(--accent); text-decoration: none; font-weight: bold;">Crea Cuenta Pública aquí</a>.</p>
    </div>
</body>
</html>


