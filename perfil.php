<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
require 'db.php';
$user_id = $_SESSION['user_id'];
$success = '';
$error = '';

// Buscar toda la data del usuario actual
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$current_user = $stmt->fetch();

// Si enviaron el formulario PESTAÑA PERFIL NORMAL
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_profile'])) {
    $new_usern = trim($_POST['username']);
    $new_email = trim($_POST['email']);
    
    // Validar que el nuevo Username no exista en otro ID
    $check = $pdo->prepare("SELECT id FROM users WHERE username = ? AND id != ?");
    $check->execute([$new_usern, $user_id]);
    if ($check->rowCount() > 0) {
        $error = "Ese Nombre de Usuario ya está ocupado por otro jugador.";
    } else {
        $upd = $pdo->prepare("UPDATE users SET username=?, email=? WHERE id=?");
        if ($upd->execute([$new_usern, $new_email, $user_id])) {
            $_SESSION['username'] = $new_usern;
            $_SESSION['email'] = $new_email;
            $current_user['username'] = $new_usern;
            $current_user['email'] = $new_email;
            $success = "¡Datos guardados! El Rol de equipo permanece igual.";
        }
    }
}

// Si enviaron el formulario PESTAÑA CONTRASEÑA
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_password'])) {
    if(strlen($_POST['new_password']) >= 6) {
        $hash = password_hash($_POST['new_password'], PASSWORD_DEFAULT);
        $upd = $pdo->prepare("UPDATE users SET password_hash=? WHERE id=?");
        $upd->execute([$hash, $user_id]);
        $success = "¡Contraseña actualizada! Tu cuenta está blindada.";
    } else {
        $error = "La contraseña debe tener mínimo 6 caracteres.";
    }
}

// Si subieron AVATAR
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0) {
    $allowed = ['jpg','jpeg','png','gif'];
    $filename = $_FILES['avatar']['name'];
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    
    if(in_array($ext, $allowed)) {
        // Renombrar el archivo para evitar inyecciones e invasiones "avatar_1_timestamp.png"
        $new_name = 'avatar_' . $user_id . '_' . time() . '.' . $ext;
        $dest = 'uploads/avatars/' . $new_name;
        
        if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dest)) {
            // Guardar ruta en BD
            $upd = $pdo->prepare("UPDATE users SET avatar_path=? WHERE id=?");
            $upd->execute([$dest, $user_id]);
            $_SESSION['avatar_path'] = $dest;
            $current_user['avatar_path'] = $dest;
            $success = "Foto de Perfil subida a la Matrix.";
        } else { $error = "Error físico al tratar de mover el archivo al disco duro. Chequea permisos."; }
    } else { $error = "Formato prohibido. Usa solamente un hermoso PNG o un JPG genérico."; }
}

$avatar_real = $current_user['avatar_path'] ? $current_user['avatar_path'] : 'images/default_avatar.jpg'; // O podemos usar fontawesome en la vista
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Cuenta - AETERNA ESPORTS</title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/forms.css">
    <link rel="stylesheet" href="css/store.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&family=Rajdhani:wght@500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <!-- Menú de Navegación Universal AETERNA -->
    <nav class="navbar">
        <a href="index.php" class="nav-logo" style="text-decoration:none;">AETERNA</a>
        <div class="nav-links" id="nav-links">
            <a href="index.php">Roster</a>
            <a href="calendario.php">Partidos</a>
            <a href="tienda.php">Tienda</a>
            <a href="contacto.php">Contacto</a>
            <?php
            $nav_av = isset($_SESSION['avatar_path']) && !empty($_SESSION['avatar_path']) ? $_SESSION['avatar_path'] : '';
            if($nav_av) {
                echo '<a href="perfil.php" style="margin-left: 2rem; display:inline-flex; align-items:center;"><img src="'.$nav_av.'" style="width:35px; height:35px; border-radius:50%; object-fit:cover; border:2px solid var(--accent); margin-right:8px;"> <span style="color:var(--accent);">'.$_SESSION['username'].'</span></a>';
            } else {
                echo '<a href="perfil.php" style="margin-left: 2rem; display:inline-flex; align-items:center; color:var(--accent);"><i class="fa-solid fa-user-astronaut" style="font-size:1.5rem; margin-right:8px;"></i> '.$_SESSION['username'].'</a>';
            }
            ?>
        </div>
        <a href="logout.php" style="color:var(--text-sub); font-weight:bold; font-family:var(--font-heading); text-transform:uppercase; text-decoration:none; margin-left: auto; margin-right: 20px;" class="desktop-only"><i class="fa-solid fa-right-from-bracket"></i> Salir</a>
        <div class="hamburger" id="hamburger"><i class="fa-solid fa-bars"></i></div>
    </nav>

    <main class="container page-content">
        <h2 class="section-title reveal-on-scroll">Ajustes de Perfil</h2>
        
        <div class="reveal-on-scroll" style="animation-delay: 0.1s;">
            <?php if($error): ?>
                <div style="background: rgba(255, 70, 85, 0.1); border: 1px solid var(--accent); color: var(--text-main); padding: 10px; border-radius: 5px; margin-bottom: 2rem; max-width:800px; margin-inline:auto;">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>
            <?php if($success): ?>
                <div style="background: rgba(6, 214, 160, 0.1); border: 1px solid #06d6a0; color: #06d6a0; padding: 15px; border-radius: 5px; margin-bottom: 2rem; max-width:800px; margin-inline:auto;">
                    <strong><?= $success ?></strong>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="store-grid" style="align-items:start;">
            
            <!-- PANEL DE AVATAR -->
            <article class="contact-container reveal-on-scroll" style="margin:0; width:100%;">
                <h3 style="color:var(--accent); font-family:var(--font-heading); font-size:1.6rem; margin-bottom: 1.5rem;"><i class="fa-regular fa-image"></i> Tu Rostro (Avatar)</h3>
                <div style="text-align:center; margin-bottom:2rem;">
                    <?php if($current_user['avatar_path']): ?>
                        <img src="<?= htmlspecialchars($current_user['avatar_path']) ?>" alt="Avatar" style="width:150px; height:150px; border-radius:50%; object-fit:cover; border:3px solid var(--accent); box-shadow:0 0 20px rgba(255,70,85,0.4);">
                    <?php else: ?>
                        <i class="fa-solid fa-user-astronaut" style="font-size:6rem; color:var(--text-sub);"></i>
                        <p style="color:var(--text-sub); margin-top:1rem;">Aún no has subido foto. Pareces un bot.</p>
                    <?php endif; ?>
                </div>
                
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group" style="margin-bottom:1rem;">
                        <input type="file" name="avatar" accept="image/png, image/jpeg, image/gif" required style="padding:0.5rem; background:transparent; border:1px dashed var(--accent);">
                    </div>
                    <button type="submit" class="btn-buy"><i class="fa-solid fa-cloud-arrow-up"></i> Inyectar Foto de Perfil</button>
                </form>
            </article>

            <!-- PANEL DATOS CUENTA -->
            <article class="contact-container reveal-on-scroll" style="margin:0; width:100%;">
                 <h3 style="color:white; font-family:var(--font-heading); font-size:1.6rem; margin-bottom: 1.5rem;"><i class="fa-solid fa-id-card"></i> Identificación del Sistema</h3>
                 
                 <form method="POST" action="" style="margin-bottom:3rem;">
                     <!-- Trick to identify which form was sent -->
                     <input type="hidden" name="update_profile" value="1">
                     
                     <div class="form-group" style="margin-bottom:1rem;">
                         <label>Alias Público / Username</label>
                         <input type="text" name="username" value="<?= htmlspecialchars($current_user['username']) ?>" required>
                     </div>
                     <div class="form-group" style="margin-bottom:1.5rem;">
                         <label>Correo Electrónico (Email)</label>
                         <input type="email" name="email" value="<?= htmlspecialchars($current_user['email']) ?>" placeholder="Aún sin configurar">
                     </div>
                     <div class="form-group" style="margin-bottom:1rem;">
                         <label>Tu Rol</label>
                         <input type="text" value="<?= strtoupper($current_user['role']) ?>" disabled style="color: <?= $current_user['role']==='admin'?'var(--accent)':'var(--role-entry)' ?>; font-weight:bold; opacity:0.8;">
                     </div>
                     <button type="submit" class="btn-submit">Guardar Datos de Jugador</button>
                 </form>

                 <hr style="border-color:var(--card-border); margin-bottom: 2rem;">

                 <h3 style="color:white; font-family:var(--font-heading); font-size:1.2rem; margin-bottom: 1.5rem;"><i class="fa-solid fa-shield-halved"></i> Cambio de Protocolo de Seguridad</h3>
                 <form method="POST" action="">
                    <input type="hidden" name="update_password" value="1">
                    <div class="form-group" style="margin-bottom:1rem;">
                         <label>Nueva Contraseña</label>
                         <input type="password" name="new_password" placeholder="Minimo 6 caracteres" required minlength="6">
                     </div>
                     <button type="submit" class="btn-buy" style="border-color:#a1a6b4; color:#a1a6b4;">Establecer Nueva Llave</button>
                 </form>
            </article>

        </div>
    </main>

    <footer class="footer">
        <div class="footer-bottom">
            <p>&copy; 2026 AETERNA Esports. Sistema Base Protegida.</p>
        </div>
    </footer>
    <script src="js/script.js"></script>
</body>
</html>


