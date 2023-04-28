<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Online Grocery</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap 5 CSS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.17/tailwind.min.css">
    <!-- Custom CSS -->
    <script>
      <?php include 'js/fetch.js'; ?>
    </script>
    <script>
      <?php include 'js/cart.js'; ?>
    </script>
  </head>
  <body>
    <header>
      <nav class="flex flex-row justify-between items-center bg-gray-100">
        <div class="p-4"><span class="text-3xl font-semibold">Online Grocery Store</span></div>
        <div class="p-4 flex flex-col items-center space-y-2"><div class="pt-2 relative mx-auto text-gray-600">
        <input class="border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm focus:outline-none"
          type="search" name="search" placeholder="Search">
        <button type="submit" name="search" class="absolute right-0 top-0 mt-5 mr-4">
          <svg class="text-gray-600 h-4 w-4 fill-current" xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px"
            viewBox="0 0 56.966 56.966" style="enable-background:new 0 0 56.966 56.966;" xml:space="preserve"
            width="512px" height="512px">
            <path
              d="M55.146,51.887L41.588,37.786c3.486-4.144,5.396-9.358,5.396-14.786c0-12.682-10.318-23-23-23s-23,10.318-23,23  s10.318,23,23,23c4.761,0,9.298-1.436,13.177-4.162l13.661,14.208c0.571,0.593,1.339,0.92,2.162,0.92  c0.779,0,1.518-0.297,2.079-0.837C56.255,54.982,56.293,53.08,55.146,51.887z M23.984,6c9.374,0,17,7.626,17,17s-7.626,17-17,17  s-17-7.626-17-17S14.61,6,23.984,6z" />
          </svg>
        </button>
      </div>

</div>
      </nav>
    </header>
    <section id="main" class="grid grid-cols-4 min-h-screen">
      <div class="col-span-1 left-0  bg-gray-100">
      <div class="p-4 m-4 text-3xl">
        <span  class="font-semibold">Categories</span>
      </div>
      <div class="flex flex-col justify-evenly p-4 m-4 space-y-4">
        <div class="category-item p-4 text-2xl cursor-pointer border-1 rounded-xl border-black hover:bg-gray-200" data-category="fresh-food">Fresh food</div>
        <div class="category-item p-4 text-2xl cursor-pointer border-1 rounded-xl border-black hover:bg-gray-200" data-category="frozen-food">Frozen food</div>
        <div class="category-item p-4 text-2xl cursor-pointer border-1 rounded-xl border-black hover:bg-gray-200" data-category="beverages">Beverages</div>
        <div class="category-item p-4 text-2xl cursor-pointer border-1 rounded-xl border-black hover:bg-gray-200" data-category="pet-food">Pet Food</div>
        <div class="category-item p-4 text-2xl cursor-pointer border-1 rounded-xl border-black hover:bg-gray-200" data-category="home-health">Home Health</div>
        
      </div>
      <span class="p-4 m-4 text-2xl font-semibold">Price Slider </span>
      <div class="flex w-auto m-auto items-center h-32 p-4 justify-center">
    <div class="py-1 relative min-w-full">
        <div class="h-2 bg-gray-200 rounded-full">
            <div class="absolute h-2 rounded-full bg-teal-600 w-0" style="width: 58.5714%;"></div>
            <div class="absolute h-4 flex items-center justify-center w-4 rounded-full bg-white shadow border border-gray-300 -ml-2 top-0 cursor-pointer" unselectable="on" onselectstart="return false;" style="left: 58.5714%;">
                <div class="relative -mt-2 w-1">
                    <div class="absolute z-40 opacity-100 bottom-100 mb-2 left-0 min-w-full" style="margin-left: -20.5px;">
                        <div class="relative shadow-md">
                            <div class="bg-black -mt-8 text-white truncate text-xs rounded py-1 px-4">92</div>
                            <svg class="absolute text-black w-full h-2 left-0 top-100" x="0px" y="0px" viewBox="0 0 255 255" xml:space="preserve">
                                <polygon class="fill-current" points="0,0 127.5,127.5 255,0"></polygon>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <div class="absolute text-gray-800 -ml-1 bottom-0 left-0 -mb-6">10</div>
            <div class="absolute text-gray-800 -mr-1 bottom-0 right-0 -mb-6">150</div>
        </div>
    </div>
</div>
      </div>
      <div class="col-span-3">
        <div class="h-2/3 w-full p-8 overflow-y-scroll">
        <div id="products-container" class="container mx-auto grid grid-cols-3 gap-4">
          
        </div>
        </div>
        <div id="cart" class="h-1/3 w-full p-4">
          <!-- Cart -->
        </div>

    </section>
    

    <script>
  $(document).ready(function() {
    $(".category-item").click(function() {
      const category = $(this).attr("data-category");
      
      $.ajax({
        url: "utils/fetch.php",
        method: "POST",
        data: { category: category },
        dataType: "json",
        success: function(data) {
          displayProducts(data);
        },
        error: function() {
          alert("Error fetching products!");
        },
      });
    });
  });

  $("button[type='submit']").click(function (e) {
      e.preventDefault()
      const search = $("input[name='search']").val();
      $.ajax({
        url: "utils/fetch.php",
        method: "POST",
        data: {search: search},
        dataType: "json",
        success: function(data) {
            displayProducts(data);
          },
          error: function() {
            alert("Error fetching products!");
          },
      })
  });

  updateCart();
</script>

</body>
</html>