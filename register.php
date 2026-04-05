<?php
session_start();
if(isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

require 'db.php';
$error = '';
$success = '';

if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    
    // Verificar si existe
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->execute([$username]);
    if($stmt->rowCount() > 0) {
        $error = "Ese Nombre de Usuario ya está ocupado por otro fan. Elige otro.";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $insert = $pdo->prepare("INSERT INTO users (username, password_hash, role) VALUES (?, ?, 'user')");
        if($insert->execute([$username, $hash])) {
            $success = "¡Cuenta de Fan creada a la perfección! Ahora puedes iniciar sesión.";
        } else {
            $error = "Error al crear la cuenta. Intenta más tarde.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - AETERNA ESPORTS</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/forms.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&family=Rajdhani:wght@500;700&display=swap" rel="stylesheet">
</head>
<body style="justify-content:center; align-items:center; background-image: radial-gradient(circle at 50% 50%, #1c2135 0%, #07090f 100%); min-height: 100vh;">
    <div class="contact-container" style="max-width: 450px; width: 90%; text-align: center; margin: 0;">
        <h2 class="logo glow" style="font-size:2rem; margin-bottom: 0.5rem; letter-spacing: 2px;">AETERNA<span>ESPORTS</span></h2>
        <p style="color:var(--text-sub); margin-bottom: 2rem;">Registro para Nuevos Seguidores</p>
        
        <?php if($error): ?>
            <div style="background: rgba(255, 70, 85, 0.1); border: 1px solid var(--accent); color: var(--text-main); padding: 10px; border-radius: 5px; margin-bottom: 1rem;">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>
        
        <?php if($success): ?>
            <div style="background: rgba(6, 214, 160, 0.1); border: 1px solid #06d6a0; color: #06d6a0; padding: 15px; border-radius: 5px; margin-bottom: 1rem;">
                <strong><?= $success ?></strong><br><br>
                <a href="login.php" class="btn-submit" style="display:inline-block; width:100%; text-decoration:none; margin-top:0;">Ir al Panel de Login</a>
            </div>
        <?php else: ?>
            <form method="POST" action="">
                <div class="form-group" style="text-align: left; margin-bottom: 1rem;">
                    <label>Elige tu Nickname / Usuario</label>
                    <input type="text" name="username" placeholder="Tu apodo" required minlength="3" maxlength="20">
                </div>
                <div class="form-group" style="text-align: left; margin-bottom: 2rem;">
                    <label>Contraseña Maestra</label>
                    <input type="password" name="password" placeholder="Mínimo 6 caracteres" required minlength="6">
                </div>
                <button type="submit" class="btn-submit" style="width: 100%;">Registrarse como Fan</button>
            </form>
        <?php endif; ?>
        <p style="margin-top: 1.5rem; color: var(--text-sub);">¿Ya perteneces a Aeterna? <a href="login.php" style="color: var(--accent); text-decoration: none; font-weight: bold;">Entra aquí</a>.</p>
    </div>
</body>
</html>


