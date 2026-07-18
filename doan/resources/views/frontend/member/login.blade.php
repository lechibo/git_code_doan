@extends('frontend.layouts.app')
@section('content')
<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						@if(session('error'))
							<p style="color:red;">{{session('error')}}</p>
						@endif
						<form action="" method="post">
							@csrf
							<input type="email" name="email" placeholder="Email Address" />
							<input type="password" name="password" placeholder="Password" />
							<span>
								<input type="checkbox" class="checkbox" name="remember_me"> 
								Keep me signed in
							</span>
                            
                            <!-- <button type="submit" class="btn btn-default">Login</button>
                            <a href="{{ route('register') }}" class="btn btn-default">Register</a> -->
                            <div style="display:flex; gap:10px; margin-top:20px;">
                                <button type="submit" class="btn btn-default">
                                    Login
                                </button>

                                <button type="button" class="btn btn-default" onclick="window.location='{{ route('register') }}'">
                                    Register
                                </button>
                            </div>
                            
						</form>
						@if ($errors->any())
							<div class="alert alert-danger">
								<ul>
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif
					</div><!--/login form-->
				</div>
				
				
			</div>
		</div>
	</section><!--/form-->
@endsection