<?php
require_once '../include/database.php';

if (isset($_POST['category']) || isset($_POST['search'])) {
    $category = $_POST['category'] ?? null;
    $search = $_POST['search'] ?? null;

    $query = 'SELECT * FROM products WHERE 1';

    if ($category) {
        $query .= ' AND category = ?';
    }

    if ($search) {
        $query .= ' AND product_name LIKE ?';
        $search = '%' . $search . '%';
    }

    $stmt = $db_link->prepare($query);

    if (!$stmt) {
        die('Error preparing statement: ' . $db_link->error);
    }

    if ($category && $search) {
        $stmt->bind_param('ss', $category, $search);
    } elseif ($category) {
        $stmt->bind_param('s', $category);
    } elseif ($search) {
        $stmt->bind_param('s', $search);
    }

    $stmt->execute();
    $result = $stmt->get_result();

    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }

    echo json_encode($products);
}
?>
