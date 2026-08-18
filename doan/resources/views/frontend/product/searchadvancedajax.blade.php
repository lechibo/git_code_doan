@extends('frontend.layouts.app')
@section('content')
<section data-page="searchadvancedajax">
    <div class="container">
        <div class="row">
            @include('frontend.layouts.menuleft')
            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Features Items</h2>
                    <form id="searchForm" action="{{ route('product.searchadvancedajax') }}" method="GET" style="display:flex; align-items:center; gap:10px; margin-bottom:20px; flex-wrap:wrap;">

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
    // alert('JS đã chạy');
        $(document).ready(function(){
            // $('.add-to-cart').click( function(e){
            //     e.preventDefault();
            //     $.ajax({
            //         url:$(this).attr('href'),
            //         type:'GET',
            //         success:function(res){
            //             alert(res.message);
            //         }
            
            //     });
            // });
            // Sử dụng Event Delegation để các nút Add to cart mới load qua AJAX vẫn hoạt động
            $(document).on('click', '.add-to-cart', function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('href'),
                    type: 'GET',
                    success: function(res) {
                        alert(res.message);
                    }
                });
            });

            $('#searchForm').on('submit', function (e) {
                // alert('JS đã chạy');
                e.preventDefault();

                $.ajax({

                    url: $(this).attr('action'),

                    type: 'GET',
                    dataType: 'json',
                    data: $(this).serialize(),

                    success: function (response) {
                        console.log(response);

                        // $('#product-list').html(response.html);
                        if (response.html) {
                            $('#product-list').html(response.html);
                        } else {
                            // Nếu server trả về HTML thẳng thì append trực tiếp
                            $('#product-list').html(response);
                        }

                    },

                    error: function (xhr) {

                        console.log(xhr.responseText);

                    }

                });

            });

        });
</script>
@endsection
@endsection
