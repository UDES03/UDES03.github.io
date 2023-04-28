function updateCart() {
  $.ajax({
    url: "cart.php",
    method: "POST",
    dataType: "json",
    success: function (data) {
      cart.items = data;
      updateCartHTML();
      showCheckoutButton(); // Add this line
    },
  });
}

$(document).on("click", ".add-to-cart", function () {
  const productId = $(this).data("id");
  const product = {
    product_id: productId,
    product_name: $(this).parent().siblings(".product-name").text(),
    unit_price: parseFloat(
      $(this)
        .parent()
        .siblings(".flex")
        .find(".product-price")
        .text()
        .replace("Price: ", "")
    ),
    unit_quantity: parseInt(
      $(this)
        .parent()
        .siblings(".flex")
        .find(".product-quantity")
        .text()
        .replace("Quantity: ", "")
    ),
    in_stock: parseInt(
      $(this).siblings(".product-stock").text().replace("Stock: ", "")
    ),
  };

  $.ajax({
    url: "cart.php",
    method: "POST",
    data: {
      action: "add",
      product_id: product.product_id,
      product_name: product.product_name,
      unit_price: product.unit_price,
      unit_quantity: product.unit_quantity,
      in_stock: product.in_stock,
    },
    dataType: "json",
    success: function () {
      updateCart();
    },
  });
});

$(document).on("click", ".remove-from-cart", function () {
  const productId = $(this).data("id");

  $.ajax({
    url: "cart.php",
    method: "POST",
    data: { action: "remove", product_id: productId },
    dataType: "json",
    success: function () {
      updateCart();
    },
  });
});

function updateCartHTML() {
  let html = "";
  let totalItems = 0;
  let totalPrice = 0;

  for (const itemId in cart.items) {
    const item = cart.items[itemId];
    totalItems += item.quantity;
    totalPrice += item.quantity * parseFloat(item.unit_price);

    html += `
        <div class="flex justify-between items-center mb-4">
            <div class="text-sm">${item.product_name} (${item.unit_quantity} x${
      item.quantity
    })</div>
            <div class="flex items-center">
            <div class="text-sm mr-2">$${(
              item.quantity * parseFloat(item.unit_price)
            ).toFixed(2)}</div>
            <button class="remove-from-cart text-red-500 px-4 py-2 rounded-xl bg-gray-100" data-id="${
              item.product_id
            }">Remove</button>
            </div>
        </div>`;
  }

  html += `
        <div class="border-t mt-4 pt-4">
            <div class="flex justify-between">
            <div class="font-semibold">Total Items:</div>
            <div>${totalItems}</div>
            </div>
            <div class="flex justify-between">
            <div class="font-semibold">Total Price:</div>
            <div>$${totalPrice.toFixed(2)}</div>
            </div>
        </div>`;

  $("#cart").html(html);
}
