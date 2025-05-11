<?php
require_once '../db.php';

// Obtener todos los eventos ordenados
$stmt = $pdo->query("SELECT * FROM eventos ORDER BY orden ASC, fecha DESC");
$eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Panel de Administración - Eventos</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-5">
    <h1 class="mb-4">Panel de Administración de Eventos</h1>
    <a href="agregar.php" class="btn btn-success mb-4">+ Agregar Nuevo Evento</a>

    <table class="table table-bordered table-hover bg-white shadow">
      <thead class="table-dark">
        <tr>
          <th>Orden</th>
          <th>Título</th>
          <th>Tipo</th>
          <th>Fecha</th>
          <th>Lugar</th>
          <th>Imagen</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($eventos as $evento): ?>
          <tr>
            <td><?= $evento['orden'] ?></td>
            <td><?= htmlspecialchars($evento['titulo']) ?></td>
            <td><?= $evento['tipo_evento'] ?></td>
            <td><?= $evento['fecha'] ?></td>
            <td><?= htmlspecialchars($evento['lugar']) ?></td>
            <td>
              <?php if ($evento['imagen']): ?>
                <img src="../admin/subir/<?= $evento['imagen'] ?>" width="100" class="img-thumbnail">
              <?php else: ?>
                <small class="text-muted">Sin imagen</small>
              <?php endif; ?>
            </td>
            <td>
              <a href="editar.php?id=<?= $evento['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
              <a href="eliminar.php?id=<?= $evento['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Seguro que quieres eliminar este evento?')">Eliminar</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
