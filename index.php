<?php
require_once 'config.php';

$search = $_GET['search'] ?? '';
$search_sql = $conn->real_escape_string($search);

$sql = "SELECT * FROM foods WHERE name LIKE '%$search_sql%' OR category LIKE '%$search_sql%' ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Go, Grow, Glow Foods</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
  <div class="container">
    <h1 class="mb-4">Go, Grow, Glow Food Database</h1>

    <form method="get" class="mb-3">
      <input type="text" name="search" class="form-control" placeholder="Search by name or category..." value="<?= htmlspecialchars($search) ?>">
    </form>

    <div class="row">
      <?php while($row = $result->fetch_assoc()): ?>
        <div class="col-md-4 mb-4">
          <div class="card h-100">
            <img src="<?= htmlspecialchars($row['image_url']) ?>" class="card-img-top" alt="<?= htmlspecialchars($row['name']) ?>" style="height: 200px; object-fit: cover;">
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($row['name']) ?> <small class="text-muted">(<?= $row['category'] ?>)</small></h5>
              <p class="card-text"><?= htmlspecialchars($row['description']) ?></p>
            </div>
          </div>
        </div>
      <?php endwhile; ?>
    </div>
  </div>
</body>
</html>
