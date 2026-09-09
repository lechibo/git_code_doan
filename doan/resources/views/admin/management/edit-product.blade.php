<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <!-- Sidebar Admin -->
                </div>
            </div>

            <div class="col-sm-9">
                <div class="blog-post-area">
                    <h2 class="title text-center">Edit Product (Admin)</h2>
                    <div class="signup-form">
                        
                        @if(session('success'))
                            <p style="color:green;">{{ session('success') }}</p>
                        @endif

                        <form id="adminUpdateForm" action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" onsubmit="alert('Form đang gửi!');">
                            @csrf
                            
                            
                            <label>Name</label>
                            <input type="text" name="name" value="{{ old('name', $product->name) }}" placeholder="Name"/>
                            
                            <label>Price</label>
                            <input type="number" name="price" value="{{ old('price', $product->price) }}" placeholder="Price"/>        
                            
                            <label>Category</label>
                            <select name="id_category" class="form-control"> 
                                <option value="" disabled>Please choose category</option>   
                                @foreach($categories as $category)               
                                    <option value="{{ $category->id }}" {{ old('id_category', $product->id_category) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>   
                                @endforeach
                            </select>

                            <label>Brand</label>
                            <select name="id_brand" class="form-control">  
                                <option value="" disabled>Please choose brand</option>
                                @foreach($brands as $brand)   
                                    <option value="{{ $brand->id }}" {{ old('id_brand', $product->id_brand) == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>    
                                @endforeach
                            </select>

                            <label>Status</label>
                            <select name="status" id="status" class="form-control">
                                <option value="0" {{ old('status', $product->status) == 0 ? 'selected' : '' }}>New</option>  
                                <option value="1" {{ old('status', $product->status) == 1 ? 'selected' : '' }}>Sale</option>
                            </select> 

                            <div class="form-group" id="sale-price-box" style="{{ old('status', $product->status) == 1 ? '' : 'display:none;' }}">   
                                <label>Sale (%)</label>
                                <input type="number" name="sale" value="{{ old('sale', $product->sale) }}" placeholder="Enter sale price (%)" min="1" max="100"/>
                            </div>

                            <label>Company</label>
                            <input type="text" name="company" value="{{ old('company', $product->company) }}" placeholder="Company profile"/>
                            
                            <label>Add New Images (Max 3 in total)</label>
                            <input type="file" name="image[]" multiple/>

                            <label>Current Images (Check to Delete)</label>
                            <div class="image-list" style="display: flex; gap: 20px; margin: 15px 0;">
                                @if(!empty($images))
                                    @foreach($images as $image)
                                    <div class="image-item" style="text-align: center;">
                                        <img src="{{ asset('images/product/'.str_replace('_full', '_85x84', $image)) }}" width="85" height="84" style="display: block; margin-bottom: 10px; border: 1px solid #ddd;">
                                        <label><input type="checkbox" name="image_delete[]" value="{{ $image }}"> Delete</label>
                                    </div>
                                    @endforeach
                                @endif
                            </div>

                            <label>Detail</label>
                            <textarea rows="5" name="detail" class="form-control" placeholder="Detail">{{ old('detail', $product->detail) }}</textarea>
                               
                            <button type="button" class="btn btn-primary" onclick="document.getElementById('adminUpdateForm').submit();" style="margin-top: 15px;">
                                Update Product (Force Submit)
                            </button>                        
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

<script>
    $(document).ready(function(){
        function toggleSaleBox() {
            if ($('#status').val() == 1) {
                $('#sale-price-box').show();
            } else {
                $('#sale-price-box').hide();
            }
        }

        toggleSaleBox();

        $('#status').change(function(){
            toggleSaleBox();
            if($(this).val() != 1) {
                $('input[name="sale"]').val('');
            }
        });
    });
</script>