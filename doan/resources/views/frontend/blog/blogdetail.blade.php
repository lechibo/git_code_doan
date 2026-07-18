@extends('frontend.layouts.app')
@section('content')
<section>
		<div class="container">
			<div class="row">
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
											<li><a href="">Nike </a></li>
											<li><a href="">Under Armour </a></li>
											<li><a href="">Adidas </a></li>
											<li><a href="">Puma</a></li>
											<li><a href="">ASICS </a></li>
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
											<li><a href="">Fendi</a></li>
											<li><a href="">Guess</a></li>
											<li><a href="">Valentino</a></li>
											<li><a href="">Dior</a></li>
											<li><a href="">Versace</a></li>
											<li><a href="">Armani</a></li>
											<li><a href="">Prada</a></li>
											<li><a href="">Dolce and Gabbana</a></li>
											<li><a href="">Chanel</a></li>
											<li><a href="">Gucci</a></li>
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
											<li><a href="">Fendi</a></li>
											<li><a href="">Guess</a></li>
											<li><a href="">Valentino</a></li>
											<li><a href="">Dior</a></li>
											<li><a href="">Versace</a></li>
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
									<li><a href=""> <span class="pull-right">(50)</span>Acne</a></li>
									<li><a href=""> <span class="pull-right">(56)</span>Grüne Erde</a></li>
									<li><a href=""> <span class="pull-right">(27)</span>Albiro</a></li>
									<li><a href=""> <span class="pull-right">(32)</span>Ronhill</a></li>
									<li><a href=""> <span class="pull-right">(5)</span>Oddmolly</a></li>
									<li><a href=""> <span class="pull-right">(9)</span>Boudestijn</a></li>
									<li><a href=""> <span class="pull-right">(4)</span>Rösch creative culture</a></li>
								</ul>
							</div>
						</div><!--/brands_products-->
						
						<div class="price-range"><!--price-range-->
							<h2>Price Range</h2>
							<div class="well">
								 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
								 <b>$ 0</b> <b class="pull-right">$ 600</b>
							</div>
						</div><!--/price-range-->
						
						<div class="shipping text-center"><!--shipping-->
							<img src="images/home/shipping.jpg" alt="" />
						</div><!--/shipping-->
					</div>
				</div>
				<div class="col-sm-9">
					<div class="blog-post-area">
						<h2 class="title text-center">Latest From our Blog</h2>
						<div class="single-blog-post">
                            
							<h3>{{$blogdetail->title}}</h3>
                            <h5>{{$blogdetail->description}}</h5>
							<div class="post-meta">
								<ul>
									<li><i class="fa fa-user"></i> Mac Doe</li>
									<li><i class="fa fa-clock-o"></i> 1:33 pm</li>
									<li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
								</ul>
								<!-- <span>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-half-o"></i>
								</span> -->
							</div>
							<a href="">
								<img src="{{asset('admin/assets/images/blogs/'.$blogdetail->image)}}" alt="">
							</a>
							<p>{{strip_tags($blogdetail->content)}}</p>
                           
							<div class="pager-area">
								<ul class="pager pull-right">
									@if($prev)
                                        <li>
                                            <a href="{{ route('blogdetail', $prev->id) }}">
                                                Pre
                                            </a>
                                        </li>
                                    @endif

                                    @if($next)
                                        <li>
                                            <a href="{{ route('blogdetail', $next->id) }}">
                                                Next
                                            </a>
                                        </li>
                                    @endif
								</ul>
							</div>
                            
						</div>
					</div><!--/blog-post-area-->

					<div class="rating-area">
						<ul class="ratings">
							<li class="rate-this">Rate this item:</li>

                            <div class="rate">
                                <div class="vote">
                                    <div class="star_1 ratings_stars"><input value="1" type="hidden"></div>
                                    <div class="star_2 ratings_stars"><input value="2" type="hidden"></div>
                                    <div class="star_3 ratings_stars"><input value="3" type="hidden"></div>
                                    <div class="star_4 ratings_stars"><input value="4" type="hidden"></div>
                                    <div class="star_5 ratings_stars"><input value="5" type="hidden"></div>
                                    
                                    @if($userRate)
                                        <div id="user-rate-box"></br>
                                            <p>Bạn đã đánh giá:
                                                <span class="rate-np" id="userRate">{{ $userRate->rate }}</span> sao
                                            </p>
                                        </div>

                                        <div id="avg-rate-box" style="display:none"></br>
                                            <p>Trung bình: <span id="avg">{{ round($avg,1) }}</span> sao</p>
                                        </div>
                                    @else
                                        <div id="user-rate-box" style="display:none"></br>
                                            <p>Bạn đã đánh giá:
                                                <span class="rate-np" id="userRate"></span> sao
                                            </p>
                                        </div>

                                        <div id="avg-rate-box"></br>
                                            <p>Trung bình: <span id="avg">{{ round($avg,1) }}</span> sao</p>
                                        </div>
                                    @endif

                                    
                                </div> 
                            </div>

							<li class="color">Lượt vote: <span id="count">{{ $count }}</span></li>
						</ul>
						<ul class="tag">
							<li>TAG:</li>
							<li><a class="color" href="">Pink <span>/</span></a></li>
							<li><a class="color" href="">T-Shirt <span>/</span></a></li>
							<li><a class="color" href="">Girls</a></li>
						</ul>
					</div><!--/rating-area-->

					<div class="socials-share">
						<a href=""><img src="images/blog/socials.png" alt=""></a>
					</div><!--/socials-share-->

					<!-- <div class="media commnets">
						<a class="pull-left" href="#">
							<img class="media-object" src="images/blog/man-one.jpg" alt="">
						</a>
						<div class="media-body">
							<h4 class="media-heading">Annie Davis</h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
							<div class="blog-socials">
								<ul>
									<li><a href=""><i class="fa fa-facebook"></i></a></li>
									<li><a href=""><i class="fa fa-twitter"></i></a></li>
									<li><a href=""><i class="fa fa-dribbble"></i></a></li>
									<li><a href=""><i class="fa fa-google-plus"></i></a></li>
								</ul>
								<a class="btn btn-primary" href="">Other Posts</a>
							</div>
						</div>
					</div> --><!--Comments-->
					<div class="response-area">
						<h2>3 RESPONSES</h2>
						<ul class="media-list">
							<!-- comment cha -->
							@foreach($comments->where('level', 0) as $cmt)
							<li class="media" id="comment-{{$cmt->id}}">
								<a class="pull-left" href="#">
									<img class="media-object" 
									style="width:60px;height:60px;border-radius:50%;object-fit:cover;"
									src="{{asset(
											$cmt->user->level == 1
											? 'admin/images/users/' .$cmt->avatar_user
											:'frontend/images/users/' .$cmt->avatar_user
											) }}" alt="">
								</a>
								
								<div class="media-body">
									<ul class="sinlge-post-meta">
										<li><i class="fa fa-user"></i>{{$cmt->name_user}}</li>
										<li><i class="fa fa-clock-o"></i>{{$cmt->created_at}}</li>
										<li><i class="fa fa-calendar"></i>{{$cmt->created_at}}</li>
									</ul>

									<p>{{$cmt->cmt}}</p>

									<a class="btn btn-primary reply-btn" data-id="{{$cmt->id}}">
										<i class="fa fa-reply"></i>Reply
									</a>
									
								</div>
							</li>							
							<!-- comment con -->
							@foreach($comments->where('level', $cmt->id) as $child)
							<li class="media second-media">									 
								
										<a class="pull-left" href="#">
											<img class="media-object" 
											style="width:60px;height:60px;border-radius:50%;object-fit:cover;"
											src="{{asset(
											$child->user->level == 1
											? 'admin/images/users/' .$child->avatar_user
											:'frontend/images/users/' .$child->avatar_user
											) }}" alt="">
										</a>
										
										<div class="media-body">

											<ul class="sinlge-post-meta">
												<li><i class="fa fa-user"></i>{{$child->name_user}}</li>
												<li><i class="fa fa-clock-o"></i>{{$child->created_at}}</li>
												<li><i class="fa fa-calendar"></i>{{$child->created_at}}</li>
											</ul>

											<p>{{$child->cmt}}</p>
											<a class="btn btn-primary reply-btn" data-id="{{$child->level}}">
												<i class="fa fa-reply"></i>Reply
											</a>

										</div>
								
							</li>
							@endforeach
							@endforeach
						</ul>					
					</div><!--/Response-area-->
					<div class="replay-box">
						<div class="row">
							<div class="col-sm-12">
								<h2>Leave a replay</h2>
								
								<div class="text-area">
									<div class="blank-arrow">
										<label>Your Name</label>
									</div>
									<span>*</span>
									<textarea name="cmt" id="cmt" rows="11"></textarea>
									<button type="button" class="btn btn-primary" id="btn-comment">Post Comment</button>
								</div>
							</div>
						</div>
					</div><!--/Repaly Box-->
				</div>	
			</div>
		</div>
	</section>
@section('js')
    <script>
        if(screen.width <= 736){
            document.getElementById("viewport").setAttribute("content", "width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no");
        }
    </script>
    <script>
    	
    	$(document).ready(function(){
        
        // alert("ready");
        function highlightStars(display_rate) {
                $('.ratings_stars').removeClass('ratings_over');

                $('.ratings_stars').each(function() {
                    let value = $(this).find('input').val();

                    if (value <= display_rate) {
                        $(this).addClass('ratings_over');
                    }
                });
            }
			highlightStars(
			{{ $userRate ? $userRate->rate : round($avg,1) }}
			);
            $.ajaxSetup({
                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
			//vote
			$('.ratings_stars').hover(
	            // Handles the mouseover
	            function() {
	                $(this).prevAll().addBack().addClass('ratings_hover');
	                // $(this).nextAll().removeClass('ratings_vote'); 
	            },
	            function() {
	                $(this).prevAll().addBack().removeClass('ratings_hover');
	                // set_votes($(this).parent());
	            }
	        );  

			$('.ratings_stars').click(function(){
                // console.log('click');
				var Values =  $(this).find("input").val();
		        // alert(Values);
		    	if ($(this).hasClass('ratings_over')) {
		            $('.ratings_stars').removeClass('ratings_over');
		            $(this).prevAll().addBack().addClass('ratings_over');
		        } else {
		        	$(this).prevAll().addBack().addClass('ratings_over');
		        }
		    });
		});    

        var checkLogin = {{ Auth::check() ? 'true' : 'false' }};
        $('.ratings_stars').click(function(){
            // console.log('click');
              
        if(!checkLogin){
            window.location.href = "{{ route('login') }}";
            return;
        }

            var rate = $(this).find("input").val();
            // console.log(rate);
            // console.log({
            //     rate: rate,
            //     id_blog: {{$blogdetail->id}}
            // });

            if ($(this).hasClass('ratings_over')) {
                $('.ratings_stars').removeClass('ratings_over');
                $(this).prevAll().addBack().addClass('ratings_over');
            } else {
                $(this).prevAll().addBack().addClass('ratings_over');
            }

            // phan tich xem rate co gi? de tao table co dung?
            // id, rate, id_blog, id_user, time
            // dung ajax gui qua controller va insert table rate
            console.log('before ajax');

            

            $.ajax({
                type: 'POST',
                url: '{{route('ajaxrate')}}',
                data:{
                    rate: rate,
                    id_blog: {{$blogdetail->id}}
                },
                success:function(res){
                    console.log(res);
                    if (res.success) {
                        //hiển thị text
                        
                        $('#count').text(res.count);
                                               
                        console.log("User rate:", res.userRate);
                        //tô màu sao
                        let displayRate;
                        if(res.userRate){
                            displayRate = res.userRate;
                            $('#userRate').text(res.userRate);
                            $('#user-rate-box').show();
                            $('#avg-rate-box').hide();
                        }else{
                            displayRate = res.avg;
                            $('#avg').text(res.avg);
                            $('#avg-rate-box').show();
                            $('#user-rate-box').hide();
                        }
                        highlightStars(displayRate);
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
                
            });
        });

			//ajax load cmt
		let level = 0;
		$(document).on('click', '.reply-btn', function () {
			level = $(this).data('id');
			$('#cmt').focus();
		});

		$('#btn-comment').click(function(){
			var checkLogin="{{Auth::Check()}}";
			if(checkLogin){
				var cmt = $('#cmt').val();
				console.log(cmt);
				$.ajax({
					type:'POST',
					url:'{{route('ajaxcomment')}}',
					data:{
						cmt: cmt,
						id_blog: {{ $blog->id }},
						level: level
					},
					success:function(res){
						// console.log(res);
						let cmt = res.comment;
						if(cmt.level == 0){

							// append comment cha
							let avatarPath = cmt.user.level == 1
								? "{{ asset('admin/images/users') }}"
								: "{{ asset('frontend/images/users') }}";
							$('.media-list').append(`
							<li class="media" id="comment-${cmt.id}">
								<a class="pull-left" href="#">
									<img class="media-object"  src="${avatarPath}/${cmt.avatar_user}" style="width:60px;height:60px;border-radius:50%;object-fit:cover;" alt="">
								</a>

								<div class="media-body">
									<ul class="sinlge-post-meta">
										<li><i class="fa fa-user"></i>${cmt.name_user}</li>
										<li><i class="fa fa-clock-o"></i>${cmt.created_at}</li>
										<li><i class="fa fa-calendar"></i>${cmt.created_at}</li>
									</ul>

									<p>${cmt.cmt}</p>

									<a class="btn btn-primary reply-btn" data-id="${cmt.id}">
										<i class="fa fa-reply"></i>Reply
									</a>
									
								</div>
							</li>
						`);

						}else{
							//after comment con
							let avatarPath = cmt.user.level == 1
								? "{{ asset('admin/images/users') }}"
								: "{{ asset('frontend/images/users') }}";
							let html_reply=`
								<li class="media second-media">
									<a class="pull-left" href="#">
										<img class="media-object"  src="${avatarPath}/${cmt.avatar_user}" style="width:60px;height:60px;border-radius:50%;object-fit:cover;" alt="">
									</a>

									<div class="media-body">
										<ul class="sinlge-post-meta">
											<li><i class="fa fa-user"></i>${cmt.name_user}</li>
											<li><i class="fa fa-clock-o"></i>${cmt.created_at}</li>
											<li><i class="fa fa-calendar"></i>${cmt.created_at}</li>
										</ul>

										<p>${cmt.cmt}</p>

										<a class="btn btn-primary reply-btn" data-id="${cmt.level}">
											<i class="fa fa-reply"></i>Reply
										</a>
									</div>
								</li>
							`;
							let cmt_cha = $('#comment-' + cmt.level);
							// console.log(cmt_cha.length);
							let next = cmt_cha.next();
							console.log(next.hasClass('second-media'));
							while (next.length && next.hasClass('second-media')) {
								cmt_cha = next;
								next = next.next();
							}
							console.log("Before after");
							cmt_cha.after(html_reply);
							console.log(cmt_cha.next());
							console.log("After after");
							// append comment con
							// $('#comment-'+cmt.level).append(`
							// 	<li class="media second-media">
							// 		<a class="pull-left">
							// 			<img class="media-object" src="${cmt.avatar_user}" alt="">
							// 		</a>

							// 		<div class="media-body">

							// 			<ul class="sinlge-post-meta">

							// 				<li><i class="fa fa-user"></i>${cmt.name_user}</li>

							// 				<li><i class="fa fa-clock-o"></i>${cmt.created_at}</li>

							// 				<li><i class="fa fa-calendar"></i>${cmt.created_at}</li>

							// 			</ul>

							// 			<p>${cmt.cmt}</p>
							// 			<a class="btn btn-primary reply-btn" data-id="${cmt.level}">
							// 				<i class="fa fa-reply"></i>Reply
							// 			</a>

							// 		</div>
							// 	</li>
							// `);
						}
						$('#cmt').val('');
                		level = 0;
						
	
					},
					error:function(err){
						console.log(err.responseText);
					}
				});
			}else{
				alert("Vui long login de cmt!");
			}
			
		});

    </script>
    
@endsection
@endsection

						