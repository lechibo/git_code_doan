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
                <div class="blog-post-area">
                    <h2 class="title text-center">Add Product</h2>
                        <div class="signup-form"><!--sign up form-->
                    <h2>Create product!</h2>
                    @if(session('success'))
                        <p style="color:green;">{{session('success')}}</p>
                    @endif
                    <form action="{{ route('account.addproduct') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Name"/>
                        <input type="number" name="price" value="{{ old('price') }}" placeholder="Price"/>        
                        <select name="id_category" class="form-control form-control-line" > 
                            <option value="" selected disabled >Please choose category </option>  
                            @foreach($categories  as $category)               
                            <option value="{{$category->id}}" {{ old('id_category') == $category->id ? 'selected' : '' }}> {{$category->name}}</option>  
                            @endforeach
                        </select>
                        <select name="id_brand" class="form-control form-control-line" >  
                            <option value="" selected disabled >Please choose brand </option>
                            @foreach($brands as $brand)   
                            <option value="{{$brand->id}}" {{ old('id_brand') == $brand->id ? 'selected' : '' }}> {{$brand->name}}</option>    
                            @endforeach
                        </select>

                        <select name="status" id="status" class="form-control form-control-line">
                            <option value="" selected disabled >Status</option>
                            <option value="0" {{ old('status') == 0 ? 'selected' : '' }} >New </option>  
                            <option value="1" {{ old('status') == 1 ? 'selected' : '' }} >Sale </option>
                                  
                        </select> 
                        <div class="form-group" id="sale-price-box" style="display:none;">   
                        <input type="number" name="sale" value="{{ old('sale') }}" placeholder="Enter sale price (%)" min="1" max="100"/>
                        </div>

                        <input type="text" name="company" value="{{ old('company') }}" placeholder="Company profile"/>
                        <input type="file" name="image[]" multiple/>
                        
                        <textarea rows="5" name="detail" class="form-control form-control-line" placeholder="Detail">{{ old('detail') }}</textarea>
                           
                        <button type="submit" class="btn btn-default">Add product</button>
                    </form>
                    @if ($errors->any())
                        <div class="alert alert-danger" style="margin-top:20px;">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
                </div>
            </div>
        </div>
    </div>
</section>
@section('js')
<script>
    $(document).ready(function(){

    $('#status').change(function(){
        console.log("ready");
        console.log($(this).val());
        if($(this).val() == 1){
            $('#sale-price-box').show();
        }else{
            $('#sale-price-box').hide();
            $('input[name="sale"]').val('');
        }

    });

});
</script>
@endsection
@endsection