<?php
class FoodGroup {
    private $conn;
    private $table_name = "foods";

    public $id;
    public $food_name;
    public $category;
    public $benefits;
    public $serving_size;
    public $image_url;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Get all food entries
    public function getAllFoods($limit = 10, $offset = 0) {
    $query = "SELECT * FROM " . $this->table_name . " ORDER BY category, food_name ASC LIMIT :limit OFFSET :offset";
    $stmt = $this->conn->prepare($query);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt;
}
    // Get food by ID
    public function getFoodById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        return $stmt;
    }

    // Search foods
    public function searchFoods($search_term, $limit = 10, $offset = 0) {
    $query = "SELECT * FROM " . $this->table_name . " 
              WHERE food_name LIKE :term 
              OR category LIKE :term 
              OR benefits LIKE :term 
              ORDER BY food_name ASC 
              LIMIT :limit OFFSET :offset";

    $stmt = $this->conn->prepare($query);
    $term = "%{$search_term}%";
    $stmt->bindValue(':term', $term, PDO::PARAM_STR);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt;
}

    // Filter by category (Go, Grow, Glow)
    public function getFoodsByCategory($category, $limit = 10, $offset = 0) {
    $query = "SELECT * FROM " . $this->table_name . " 
              WHERE category = :category 
              ORDER BY food_name ASC 
              LIMIT :limit OFFSET :offset";

    $stmt = $this->conn->prepare($query);
    $stmt->bindValue(':category', $category, PDO::PARAM_STR);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt;
}

    // Create new food entry
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  (food_name, category, benefits, serving_size, image_url) 
                  VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);

        $this->food_name = htmlspecialchars(strip_tags($this->food_name));
        $this->category = htmlspecialchars(strip_tags($this->category));
        $this->benefits = htmlspecialchars(strip_tags($this->benefits));
        $this->serving_size = htmlspecialchars(strip_tags($this->serving_size));
        $this->image_url = htmlspecialchars(strip_tags($this->image_url));

        $stmt->bindParam(1, $this->food_name);
        $stmt->bindParam(2, $this->category);
        $stmt->bindParam(3, $this->benefits);
        $stmt->bindParam(4, $this->serving_size);
        $stmt->bindParam(5, $this->image_url);

        return $stmt->execute();
    }

    // Update food entry
    public function update() {
        $query = "UPDATE " . $this->table_name . " 
                  SET food_name = ?, category = ?, benefits = ?, serving_size = ?, image_url = ? 
                  WHERE id = ?";

        $stmt = $this->conn->prepare($query);

        $this->food_name = htmlspecialchars(strip_tags($this->food_name));
        $this->category = htmlspecialchars(strip_tags($this->category));
        $this->benefits = htmlspecialchars(strip_tags($this->benefits));
        $this->serving_size = htmlspecialchars(strip_tags($this->serving_size));
        $this->image_url = htmlspecialchars(strip_tags($this->image_url));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(1, $this->food_name);
        $stmt->bindParam(2, $this->category);
        $stmt->bindParam(3, $this->benefits);
        $stmt->bindParam(4, $this->serving_size);
        $stmt->bindParam(5, $this->image_url);
        $stmt->bindParam(6, $this->id);

        return $stmt->execute();
    }

    // Delete food
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(1, $this->id);

        return $stmt->execute();
    }

    // Count foods matching search query
    public function countSearchResults($search_term) {
    $search_term = "%{$search_term}%";
    $query = "SELECT COUNT(*) as total FROM " . $this->table_name . "
              WHERE food_name LIKE ?
              OR category LIKE ?
              OR benefits LIKE ?";
              
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $search_term);
    $stmt->bindParam(2, $search_term);
    $stmt->bindParam(3, $search_term);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['total'];
}

    // Count all entries
    public function getFoodCount() {
        $query = "SELECT COUNT(*) as total FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['total'];
    }

    // Count foods by category
    public function countFoodsByCategory($category) {
    $query = "SELECT COUNT(*) as total FROM " . $this->table_name . " WHERE category = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(1, $category);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row['total'];
}

    // Get distinct categories
    public function getCategories() {
        $query = "SELECT DISTINCT category FROM " . $this->table_name . " ORDER BY category";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}
?>
