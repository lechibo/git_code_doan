@if($products->count()> 0)

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

    {{-- CHỈ HIỂN THỊ PHÂN TRANG NẾU DỮ LIỆU CÓ HÀM LINKS (Trang Search) --}}
    @if (method_exists($products, 'links'))
        <div class="text-center">
            {{ $products->links() }}
        </div>
    @endif
@else
    <h4>Không tìm thấy sản phẩm.</h4>
@endif