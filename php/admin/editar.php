<?php
require_once '../db.php';

// Validar que venga un ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
  die('ID de evento no válido.');
}

$id = $_GET['id'];

// Obtener datos del evento
$stmt = $pdo->prepare("SELECT * FROM eventos WHERE id = ?");
$stmt->execute([$id]);
$evento = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$evento) {
  die('Evento no encontrado.');
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Editar Evento</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-5">
    <h2 class="mb-4">Editar Evento</h2>

    <form action="../actualizar_evento.php" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="id" value="<?= $evento['id'] ?>">

      <div class="mb-3">
        <label>Título</label>
        <input type="text" name="titulo" class="form-control" value="<?= htmlspecialchars($evento['titulo']) ?>" required>
      </div>

      <div class="mb-3">
        <label>Descripción</label>
        <textarea name="descripcion" class="form-control" rows="4" required><?= htmlspecialchars($evento['descripcion']) ?></textarea>
      </div>

      <div class="mb-3">
        <label>Fecha</label>
        <input type="date" name="fecha" class="form-control" value="<?= $evento['fecha'] ?>" required>
      </div>

      <div class="mb-3">
        <label>Lugar</label>
        <input type="text" name="lugar" class="form-control" value="<?= htmlspecialchars($evento['lugar']) ?>" required>
      </div>

      <div class="mb-3">
        <label>Kilómetros</label>
        <input type="number" name="kilometros" class="form-control" value="<?= $evento['kilometros'] ?>">
      </div>

      <div class="mb-3">
        <label>Tipo de evento</label>
        <select name="tipo_evento" class="form-select" required>
          <?php
          $tipos = ['Rodada', 'Benéfico', 'Convivencia', 'Taller', 'Otro'];
          foreach ($tipos as $tipo) {
            $selected = ($evento['tipo_evento'] === $tipo) ? 'selected' : '';
            echo "<option value=\"$tipo\" $selected>$tipo</option>";
          }
          ?>
        </select>
      </div>

      <div class="mb-3">
        <label>Imagen actual:</label><br>
        <?php if ($evento['imagen']): ?>
          <img src="subir/<?= $evento['imagen'] ?>" width="150" class="img-thumbnail mb-2">
        <?php else: ?>
          <small class="text-muted">No hay imagen</small>
        <?php endif; ?>
      </div>

      <div class="mb-3">
        <label>Reemplazar imagen:</label>
        <input type="file" name="imagen" class="form-control" accept="image/*">
      </div>

      <div class="mb-3">
        <label>Orden</label>
        <input type="number" name="orden" class="form-control" value="<?= $evento['orden'] ?>">
      </div>

      <button type="submit" class="btn btn-primary">Actualizar Evento</button>
      <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
  </div>
</body>
</html>
