function displayProducts(products) {
  let html = "";

  for (let product of products) {
    html += `<div class="product p-4 flex flex-col bg-gray-100 space-y-2">
    <a href="view.php?id=${product.product_id}"><image src="images/products/${product.image}" alt=${product.product_name} class="cursor-pointer" /></a>
                 <h3 class="text-lg font-medium product-name">${product.product_name}</h3>
                 <div class="flex flex-row items-center justify-between">
                 <span class="text-sm font-medium product-quantity">Quantity: ${product.unit_quantity}</span>
                 <p class="text-sm font-medium product-price">Price: ${product.unit_price}</p>
                 </div>
                 <div class="flex flex-col space-y-2">
                 <span class="text-xs font-semibold product-stock">Stock: ${product.in_stock}</span>
                 <button class="add-to-cart px-4 py-2 rounded-xl bg-red-700 text-white font-semibold" data-id=${product.product_id}>Add to Cart</button>
                 </div>
               </div>`;
  }

  $("#products-container").html(html);
}
