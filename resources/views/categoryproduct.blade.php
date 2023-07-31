@extends('master')
@section('content')
    

<h2 class="font-bold text-4xl text-center my-5">{{$category->name}}</h2>
<div class="col-md-12 md-3">
<div class="flex items-center m-3 gap-3">
    <p class="font-weight-bold sort-font">Sort By :</p>
<select id="orderby" class="block appearance-none  bg-white border border-gray-300 hover:border-gray-500 px-4 py-2 rounded shadow leading-tight focus:outline-none focus:shadow-outline">
    <option value="asc">Assending Order</option>
    <option value="desc">Descinding Order</option>
    <option value="new">New to Old</option>
    <option value="old">Old to New</option>
</select>
</div>
</div>

<script>
    var orderby = document.getElementById('orderby');
    orderby.addEventListener("change", function() {
    // This function will be executed when the button is clicked
    console.log(this.value);
    
    $.ajax({
      url: "{{route('product.orderby')}}", // Replace with the API endpoint URL
      method: "POST", // HTTP method (GET, POST, PUT, DELETE, etc.)
      data:{
        data:this.value,
        _token:"{{csrf_token()}}"
      },
       
      success: function(response) {
        
        console.log(response);
        let productListContainer = document.getElementById('productcontainer');
    response.forEach((product) => {
    const productHTML = generateProductHTML(product);
  const tempContainer = document.createElement('div');
  tempContainer.innerHTML = productHTML;
  while (tempContainer.firstChild) {
    productListContainer.appendChild(tempContainer.firstChild);
  }
});

  
        

  // Replace 'productList' with the ID of the container where you want to render the products
  document.getElementById("productList").innerHTML = productTemplate({ products });

      },
      error: function(xhr, status, error) {
        // This function will be executed if there's an error with the request
        // Handle the error here
        console.error("Error:", error);
      }
    });
  });
  function generateProductHTML(product) {
  let productHTML = `
    <a href="/viewproduct/${product.id}">
      <div class="bg-gray-100 rounded-lg shadow-lg relative">
        <img src="images/products/${product.photopath}" alt="" class="w-full h-72 object-cover rounded-t-lg">
        <div class="p-2">
          <p class="font-bold text-2xl">${product.name}</p>
          <p class="font-bold text-2xl">
            ${product.oldprice ? `<span class="line-through text-gray-500 text-xl">${product.oldprice}/-</span>` : ''}
            Rs. ${product.price}/-
          </p>
        </div>
  `;

  if (product.oldprice) {
    const discount = Math.round(((product.oldprice - product.price) / product.oldprice) * 100);
    productHTML += `
      <p class="absolute top-1 right-1 bg-blue-600 text-white rounded-lg px-4 py-1">${discount}% off</p>
    `;
  }

  productHTML += `
      </div>
    </a>
  `;

  return productHTML;
}

</script>

<div id="productscontainer"  class="grid grid-cols-4 gap-10 px-24 mb-10">

    @foreach($products as $product)
    <a href="{{route('viewproduct',$product->id)}}">
        <div class="bg-gray-100 rounded-lg shadow-lg relative">
            <img src="{{asset('images/products/'.$product->photopath)}}" alt="" class="w-full h-72 object-cover rounded-t-lg">
            <div class="p-2">
                <p class="font-bold text-2xl">{{$product->name}}</p>
                <p class="font-bold text-2xl">
                    @if($product->oldprice != '')
                    <span class="line-through text-gray-500 text-xl">{{$product->oldprice}}/-</span> 
                    @endif
                    Rs. {{$product->price}}/-</p>
            </div>
            @if($product->oldprice != '')
            @php
                $discount = ($product->oldprice - $product->price) / $product->oldprice * 100;
                $discount = round($discount);
            @endphp
            <p class="absolute top-1 right-1 bg-blue-600 text-white rounded-lg px-4 py-1">{{$discount}}% off</p>
            @endif
        </div>
    </a>
    @endforeach
</div>
    <div class="mx-24 my-10">
        {{$products->links()}}
    </div>
@endsection