@extends('frontend.layouts.app')
@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Account</h2>
                    <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                        
                        
                         <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a href="{{route('account.update')}}">account</a></h4>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a href="{{route('account.myproduct')}}">My product</a></h4>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title"><a href="{{route('account.addproduct')}}">Add product</a></h4>
                            </div>
                        </div>
                        
                    </div><!--/category-products-->
                
                    
                </div>
            </div>
            <div class="col-sm-9">
                <div class="table-responsive cart_info">
                    <table class="table table-condensed">
                        <thead>
                            <tr class="cart_menu">
                                <td class="image">image</td>
                                <td class="description">name</td>
                                <td class="price">price</td>                               
                                <td class="total">action</td>
                                
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach($products as $product)
                            @php
                                $images = json_decode($product->image, true);
                            @endphp
                            <tr>
                                
                                <td class="cart_product">
                                    @if(!empty($images))
                                    <a href=""><img src="{{ asset('images/product/'.$images[0]) }}" width="100" alt=""></a>
                                    @endif
                                </td>

                                <td class="cart_description">
                                    <h4><a href="">{{ $product->name }}</a></h4>
                                    
                                </td>
                                <td class="cart_price">
                                    <p>${{ $product->price }}</p>
                                </td>
                                
                                <td class="cart_total">
                                    <a>edit</a>
                                    <a>delete</a>
                                </td>
                                
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection