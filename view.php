<?php
require_once 'include/database.php';

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];
    $query = 'SELECT * FROM products WHERE product_id = ?';

    $stmt = $db_link->prepare($query);
    $stmt->bind_param('i', $product_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $product = $result->fetch_assoc();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product View</title>
</head>
<body>
    <div class="product-view container mx-auto">
        <?php if (isset($product)): ?>
            <div class="product p-4 flex flex-col bg-gray-100 space-y-2">
                <img src="images/products/<?php echo $product[
                    'image'
                ]; ?>" alt="<?php echo $product['product_name']; ?>" />
                <h3 class="text-lg font-medium"><?php echo $product[
                    'product_name'
                ]; ?></h3>
                <div class="flex flex-row items-center justify-between">
                    <span class="text-sm font-medium">Quantity: <?php echo $product[
                        'unit_quantity'
                    ]; ?></span>
                    <p class="text-sm font-medium">Price: <?php echo $product[
                        'unit_price'
                    ]; ?></p>
                </div>
                <div class="flex flex-col space-y-2">
                    <span class="text-xs font-semibold">Stock: <?php echo $product[
                        'in_stock'
                    ]; ?></span>
                    <button class="px-4 py-2 rounded-xl bg-red-700 text-white font-semibold">Add to Cart</button>
                </div>
            </div>
        <?php else: ?>
            <p>Product not found.</p>
        <?php endif; ?>
    </div>
</body>
</html>
