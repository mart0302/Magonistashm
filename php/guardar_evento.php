<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $titulo = trim($_POST['titulo']);
  $descripcion = trim($_POST['descripcion']);
  $fecha = $_POST['fecha'];
  $lugar = trim($_POST['lugar']);
  $kilometros = $_POST['kilometros'] ?: null;
  $tipo_evento = trim($_POST['tipo_evento']);
  $orden = $_POST['orden'] ?: 0;

  $imagen_nombre = null;
  if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $nombre_original = basename($_FILES['imagen']['name']);
    $nombre_limpio = str_replace(['"', "'"], '', $nombre_original);
    $ext = pathinfo($nombre_limpio, PATHINFO_EXTENSION);
    $imagen_nombre = uniqid('evento_') . '.' . strtolower($ext);


    $destino = __DIR__ . '/admin/subir/';
    if (!is_dir($destino)) {
      mkdir($destino, 0777, true);
    }

    move_uploaded_file($_FILES['imagen']['tmp_name'], $destino . $imagen_nombre);
  }

  $sql = "INSERT INTO eventos (titulo, descripcion, fecha, lugar, kilometros, tipo_evento, imagen, orden)
          VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([
    $titulo,
    $descripcion,
    $fecha,
    $lugar,
    $kilometros,
    $tipo_evento,
    $imagen_nombre,
    $orden
  ]);

  header("Location: admin/index.php");
  exit;
}
?>
