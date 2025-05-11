<?php
require_once '../db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  die('ID de evento no válido.');
}

$id = $_GET['id'];

// Obtener nombre de imagen
$stmt = $pdo->prepare("SELECT imagen FROM eventos WHERE id = ?");
$stmt->execute([$id]);
$evento = $stmt->fetch(PDO::FETCH_ASSOC);

if ($evento && $evento['imagen']) {
  $ruta = __DIR__ . '/subir/' . $evento['imagen'];
  if (file_exists($ruta)) {
    unlink($ruta); // Eliminar imagen del servidor
  }
}

// Eliminar evento de la base de datos
$stmt = $pdo->prepare("DELETE FROM eventos WHERE id = ?");
$stmt->execute([$id]);

header("Location: index.php");
exit;
?>
