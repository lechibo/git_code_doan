<div class="col-sm-3">
<div class="left-sidebar">
	<h2>Category</h2>
	<div class="panel-group category-products" id="accordian"><!--category-productsr-->
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordian" href="#sportswear">
						<span class="badge pull-right"><i class="fa fa-plus"></i></span>
						Sportswear
					</a>
				</h4>
			</div>
			<div id="sportswear" class="panel-collapse collapse">
				<div class="panel-body">
					<ul>
						<li><a href="#">Nike </a></li>
						<li><a href="#">Under Armour </a></li>
						<li><a href="#">Adidas </a></li>
						<li><a href="#">Puma</a></li>
						<li><a href="#">ASICS </a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordian" href="#mens">
						<span class="badge pull-right"><i class="fa fa-plus"></i></span>
						Mens
					</a>
				</h4>
			</div>
			<div id="mens" class="panel-collapse collapse">
				<div class="panel-body">
					<ul>
						<li><a href="#">Fendi</a></li>
						<li><a href="#">Guess</a></li>
						<li><a href="#">Valentino</a></li>
						<li><a href="#">Dior</a></li>
						<li><a href="#">Versace</a></li>
						<li><a href="#">Armani</a></li>
						<li><a href="#">Prada</a></li>
						<li><a href="#">Dolce and Gabbana</a></li>
						<li><a href="#">Chanel</a></li>
						<li><a href="#">Gucci</a></li>
					</ul>
				</div>
			</div>
		</div>
		
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title">
					<a data-toggle="collapse" data-parent="#accordian" href="#womens">
						<span class="badge pull-right"><i class="fa fa-plus"></i></span>
						Womens
					</a>
				</h4>
			</div>
			<div id="womens" class="panel-collapse collapse">
				<div class="panel-body">
					<ul>
						<li><a href="#">Fendi</a></li>
						<li><a href="#">Guess</a></li>
						<li><a href="#">Valentino</a></li>
						<li><a href="#">Dior</a></li>
						<li><a href="#">Versace</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title"><a href="#">Kids</a></h4>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title"><a href="#">Fashion</a></h4>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title"><a href="#">Households</a></h4>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title"><a href="#">Interiors</a></h4>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title"><a href="#">Clothing</a></h4>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title"><a href="#">Bags</a></h4>
			</div>
		</div>
		<div class="panel panel-default">
			<div class="panel-heading">
				<h4 class="panel-title"><a href="#">Shoes</a></h4>
			</div>
		</div>
	</div><!--/category-products-->

	<div class="brands_products"><!--brands_products-->
		<h2>Brands</h2>
		<div class="brands-name">
			<ul class="nav nav-pills nav-stacked">
				<li><a href="#"> <span class="pull-right">(50)</span>Acne</a></li>
				<li><a href="#"> <span class="pull-right">(56)</span>Grüne Erde</a></li>
				<li><a href="#"> <span class="pull-right">(27)</span>Albiro</a></li>
				<li><a href="#"> <span class="pull-right">(32)</span>Ronhill</a></li>
				<li><a href="#"> <span class="pull-right">(5)</span>Oddmolly</a></li>
				<li><a href="#"> <span class="pull-right">(9)</span>Boudestijn</a></li>
				<li><a href="#"> <span class="pull-right">(4)</span>Rösch creative culture</a></li>
			</ul>
		</div>
	</div><!--/brands_products-->
	
	<div class="price-range"><!--price-range-->
		<h2>Price Range</h2>
		<div class="well text-center">
				<input type="text" class="span2" value="" data-slider-min="0" data-slider-max="5000" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
				<b class="pull-left" >$ 0</b> <b class="pull-right">$ 5000</b>
		</div>
	</div><!--/price-range-->
	
	<div class="shipping text-center"><!--shipping-->
		<img src="images/home/shipping.jpg" alt="" />
	</div><!--/shipping-->

</div>
</div>
@section('js')
<script>
	$(document).ready(function(){
		// Hàm  nhận biết tên trang hiện tại
        function getCurrentPage() {
            // Lấy từ attribute data-page trên thẻ chứa 
            let page = $('section[data-page]').data('page'); 
            
            // có hai cách / gắn data-page hoặc nhận biết qua route/url
            if (!page) {
                let path = window.location.pathname;
                if (path.includes('searchadvancedajax')) return 'searchadvancedajax';
                if (path.includes('searchadvanced')) return 'searchadvanced';
                return 'home';
            }
            return page;
        }

		// Hàm gửi Ajax xử lý lọc giá
		function filterByPrice(minPrice, maxPrice) {
			let currentPage = getCurrentPage(); // Lấy tên trang hiện tại ('home', 'searchadvanced', 'searchadvancedajax')

			let sendData = {
				min_price: minPrice,
				max_price: maxPrice,
				page_type: currentPage
			};

			$.ajax({
				url: "{{ route('product.searchpricebar') }}",
				type: 'GET',
				data: sendData,
				dataType: 'html',
				success: function(htmlResponse) {
					
					//  Trang Chủ
					if (currentPage === 'home') {
						
						$('#product-list').html(htmlResponse);
					} 
					
					//  render ra trang Search Advanced
					else if (currentPage === 'searchadvanced') {
						
						$('#product-list').html(htmlResponse);
					} 
					
					// render ra trang Search Advanced Ajax
					else if (currentPage === 'searchadvancedajax') {
						
						$('#product-list').html(htmlResponse);
					}

				},
				error: function(xhr) {
                    console.log('Lỗi lọc giá:', xhr.responseText);
                }

			});
		}
		// Bắt sự kiện kéo thanh slider
        $('#sl2').slider().on('slideStop', function(e){
            let minPrice = e.value[0];
            let maxPrice = e.value[1];
            filterByPrice(minPrice, maxPrice);
        });
	});
</script>
@endsection	
