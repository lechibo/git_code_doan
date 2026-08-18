@extends('frontend.layouts.app')
@section('content')
<section data-page="searchadvanced">
    <div class="container">
        <div class="row">
            @include('frontend.layouts.menuleft')
            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                
                    <h2 class="title text-center">Features Items</h2>
                    <form action="{{ route('product.searchadvanced') }}" method="GET" style="display:flex; align-items:center; gap:10px; margin-bottom:20px; flex-wrap:wrap;">

                        <input type="text"
                            name="name"
                            placeholder="Name"
                            value="{{ request('name') }}"
                            style="flex:1; height:40px; padding:0 10px;">

                        <select name="price" style="flex:1; height:40px;">
                            <option value="" {{ request('price') == '' ? 'selected' : '' }}>Choose price</option>
                            <option value="1" {{ request('price') == '1' ? 'selected' : '' }}>0 - 1000</option>
                            <option value="2" {{ request('price') == '2' ? 'selected' : '' }}>1000 - 5000</option>
                            <option value="3" {{ request('price') == '3' ? 'selected' : '' }}>5000+</option>
                        </select>

                        <select name="category" style="flex:1; height:40px;">

                            <option value="" {{ request('category') == '' ? 'selected' : '' }}>Category</option>

                            @foreach($categories as $category)

                                <option
                                    value="{{ $category->id }}"
                                    {{ request('category')== (string)$category->id ? 'selected' : '' }}>

                                    {{ $category->name }}

                                </option>

                            @endforeach

                        </select>

                        <select name="brand" style="flex:1; height:40px;">

                            <option value="" {{ request('brand') == '' ? 'selected' : '' }}>Brand</option>

                            @foreach($brands as $brand)

                                <option
                                    value="{{ $brand->id }}"
                                    {{ request('brand')== (string)$brand->id ? 'selected' : '' }}>

                                    {{ $brand->name }}

                                </option>

                            @endforeach

                        </select>

                        <select name="status" style="flex:1; height:40px;">

                            <option value="" {{ request('status') == '' ? 'selected' : '' }}>Status</option>

                            <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>New</option>

                            <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Sale</option>

                        </select>

                        <button type="submit" class="btn btn-primary"  style="height:40px; width:120px; line-height:40px; padding:0 20px; margin:0;">
                            Search
                        </button>

                    </form>
                    <!-- @if($products->count())
                        @foreach($products as $product)
                            @php
                                $images = json_decode($product->image, true);
                            @endphp

                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">

                                            @if(!empty($images))
                                                <img src="{{ asset('images/product/'.str_replace('_full','_329x380',$images[0])) }}" alt="" >
                                            @endif

                                            @if($product->status == 1)
                                                <h2>
                                                    <del>${{ $product->price }}</del> </br>
                                                    ${{ $product->price * (100 - $product->sale) / 100 }}
                                                </h2>
                                            @else
                                                <h2>${{ $product->price }}</h2>
                                            @endif

                                            <p>{{ $product->name }}</p>

                                            <a href="#" class="btn btn-default add-to-cart">
                                                <i class="fa fa-shopping-cart"></i>
                                                Add to cart
                                            </a>
                                        </div>

                                        <div class="product-overlay">
                                            <div class="overlay-content">

                                                @if($product->status == 1)
                                                    <h2>
                                                        <del>${{ $product->price }}</del> </br>
                                                        ${{ $product->price * (100 - $product->sale) / 100 }}
                                                    </h2>
                                                @else
                                                    <h2>${{ $product->price }}</h2>
                                                @endif

                                                <p>{{ $product->name }}</p>

                                                <a href="{{route('cart.add',$product->id)}}" class="btn btn-default add-to-cart">
                                                    <i class="fa fa-shopping-cart"></i>
                                                    Add to cart
                                                </a>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="choose">
                                        <ul class="nav nav-pills nav-justified">
                                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                            <li><a href="{{route('productdetail',$product->id)}}"><i class="fa fa-plus-square"></i>Detail</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        @endforeach
                        <div class="text-center">
                            {{ $products->links() }}
                        </div>
                    @else
                        <h4>Không tìm thấy sản phẩm.</h4>
                    @endif -->
                <div id="product-list">
                    @include('frontend.product.product_listForsearchadvanced_ajax')
                </div>
                </div><!--features_items-->
            </div>
        </div>
    </div>
</section>
@section('js')
    <script>
        $(document).ready(function(){
            $('.add-to-cart').click( function(e){
                e.preventDefault();
                $.ajax({
                    url:$(this).attr('href'),
                    type:'GET',
                    success:function(res){
                        alert(res.message);
                    }
            
                });
            });
        });

    </script>
@endsection
@endsection
