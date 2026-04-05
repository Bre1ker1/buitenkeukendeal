<?php
// update_db.php - ¡Ejecutar una sola vez en el navegador!
require 'db.php';
try {
    $pdo->exec("ALTER TABLE users 
                ADD COLUMN email VARCHAR(100) NULL AFTER username,
                ADD COLUMN avatar_path VARCHAR(255) NULL AFTER email");
    echo "<h2 style='color:green; font-family:sans-serif;'>¡Base de Datos Actualizada!</h2>";
    echo "Columnas Email y Foto de Perfil añadidas. Tu plataforma ya es de Vanguardia.<br><br>";
    echo "<a href='index.php'>Volver al Inicio</a>";
} catch(PDOException $e) {
    if (strpos($e->getMessage(), 'Duplicate column name') !== false) {
        echo "<h2 style='color:orange; font-family:sans-serif;'>Las columnas ya existen en MySQL. Todo listo.</h2>";
    } else {
        die("Error DB: " . $e->getMessage());
    }
}
?>

