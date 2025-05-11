<?php
// Configuración de conexión
$host = 'localhost';
$dbname = 'magonistas_db';
$username = 'root'; // o el usuario que tengas en tu servidor
$password = '';     // tu contraseña de MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    // Establecer modo de errores de PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar a la base de datos: " . $e->getMessage());
}
?>
