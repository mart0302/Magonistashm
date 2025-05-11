<?php require_once '../db.php'; ?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Agregar Evento</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-5">
    <h2 class="mb-4">Agregar Nuevo Evento</h2>
    <form action="../guardar_evento.php" method="POST" enctype="multipart/form-data">
      <div class="mb-3">
        <label>Título</label>
        <input type="text" name="titulo" class="form-control" required>
      </div>

      <div class="mb-3">
        <label>Descripción</label>
        <textarea name="descripcion" class="form-control" rows="4" required></textarea>
      </div>

      <div class="mb-3">
        <label>Fecha</label>
        <input type="date" name="fecha" class="form-control" required>
      </div>

      <div class="mb-3">
        <label>Lugar</label>
        <input type="text" name="lugar" class="form-control" required>
      </div>

      <div class="mb-3">
        <label>Kilómetros (opcional)</label>
        <input type="number" name="kilometros" class="form-control">
      </div>

      <div class="mb-3">
        <label>Tipo de evento</label>
        <select name="tipo_evento" class="form-select" required>
          <option value="Rodada">Rodada</option>
          <option value="Benéfico">Benéfico</option>
          <option value="Convivencia">Convivencia</option>
          <option value="Taller">Taller</option>
          <option value="Otro">Otro</option>
        </select>
      </div>

      <div class="mb-3">
        <label>Imagen (JPG, PNG)</label>
        <input type="file" name="imagen" class="form-control" accept="image/*">
      </div>

      <div class="mb-3">
        <label>Orden de aparición</label>
        <input type="number" name="orden" class="form-control" value="0">
      </div>

      <button type="submit" class="btn btn-success">Guardar Evento</button>
      <a href="index.php" class="btn btn-secondary">Cancelar</a>
    </form>
  </div>
</body>
</html>
