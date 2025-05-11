<?php
require_once 'db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $id = $_POST['id'];
  $titulo = $_POST['titulo'];
  $descripcion = $_POST['descripcion'];
  $fecha = $_POST['fecha'];
  $lugar = $_POST['lugar'];
  $kilometros = $_POST['kilometros'] ?: null;
  $tipo_evento = $_POST['tipo_evento'];
  $orden = $_POST['orden'] ?: 0;

  // Obtener imagen actual
  $stmt = $pdo->prepare("SELECT imagen FROM eventos WHERE id = ?");
  $stmt->execute([$id]);
  $evento_actual = $stmt->fetch(PDO::FETCH_ASSOC);
  $imagen_actual = $evento_actual['imagen'];

  $nueva_imagen = $imagen_actual;

  // Si se sube una nueva imagen
  if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $nombre_original = $_FILES['imagen']['name'];
    $tmp_path = $_FILES['imagen']['tmp_name'];
    $ext = pathinfo($nombre_original, PATHINFO_EXTENSION);
    $nueva_imagen = uniqid('evento_') . '.' . $ext;

    $destino = __DIR__ . '/admin/subir/';
    if (!is_dir($destino)) {
      mkdir($destino, 0777, true);
    }

    // Guardar nueva imagen
    move_uploaded_file($tmp_path, $destino . $nueva_imagen);

    // Eliminar imagen anterior si existe
    if ($imagen_actual && file_exists($destino . $imagen_actual)) {
      unlink($destino . $imagen_actual);
    }
  }

  // Actualizar la base de datos
  $sql = "UPDATE eventos SET titulo=?, descripcion=?, fecha=?, lugar=?, kilometros=?, tipo_evento=?, imagen=?, orden=? WHERE id=?";
  $stmt = $pdo->prepare($sql);
  $stmt->execute([$titulo, $descripcion, $fecha, $lugar, $kilometros, $tipo_evento, $nueva_imagen, $orden, $id]);

  header("Location: admin/index.php");
  exit;
}
?>
