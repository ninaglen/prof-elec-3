<?php
require_once 'config/database.php';
require_once 'classes/FoodGroup.php';

$foodGroup = new FoodGroup($db);

$search_query = $_GET['search'] ?? '';
$category_filter = $_GET['category'] ?? '';
$page = isset($_GET['page']) ? max((int)$_GET['page'], 1) : 1;
$limit = 10;
$offset = ($page - 1) * $limit;

$foods = [];
$total_foods = 0;

if ($search_query) {
    $result = $foodGroup->searchFoods($search_query, $limit, $offset);
    $total_foods = $foodGroup->countSearchResults($search_query);
} elseif ($category_filter) {
    $result = $foodGroup->getFoodsByCategory($category_filter, $limit, $offset);
    $total_foods = $foodGroup->countFoodsByCategory($category_filter);
} else {
    $result = $foodGroup->getAllFoods($limit, $offset);
    $total_foods = $foodGroup->getFoodCount();
}

while ($row = $result->fetch()) {
    $foods[] = $row;
}

$total_pages = ceil($total_foods / $limit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Go Grow Glow Tracker</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="container">
    <header>
        <h1>🥗 Go, Grow, Glow Tracker</h1>
        <form method="GET" class="filter-form">
            <input type="text" name="search" placeholder="Search foods..." value="<?= htmlspecialchars($search_query) ?>">
            <select name="category" onchange="this.form.submit()">
                <option value="">All Categories</option>
                <option value="Go" <?= $category_filter === 'Go' ? 'selected' : '' ?>>Go</option>
                <option value="Grow" <?= $category_filter === 'Grow' ? 'selected' : '' ?>>Grow</option>
                <option value="Glow" <?= $category_filter === 'Glow' ? 'selected' : '' ?>>Glow</option>
            </select>
            <button type="submit">Search</button>
        </form>
    </header>

    <section class="food-grid">
        <?php foreach ($foods as $food): ?>
            <div class="food-card" onclick="openModal(<?= $food['id'] ?>)">
                <div class="food-image">
                    <img src="<?= htmlspecialchars($food['image_url']) ?>" alt="<?= htmlspecialchars($food['food_name']) ?>" onerror="this.src='assets/img/fallback.png'">
                </div>
                <div class="food-name"><?= htmlspecialchars($food['food_name']) ?></div>
                <div class="food-category category-<?= strtolower($food['category']) ?>">
                    <?= htmlspecialchars($food['category']) ?>
                </div>
            </div>

            <!-- Modal -->
            <div id="modal-<?= $food['id'] ?>" class="modal">
                <div class="modal-content">
                    <span class="close" onclick="closeModal(<?= $food['id'] ?>)">&times;</span>
                    <h2><?= htmlspecialchars($food['food_name']) ?></h2>
                    <p><strong>Category:</strong> <?= $food['category'] ?></p>
                    <p><strong>Benefits:</strong> <?= htmlspecialchars($food['benefits']) ?></p>
                    <p><strong>Serving Size:</strong> <?= htmlspecialchars($food['serving_size']) ?></p>
                    <img src="<?= htmlspecialchars($food['image_url']) ?>" alt="<?= htmlspecialchars($food['food_name']) ?>" onerror="this.src='assets/img/fallback.png'">
                </div>
            </div>
        <?php endforeach; ?>
    </section>

    <?php if ($total_pages > 1): ?>
        <div class="pagination">
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <a href="?<?= http_build_query(array_merge($_GET, ['page' => $i])) ?>" class="<?= $page === $i ? 'active' : '' ?>">Page <?= $i ?></a>
            <?php endfor; ?>
        </div>
    <?php endif; ?>
</div>

<script>
    function openModal(id) {
        document.getElementById('modal-' + id).style.display = 'block';
    }
    function closeModal(id) {
        document.getElementById('modal-' + id).style.display = 'none';
    }
    window.onclick = function(event) {
        if (event.target.classList.contains('modal')) {
            event.target.style.display = 'none';
        }
    }
</script>
</body>
</html>
