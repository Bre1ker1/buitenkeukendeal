<?php
// setup.php - Solo ejecutar una vez para armar la base de datos
$host = 'localhost';
$user = 'root'; // Usuario por defecto de XAMPP
$pass = '';     // Contraseña vacía por defecto de XAMPP

try {
    $pdo = new PDO("mysql:host=$host", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // 1. Crear Base de Datos
    $pdo->exec("CREATE DATABASE IF NOT EXISTS aeterna_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    $pdo->exec("USE aeterna_db");
    
    // 2. Crear Tabla de Usuarios
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        password_hash VARCHAR(255) NOT NULL,
        role ENUM('user', 'admin') DEFAULT 'user',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    $pdo->exec($sql);
    
    // 3. Crear Tu Cuenta Admin
    $admin_user = 'Brian';
    $admin_pass = password_hash('bngz95173', PASSWORD_DEFAULT);
    
    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
    $stmt->execute([$admin_user]);
    
    if($stmt->rowCount() == 0) {
        $insert = $pdo->prepare("INSERT INTO users (username, password_hash, role) VALUES (?, ?, 'admin')");
        $insert->execute([$admin_user, $admin_pass]);
        echo "<h2 style='color:green; font-family:sans-serif;'>¡Éxito! Base de Datos 'aeterna_db' creada. Administrador 'Brian' inyectado con privilegios máximos.</h2><br>";
    } else {
        echo "<h2 style='color:orange; font-family:sans-serif;'>La tabla de base de datos ya está creada y Admin Brian ya existe.</h2><br>";
    }
    
    echo "<h3><a href='login.php' style='color:#ff4655;'>Ir al Sistema de Login Oficial</a></h3>";
    
} catch(PDOException $e) {
    die("Error crítico de MySQL: " . $e->getMessage() . "<br><br><b>¿Encendiste MySQL desde el Panel de Control de XAMPP?</b>");
}
?>

