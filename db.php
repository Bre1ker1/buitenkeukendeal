<?php
$host = 'yamanote.proxy.rlwy.net'; // Ejemplo: monorail.proxy.rlwy.net
$port = '38546'; // El número que dice en MYSQLPORT
$dbname = 'railway';
$user = 'root';
$pass = 'eZtcAkGetBDQfcXURXdOKPrFIQBzUWZg';
$charset = 'utf8mb4';

// Agregamos el puerto a la cadena de conexión
$dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    // Si querés saber si conectó, podés poner: echo "¡Conectado!";
} catch (\PDOException $e) {
    $db_error = $e->getMessage();
}
