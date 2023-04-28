<?php
session_start();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

function addItem($item)
{
    if (array_key_exists($item['product_id'], $_SESSION['cart'])) {
        $_SESSION['cart'][$item['product_id']]['quantity'] = min(
            $_SESSION['cart'][$item['product_id']]['quantity'] + 1,
            20
        );
    } else {
        $item['quantity'] = 1;
        $_SESSION['cart'][$item['product_id']] = $item;
    }
}

if (isset($_POST['action'])) {
    $action = $_POST['action'];
    $product_id = $_POST['product_id'];

    if ($action == 'add') {
        $product_name = $_POST['product_name'];
        $unit_price = $_POST['unit_price'];
        $unit_quantity = $_POST['unit_quantity'];
        $in_stock = $_POST['in_stock'];
        $item = [
            'product_id' => $product_id,
            'product_name' => $product_name,
            'unit_price' => $unit_price,
            'unit_quantity' => $unit_quantity,
            'in_stock' => $in_stock,
        ];
        addItem($item);
    } elseif ($action == 'remove') {
        if (array_key_exists($product_id, $_SESSION['cart'])) {
            unset($_SESSION['cart'][$product_id]);
        }
    }
}

echo json_encode($_SESSION['cart']);

?>
